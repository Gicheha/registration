<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 2/26/18
 * Time: 1:26 AM
 */

/**
 * Interface to all database methods required by the application
 * All CRUD operations are to be accessed from this model
 * The methods stipulated in this interface will be used throughout the application
 * through Interface objects
 *
 * This is to enable the application be database independent
 *
 * The methods are mentioned in the order in which they are declared
 *
 * The methods are #connect to the database
 *
 * disconnect from the database
 *
 * prepare sql statements
 *
 * fetch results
 *
 * fetch all results
 *
 * select items from the database
 *
 * insert items into the database
 *
 * update items in the database
 *
 * delete items from the database
 */

namespace Databases;


interface DatabaseInterface
{

    public function connect();

    public function disconnect();

    public function prepare($sql, array $options = array());

    public function execute(array $parameters = array());

    public function fetch($fetchStyle = null, $cursorOrientation = null, $cursorOffset = null);

    public function fetchAll($fetchStyle = null, $column =0);

    public function select($table,array $bind = array(),$boolOperator = "AND");

    public function insert($table, array $bind);

    public function update($table, array $bind, $where = "");

    public function delete($table, $where = "");

    public function countAffectedRows();
}