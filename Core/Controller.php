<?php


namespace Core;
use App\Auth;

require_once "../bootstrap.php";

class Controller
{
    private static $entityManager;
    protected $route_params = [];

    public function __construct($router_params){
        $this->route_params = $router_params;
    }

    public function __call($method, $args){
        $method = $method."Action";

        if(method_exists($this,$method)){
            if($this->before() !==false){
                call_user_func_array([$this,$method],$args);
                $this->after();
            }
        }else{
            throw new \Exception("Phuong thuc $method khong ton tai");
        }
    }

    public function before(){
        //kiem tra dieu kien vao
    }

    public function after(){

    }

    public static function getEntityManager(){
        if(self::$entityManager == null){
            self::$entityManager = getEntityManager();
        }
        return self::$entityManager;
    }

    public static function redirect($url){
        header("Location: http://".$_SERVER['HTTP_HOST']."$url", true, 303);
        exit();
    }

    public function requireLogin(){
        if(!Auth::isLoggedIn()){
            self::redirect('/login');
        }
    }
}