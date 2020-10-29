<?php


namespace App\Controllers;
use Core\View;
use App\Models\Users;
class OrderItem extends \Core\Controller
{
    public function indexAction(){
        //
        $orderId = $this->route_params['id'];
        $orderFinder = self::getEntityManager()->getRepository("App\Models\Orders");
        $order = $orderFinder->find($orderId);

        $orderItemFinder = self::getEntityManager()->getRepository("App\Models\OrdersItems");
        $orderItems = $orderItemFinder->findBy(['order'=>$order]);
        View::renderTemplate("OrderItem.twig",['orderItems'=>$orderItems]);

        
    }
}