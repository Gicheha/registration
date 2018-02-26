<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 2/26/18
 * Time: 1:31 AM
 */


namespace mappers;

require_once('AbstractDataMapper.php');

use \classes\user;
use modelMapper\AbstractDataMapper;


class userMapper extends AbstractDataMapper
{
    protected $entityTable = 'user';

    public function insert(user $user)
    {
        $user->user_id = $this->adapter->insert($this->entityTable,array(
            "first_name" => $user->user_name,
            "last_name" => $user->name,
            "email" => $user->email,
            "password" => $user->password
        ));

        return $user->user_id;
    }

    public function delete($id)
    {
        // TODO: Implement delete() method.
        if($id instanceof user)
        {
            $id = $id->id;
        }

        return $this->adapter->delete($this->entityTable,array("id"=>$id));
    }

    protected function createEntity(array $row)
    {
        // TODO: Implement createEntity() method.
        return new user($row['id'],['user_name'],$row['name'],$row['email'],$row['password']);
    }

}