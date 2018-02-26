<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 2/26/18
 * Time: 1:13 AM
 */

namespace Classes;


class Employee
{
    public $Employee_Number;
    public $tax_pin;
    public $date_hired;
    public $id_number;
    public $verifier_phone;


    public function __construct($Employee_number,$tax_pin,$date_hired,$id_number,$verifier_phone)
    {
        $this->Employee_Number = $Employee_number;
        $this->tax_pin = $tax_pin;
        $this->date_hired = $date_hired;
        $this->id_number = $id_number;
        $this->verifier_phone = $verifier_phone;
    }

}