<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 2/26/18
 * Time: 3:19 AM
 */

require_once('config.php');
require_once('../../application/classes/Employee.php');
require_once('../../application/classes/Scanned_File.php');

use Classes\Employee;
use Classes\Scanned_File;

if(($_SERVER['REQUEST_METHOD'] == 'POST') AND ($_POST['submit'] == 'SUBMIT') AND (isset($_POST['employee_number'])) AND (isset($_POST['tax_pin'])) AND (isset($_POST['date_hired'])) AND (isset($_POST['id_number'])) AND isset($_POST['verifier_number']))
{
    if($employee_checker = $EmployeeMapper->find('Employee_Number',$_POST['employee_number']))
    {

        #Initilise the Employee Class
        $employee = new Employee($_POST['employee_number'],$_POST['tax_pin'],$_POST['date_hired'],$_POST['id_number'],$_POST['verifier_number']);

        $target_dir = '../../Documents/';
        $target_file = $target_dir . basename($_FILES["photo"]["name"]);
        $uploadOk = 1;
        $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

        // Check if image file is a actual image or fake image
        if(isset($_POST["submit"]))
        {
            $check = getimagesize($_FILES["photo"]["tmp_name"]);
            if($check !== false) {
                echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                echo "File is not an image.";
                $uploadOk = 0;
            }
        }

        // Check if file already exists
        if (file_exists($target_file))
        {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
        }

        // Check file size
        if ($_FILES["photo"]["size"] > 500000)
        {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        // Allow certain file formats
        if($imageFileType != "jpg" AND $imageFileType != "DOCX" AND $imageFileType != "jpeg" AND $imageFileType != "pdf" )
        {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0)
        {
            echo "Sorry, your file was not uploaded.";
            // if everything is ok, try to upload file
        }
        else
        {
            if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file))
            {
                $file = new Scanned_File($employee->Employee_Number,$_FILES['photo']['size'],$target_file);
                $fileMapper->insert($file);
            }
            else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    }
    else
    {
        echo ('Empty variables');
    }
}