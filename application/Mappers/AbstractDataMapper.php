<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 2/26/18
 * Time: 1:28 AM
 */

namespace modelMapper;

use Databases\DatabaseInterface;


abstract class AbstractDataMapper
{
    protected $adapter;
    protected $entityTable;

    public function __construct(DatabaseInterface $adapter)
    {
        $this->adapter = $adapter;
    }

    public function getAdapter()
    {
        return $this->adapter;
    }

    public function findById($id)
    {
        $result = $this->adapter->select($this->entityTable,$id);

        $row = $result->fetch();

        return $this->createEntity($row);
    }

    public function findAll(array $conditions = array())
    {
        $entities = array();

        $result = $this->adapter->select($this->entityTable,$conditions);

        $rows = $result->fetchAll();

        if($rows)
        {
            foreach ($rows as $row)
            {
                $entities[] = $this->createEntity($row);
            }
        }

        return $entities;
    }

    public function find($col,$var)
    {
        $result = $this->adapter->select($this->entityTable,array("$col" => $var));

        $row = $result->fetch();

        return $this->createEntity($row);
    }

    // Create an entity (implementation delegated to concrete mappers)
    abstract protected function createEntity(array $row);
}