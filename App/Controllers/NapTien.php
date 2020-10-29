<?php


namespace App\Controllers;

use App\Models\Users;
use Core\View;
class NapTien extends \Core\Controller
{
    public function indexAction(){
        View::renderTemplate("NapThe.twig");
    }
    public function xuLyDuLieuAction(){
        $user = Users::layUserHT();

        $tienNap = $_POST['tienNap'];

        $user->setAvailableFunds( $user->getAvailableFunds()+ $tienNap);

        $tam = self::getEntityManager();
        $tam->persist($user);
        $tam->flush();
        self::redirect('/naptien');
    }
}