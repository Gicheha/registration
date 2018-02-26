<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 2/26/18
 * Time: 1:18 AM
 */

namespace Classes;


class Scanned_File
{
    public $Employee_Number;
    public $size;
    public $location;


    public function __construct($Employee_Number,$size,$location)
    {
        $this->Employee_Number = $Employee_Number;
        $this->size = $size;
        $this->location = $location;
    }


}