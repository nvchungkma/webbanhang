<?php
/**
 * Class này là cái gì
 * phục vụ gì
 * làm được gì
 * thuộc cái gì
 *
 */

namespace App\Controllers\Admin;


class Users extends \Core\Controller
{
    private function addAction(){
        $password = 'chung999';
        $password_hash = password_hash($password, PASSWORD_BCRYPT);
    }
}