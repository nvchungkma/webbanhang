<?php


namespace App\Controllers;


use App\Models\Orders;
use App\Models\OrdersItems;
use App\Models\Users;
use Core\Controller;
use Core\View;

class Cart extends \Core\Controller
{
    /**
     * hamf này dùng để hiển thị các mặt hàng có trong giỏ hàng
     */
    public function indexAction(){
        $user =Users::layUserHT();
        $cartItemFinder = self::getEntityManager()->getRepository("App\Models\CartItems");
        $cartItems = $cartItemFinder->findBy(['user'=>$user]);
        View::renderTemplate("Cart.twig",['cartItems'=>$cartItems]);
    }
    public function addAction(){
        //1. get item & user
        $itemId = $this->route_params['id'];
        $itemFinder = self::getEntityManager()->getRepository("App\Models\Items");
        $item = $itemFinder->find($itemId);
        $user =Users::layUserHT();
        //2. nếu có cartitem tương ứng rồi thì lấy ra +1 vào quantity
        $cartItemFinder = self::getEntityManager()->getRepository("App\Models\CartItems");
        $cartItem = $cartItemFinder->findOneBy(['user'=>$user, 'item'=>$item]);
        if($cartItem){
            $cartItem->setQuantity($cartItem->getQuantity()+1);
        }else{
            $cartItem = new \App\Models\CartItems($item,$user);
       }
        $tam = self::getEntityManager();
        $tam->persist($cartItem);
        $tam->flush();
        self::redirect("/");
        //3. nếu chưa có mới tạo mới và add vào db

    }
    public function removeAction(){
        $itemId = $this->route_params['id'];
        $itemFinder = self::getEntityManager()->getRepository("App\Models\Items");
        $item = $itemFinder->find($itemId);
        $userFinder = self::getEntityManager()->getRepository("App\Models\Users");
        $user = $userFinder->find($_SESSION['user_id']);
       // lấy cartItem ra
        $cartItemFinder = self::getEntityManager()->getRepository("App\Models\CartItems");
        $cartItem = $cartItemFinder->findOneBy(['user'=>$user, 'item'=>$item]);
        if($cartItem){
            $tam = self::getEntityManager();
            $tam->remove($cartItem);
            $tam->flush();
        }
        self::redirect("/cart");

    }
    public function thanhToanAction(){
        $tam = self::getEntityManager();
        // lay usr hien tai
        $user = Users::layUserHT();
        // lay ra cart item
        $cartItemFinder = self::getEntityManager()->getRepository("App\Models\CartItems");
        $cartItems = $cartItemFinder->findBy(['user'=>$user]);
        $tongTien = 0 ;
        foreach ($cartItems as $cartItem){
            $slCon = $cartItem->getItem()->getAvailableQuantity();
            $slMua = $cartItem->getQuantity();
            $tienCon = $user->getAvailableFunds();
            if($slMua <= $slCon){
                $tongTien = $tongTien + ($cartItem->getItem()->getPrice())*$cartItem->getQuantity();
            }else{

            }

        }
        if($tongTien <= $tienCon){
            //2. tru di so luong cua cac item day trong db
            foreach ($cartItems as $cartItem){
                $cartItem->getItem()->setAvailableQuantity($cartItem->getItem()->getAvailableQuantity()-$cartItem->getQuantity());
                $tam->remove($cartItem);
            }
            $user->setAvailableFunds($user->getAvailableFunds()-$tongTien);
        }else{
            //thong bao loi
        }
        $order = new Orders($tongTien,"",$user);
        foreach ($cartItems as $cartItem){
            $orderItem = new OrdersItems($cartItem->getQuantity(),$cartItem->getItem()->getPrice(),$cartItem->getItem()->getPrice(),$cartItem->getItem(),$order);
            $tam->persist($orderItem);
        }
        $tam->persist($order);

        self::getEntityManager()->flush();
        self::redirect("/");
        //1. tinh tong tien cua cac item trong cart cua user nay

        // kiem tra xem user cos du tien mua k
        //kiem tra xem co du hang chua


        //3. tru tien cu user

        //4. quay lai trang home

    }

    public function before()
    {
        $this->requireLogin();
        parent::before(); // TODO: Change the autogenerated stub
    }


}