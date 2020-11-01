<?php


namespace App\Controllers;


use App\Controllers\Admin\Users;
use Core\View;

class Register extends \Core\Controller
{
    public function indexAction(){
        View::render("Register.php");
    }

    public function xuLyDuLieuAction(){
        $username = $_POST['username'];
        $password = $_POST['password'];
        $password_hash = password_hash($password, PASSWORD_BCRYPT);
        $email = $_POST['email'];
        $fullName = $_POST['fullName'];
        $timestamp = new \DateTime();


        $user = new \App\Models\Users();
        $user->setUsername($username);
        $user->setPassword($password_hash);
        $user->setEmail($email);
        $user->setFullName($fullName);
        $user->setTimestamp($timestamp);

        $tam = self::getEntityManager();
        $tam->persist($user);
        $tam->flush();

        self::redirect('/login');

    }

}