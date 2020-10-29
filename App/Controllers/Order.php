<?php


namespace App\Controllers;
use App\Models\Users;
use Core\View;

class Order extends \Core\Controller
{
    public function indexAction(){
        $user = Users::layUserHT();
        $orderFinder = self::getEntityManager()->getRepository("App\Models\Orders");
        $orders = $orderFinder->findBy(['user'=>$user]);

        try {
            View::renderTemplate("Order.twig",['orders'=>$orders]);
        }catch (\Exception $e){
            echo $e->getMessage();
        }
    }
}