<?php

/**
 * Created by PhpStorm.
 * User: root
 * Date: 2/26/18
 * Time: 1:22 AM
 */

/*
 * Adapter class to the database interface
 * This class contains the implementation of the database Interface with methods necessary for CRUD applications
 * NOTE: The statement attribute becomes a PDO object after the pointer is passed on the
 */

namespace Databases;

require ('DatabaseInterface.php');


class BaseAdapter implements DatabaseInterface
{
    protected $config = array();
    protected $connection;
    protected $statement;
    protected $fetchMode = \PDO::FETCH_ASSOC;

    public function __construct($dsn,$username = null,$password = null, array $driverOptions = array())
    {
        $driverOptions = array();

        $this->config = compact("dsn","username","password","driverOptions");
    }

    public function getStatement()
    {

        //Check for database query
        if($this->statement == null)
        {
            throw \PDOException("There is no PDO statement for object to use");
        }

        return $this->statement;
    }

    public function connect()
    {
        #if there is a PDO object ready return early
        if($this->connection)
        {
            return $this->connection;
        }

        #Connecting to the database
        try
        {
            $this->connection = new \PDO(
                $this->config['dsn'],
                $this->config['username'],
                $this->config['password'],
                $this->config['driverOptions']
            );

        }
            #throw connection error
        catch (\PDOException $e)
        {
            throw new \RuntimeException($e->getMessage());
        }
    }

    public function disconnect()
    {
        #nullify the connection attribute
        $this->connection = null;
    }

    public function prepare($sql, array $options = array())
    {
        // TODO: Implement prepare() method.
        $this->connect();
        try
        {
            #intitialize the statement attribute
            $this->statement = $this->connection->prepare($sql,$options);
            return $this;
        }
        catch (\PDOException $e)
        {
            throw new \RuntimeException($e->getMessage());
        }
    }

    public function execute(array $parameters = array())
    {
        // TODO: Implement execute() method.
        try
        {
            #Use the initialized statement to execute:
            $this->getStatement()->execute($parameters);
            return $this;
        }
        catch (\PDOException $e)
        {
            throw new \RuntimeException($e->getMessage());
        }
    }

    public function countAffectedRows()
    {
        try
        {
            return $this->getStatement()->rowCount();
        }
        catch (\PDOException $e)
        {
            throw new \RuntimeException($e->getMessage());
        }
    }

    public function getLastInsertId($name = null)
    {
        $this->connect();
        return $this->connection->lastInsertId($name);
    }

    public function fetch($fetchStyle = null, $cursorOrientation = null, $cursorOffset = null)
    {
        // TODO: Implement fetch() method.
        if($fetchStyle == null)
        {
            $fetchStyle = $this->fetchMode;
        }

        try
        {
            return $this->getStatement()->fetch($fetchStyle,
                $cursorOrientation, $cursorOffset);

        }
        catch (\PDOException $e)
        {
            throw new \RuntimeException($e->getMessage());
        }
    }

    public function fetchAll($fetchStyle = null, $column = 0)
    {
        // TODO: Implement fetchAll() method.
        if($fetchStyle == null)
        {
            $fetchStyle = $this->fetchMode;
        }

        try
        {
            return $fetchStyle === \PDO::FETCH_COLUMN ? $this->getStatement()->fetchAll($fetchStyle,$column):$this->getStatement()->fetchAll($fetchStyle);
        }
        catch (\PDOException $e)
        {
            throw new \RuntimeException($e->getMessage());
        }
    }

    public function select($table,array $bind = array(), $boolOperator= "AND")
    {
        $where = array();

        if($bind)
        {
            foreach ($bind as $col => $value)
            {
                unset($bind[$col]);
                $bind[":" . $col] = $value;
                $where[] = $col . " = :" . $col;
            }

        }

        $sql = "SELECT * FROM " . $table . (($bind) ? " WHERE " . implode(" " . $boolOperator . " ", $where) : " ");

        /*echo $sql."<br/>";
          $shit = implode(" ",$bind);
         echo $shit;*/

        $result = $this->prepare($sql)->execute($bind);
        return $result;
    }

    public function insert($table, array $bind)
    {
        $cols = implode(", ", array_keys($bind));
        $values = implode(", :", array_keys($bind));

        foreach ($bind as $col => $value)
        {
            unset($bind[$col]);
            $bind[":" . $col] = $value;
        }

        $sql = "INSERT INTO " . $table . " (" . $cols . ")  VALUES (:" . $values . ")";

        return (int) $this->prepare($sql)->execute($bind)->getLastInsertId();
    }

    public function update($table, array $bind, $where = "")
    {
        // TODO: Implement insert() method.
        $set = array();
        foreach ($bind as $col => $value)
        {
            unset($bind[$col]);
            $bind[":".$col] = $value;
            $where[] = $col."=".$col;
        }

        $sql = "update".$table."set".implode(",",$set).(($where)?"WHERE":" ");
        return $this->prepare($sql)->execute($bind)->countAffectedRows();
    }

    public function delete($table, $where = "")
    {
        $sql = "DELETE FROM " . $table . (($where) ? " WHERE " . $where : " ");
        return $this->prepare($sql)
            ->execute()
            ->countAffectedRows();
    }

}