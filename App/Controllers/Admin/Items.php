<?php


namespace App\Controllers\Admin;


use App\Auth;
use Core\View;

class Items extends \Core\Controller
{

    public function addItemAction(){
        if(Auth::isAdmin()){
            View::renderTemplate("AddItem.twig");
        }else{
            self::redirect("/");
        }
    }
    public function submitAddItemAction(){
        $itemName = $_POST['name'];
        $moTa = $_POST['moTa'];
        $soLuong = $_POST['soLuong'];
        $gia = $_POST['gia'];

        $item = new \App\Models\Items($itemName,$moTa,$soLuong,$gia,"");

        $tam = self::getEntityManager();
        $tam->persist($item);
        $tam->flush();
        self::redirect("/admin/items/additem");
    }

    public function removeItemAction(){

        if(Auth::isAdmin()){
            $itemFinder = self::getEntityManager()->getRepository("App\Models\Items");
            $itemId = $this->route_params['id'];
            $item = $itemFinder->find($itemId); //find by Id
            $tam = self::getEntityManager();
            $tam->remove($item);
            $tam->flush();
        }

        self::redirect("/");
    }

    public function editItemAction(){
        if(Auth::isAdmin()){
            $itemId = $this->route_params['id'];
            View::renderTemplate("EditItem.twig",['item'=>$itemId]);
        }else{
            self::redirect("/");
        }
    }
    public function submitEditItemAction(){
        $itemFinder = self::getEntityManager()->getRepository("App\Models\Items");
        $itemId = $this->route_params['id'];
        $item = $itemFinder->find($itemId); //find by Id
        $item->setName($_POST['name']);
        $item->setDescription($_POST['moTa']);
        $item->setAvailableQuantity($_POST['soLuong']);
        $item->setPrice($_POST['gia']);
        self::getEntityManager()->flush();
        self::redirect("/");
    }
}