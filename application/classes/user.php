<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 2/26/18
 * Time: 1:06 AM
 */

namespace Classes;


class user
{
    public $user_id;
    public $user_name;
    public $name;
    public $email;
    public $password;

    public function __construct($user_name,$name,$email,$password)
    {
        $this->user_name = $user_name;
        $this->name = $name;
        $this->email = $email;
        $this->password = hash('sha256',$password); #in practise better encryption is preferred
    }
}