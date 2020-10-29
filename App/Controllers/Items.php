<?php

namespace App\Controllers;

use Core\Controller;
use Core\View;

class Items extends Controller
{
    //lm the nao de truy cap vao ham nay tu web

    public function indexAction(){
        $itemFinder = self::getEntityManager()->getRepository("App\Models\Items");
        $items = $itemFinder->findAll();
        foreach ($items as $item){
            echo $item->getId().": ".$item->getName()." <br>";

        }
        View::renderTemplate('Home.twig',['items'=>$items]);


        $item = $itemFinder->find(1); //find by Id
        $item->setPrice(20000);
        self::getEntityManager()->flush();
        $item = $itemFinder->findBy(['name'=>'Thẻ cào Viettel (20K)']);

        echo $item[0]->getName();

    }

    public function addAction(){
        $item = new \App\Models\Items('Laptop Dell', 'Máy xịn xò', 10, 19000000);
        self::getEntityManager()->persist($item);
        self::getEntityManager()->flush();
        echo 'day ham them items';
    }
}