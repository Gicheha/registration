<?php

/**
 * Created by PhpStorm.
 * User: root
 * Date: 2/26/18
 * Time: 2:08 AM
 */

namespace includes;

use Databases\DatabaseInterface;


class sessions
{
    private $adapter;
    private $userTable;
    private $attemptTable;

    public function __construct(DatabaseInterface $adapter)
    {
        $this->adapter = $adapter;
        $this->userTable = 'user';
        $this->attemptTable = 'attempts';
    }

    public function login($email, $password)
    {
        $result = $this->adapter->select($this->userTable, array("email" => $email, "password" => $password));

        //check if user exists
        if ($result->countAffectedRows() <= 0)
        {
            #Not signed up
            ob_start();
            header("Location:../../index.html?signedup=".$result->countAffectedRows());
            die();
        }

        $row = $result->fetch();

        //check for brute force
        if ($this->checkBrute($row['email']) == true)
        {
            // TODO: Implement code for account recovery
            #Failure Message
            $success_state['success'] = 2;
            $success_state['message'] = "Your account has been blocked";
            json_encode($success_state);
        }
        else
        {
            //check for password
            if ($email == $row['email'] AND $password = $row['password'])
            {
                //get the agent user string
                $user_browser = $_SERVER['HTTP_USER_AGENT'];

                //XSS protection
                $email = preg_replace("/[^a-zA-Z0-9_@.\-]+/", "", $row['email']);

                $_SESSION['id'] = $row['id'];
                $_SESSION['email'] = $email;
                $_SESSION['login'] = hash('sha512', $password . $user_browser);

                //login successful
                return true;
            }
            else
            {
                //password mismatch
                $now = time();
                //enter attempt into database
                $this->adapter->insert($this->attemptTable, array("email" => $email, "time" => $now));

                return false;
            }
        }

    }

    public function checkBrute($email)
    {
        $now = time();

        $validAttempts = $now - (2 * 60 * 60);

        $result = $this->adapter->select($this->attemptTable, array("email" => $email, "time" => ">" . $validAttempts));

        if ($result->countAffectedRows() > 5)
        {
            return true;
        }

        return false;
    }

    public function checkSign()
    {
        //check if all sessions are set
        if (isset($_SESSION['email']) AND isset($_SESSION['login']))
        {
            $agent = $_SERVER['HTTP_USER_AGENT'];

            $result = $this->adapter->select($this->userTable, array("email" => $_SESSION['email']));

            $row = $result->fetch();

            $logger = hash('sha512',$row['password'].$agent);

            if($row = $result->countAffectedRows() >=1)
            {
                if($_SESSION['login'] == $logger )
                {
                    return true;
                }
                else
                {
                    return false;
                }
            }

            return false;
        }
        else
        {
            #return false;
        }
    }

    public function checkUnique($email)
    {
        #checking if user already exists
        $result = $this->adapter->select($this->userTable,array('email'=>$email));

        if($result->countAffectedRows() >= 1)
        {
            return false;
        }
        return true;
    }

    public function signUp($id,$email,$password)
    {
        $_SESSION['id'] = $id;
        $_SESSION['email'] = preg_replace("/^[a-zA-Z0-9_\-\.]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-\.]+$/","",$email);
        $_SESSION['login'] = hash('sha512',$password. $_SERVER['HTTP_USER_AGENT']);
    }
}