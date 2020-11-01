<?php


namespace App\Controllers;


use App\Models\Users;
use Core\View;

class ChuyenTien extends \Core\Controller
{
    public function indexAction(){
        View::renderTemplate("ChuyenTien.twig");
    }

    public function xuLyDuLieuAction(){
        $userHT = Users::layUserHT();
        $tkNhan = $_POST['tkNhan'];
        $tienChuyen = $_POST['tienChuyen'];
        $userFinder = self::getEntityManager()->getRepository("App\Models\Users");
        $userNhans = $userFinder->findAll();
        foreach ($userNhans as $userNhan){
            if($userNhan->getUsername() == $tkNhan){
              $userNhan->setAvailableFunds($userNhan->getAvailableFunds()+$tienChuyen);
              $userHT->setAvailableFunds($userHT->getAvailableFunds()-$tienChuyen);
            }
        }
        self::getEntityManager()->flush();
        self::redirect("/");

    }
}