<?php


namespace App\Controllers;


use Core\View;

class Home extends \Core\Controller
{
    public function indexAction(){
        $itemFinder = self::getEntityManager()->getRepository("App\Models\Items");
        $items = $itemFinder->findAll();

        View::renderTemplate('Home.twig',['items'=>$items]);
    }


    public function before()
    {
        parent::before();
        $this->requireLogin();
    }


}