<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 2/26/18
 * Time: 2:28 AM
 */

session_start();

require_once('config.php');
require_once('sessions.php');
require_once('../classes/user.php');
require_once('../classes/Match.php');


use classes\Match;
use classes\user;
use includes\sessions;

if(($_SERVER['REQUEST_METHOD']=='POST')&&($_POST['submit']=='SIGN-UP'))
{
    #Validating User Input
    if((Match::email($_POST['email']) == true) && (Match::name($_POST['fName']) == true) && (Match::name($_POST['lName']) == true))
    {
        $new_entry =new user($_POST['fName'],$_POST['lName'],$_POST['email'],$_POST['password']);

        $sessionStart = new sessions($adapter);
        $current_time = time();
        $user_agent = $_SERVER['HTTP_USER_AGENT'];


        #Check if there has been previous sign-in's/ Start sessions
        if($sessionStart->checkUnique($user->email) == true)
        {
            #store user data on to the database
            $id = $userMapper->insert($new_entry);

            #fire up the sessions :)
            $sessionStart->signUp($id,$user->email,$user->password.$user_agent);

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