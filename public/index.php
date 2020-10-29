<?php
/**
 * Đây là front controller
 */
//echo 'Requested URL = " ' . $_SERVER['QUERY_STRING'] . ' "';



//require '../Core/Router.php';
/**
 * Composer autoload
 */
require_once "../vendor/autoload.php";
$router = new Core\Router();

$router->add('', ['controller' => 'Home', 'action' => 'index']);//: /
$router->add('items', ['controller' => 'Items', 'action' => 'index']);//:/items
$router->add('{controller}/{action}');//: /abb/acc
$router->add('{controller}',['action'=>'index']);//: /abbb
$router->add('{controller}/',['action'=>'index']);//: /abb/
$router->add('{controller}/{id:\d+}/{action}');//: /abb/1/acc
$router->add('{controller}/{id:\d+}',['action'=>'index']);//: /abb/1
$router->add('{controller}/{id:\d+}/',['action'=>'index']);//: /abb/1/
$router->add('admin/{controller}/{action}', ['namespace' => 'Admin']);
$router->add('admin/{controller}/{id:\d+}/{action}', ['namespace' => 'Admin']);
//đường đi mà người dùng yêu cầu
$url = $_SERVER['QUERY_STRING'];

//kiểm tra xem đường đi của người dùng yêu cầu có trong bảng routing table k
// nếu có thì trả về các controller và action tương ứng
session_start();
$router->dispatch($url);
?>

