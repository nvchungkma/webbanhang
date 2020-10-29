<?php


namespace App\Controllers;


use App\Auth;
use Core\View;

class Login extends \Core\Controller
{
     public function indexAction(){
         if(!Auth::isLoggedIn()){
             View::render("Login.php");
         }else{
             self::redirect("/");
         }
     }

     public  function xuLyDuLieuAction(){
         if(Auth::isLoggedIn()){
             self::redirect("/");
         }
         $username = $_POST['username'];
         $password = $_POST['password'];

         $user = Auth::authenticate($username, $password);
         if($user){
             Auth::login($user);
         }else{
             echo "sai mk...";
         }

         self::redirect('/');
     }

     public function logoutAction(){
         Auth::logout();
         self::redirect('/login');
     }
}