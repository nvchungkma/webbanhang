<?php
namespace App;

use Core\Controller;

class Auth
{
    public static function authenticate($username, $password){
        $userFinder = Controller::getEntityManager()->getRepository("App\Models\Users");
        $users = $userFinder->findOneBy(['username'=>$username]);
        if($users== null){
            return false;
        }
        if(password_verify($password,$users->getPassword())){
            return $users;
        }else{
            return false;
        }
    }

    public static function login($user){
        session_regenerate_id(true);
        $_SESSION['user_id'] = $user->getId();
        $_SESSION['username'] = $user->getUsername();
        $_SESSION['is_admin'] = $user->getIsAdmin();
    }

    public static function logout(){
        $_SESSION = [];
        session_destroy();
    }

    public static function isLoggedIn(){
        return isset($_SESSION['user_id']);
    }

    public static function isAdmin(){
        return $_SESSION['is_admin'];
    }
}