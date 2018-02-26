<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 2/26/18
 * Time: 1:53 AM
 */

require_once($_SERVER['DOCUMENT_ROOT'].'/registration/application/Databases/BaseAdapter.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/registration/application/Mappers/userMapper.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/registration/application/Mappers/fileMapper.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/registration/application/Mappers/EmployeeMapper.php');


#setting up server variables
use Databases\BaseAdapter;
use mappers\EmployeeMapper;
use mappers\fileMapper;
use mappers\userMapper;

$host = 'localhost';
$db ='registration';
$user = 'root';
$password = 'Waithira21';
$charset = 'UTF8';

$opt = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

$dsn ="mysql:host = $host;dbname=$db;charset=$charset";




//PDO Adapter
$adapter = new BaseAdapter($dsn,$user,$password,$opt);

//Create the Mappers
$userMapper = new userMapper($adapter);
$EmployeeMapper = new EmployeeMapper($adapter);
$fileMapper = new fileMapper($adapter);
$userMapper = new userMapper($adapter);

