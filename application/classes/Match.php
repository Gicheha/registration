<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 2/26/18
 * Time: 1:01 AM
 */

namespace Classes;


Abstract class Match
{
    private function __construct()
    {

    }

    public static function name($title)
    {
        $determinant=preg_match("/[A-Za-z0-9_\-\'\s]/",$title);
        if($determinant==1)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public static function email($title)
    {
        $determinant=preg_match("/^[a-zA-Z0-9_\-\.]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-\.]+$/",$title);
        if($determinant==1)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public static function phone($title)
    {
        $determinant=preg_match("/^[+0-9]{10,15}$/",$title);
        if($determinant==1)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public static function Tax_Pin($taxPin)
    {
        $determinant = preg_match("/^[A-Z]+[0-9]+\[A-Z]/",$taxPin);
        if($determinant==1)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
}