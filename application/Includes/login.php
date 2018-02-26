<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 2/26/18
 * Time: 2:49 AM
 */

if(($_SERVER['REQUEST_METHOD']=='POST')&&($_POST['submit']=='SIGN-UP') && (!empty($_POST['email'])) && (!empty($_POST['password']))) {
    if ((isset($request_data['log-in']['email'])) && (isset($request_data['log-in']['password']))) {

        $seshion = new sessions($adapter);
        $current_time = time();
        $agent = $_SERVER['HTTP_USER_AGENT'];
        $user = new user();
        $user->setEmail($request_data['log-in']['email']);
        $user->setPassword($request_data['log-in']['password']);

        if ($seshion->login($user->email, $user->password) == true)
        {
            #Session to determine the Dashboard to be displayed
            if($_POST['level'] == 'admin')
            {
                $_SESSION['level'] = 1;
            }
            else
            {
                $_SESSION['level'] = 0;
            }

            #Redirect to the Dashboard
            ob_start();
            header("Location:../../dashboard.php");
            die();

        }

    }

}