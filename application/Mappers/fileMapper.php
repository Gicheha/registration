<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 2/26/18
 * Time: 1:46 AM
 */

namespace mappers;

use \Classes\Scanned_File;
use modelMapper\AbstractDataMapper;

class fileMapper extends AbstractDataMapper
{
    protected $entityTable = 'scannedFile';

    public function insert(Scanned_File $scanned_File)
    {
        $this->adapter->insert($this->entityTable,array(
            "Employee_Number" => $scanned_File->Employee_Number,
            "size" => $scanned_File->size,
            "location" => $scanned_File->location
        ));

    }

    public function delete($id)
    {
        // TODO: Implement delete() method.
        if($id instanceof Scanned_File)
        {
            $id = $id->id;
        }

        return $this->adapter->delete($this->entityTable,array("id"=>$id));
    }

    protected function createEntity(array $row)
    {
        // TODO: Implement createEntity() method.
        return new Scanned_File($row['id'],$row['Employee_Number'],$row['size'],$row['location']);
    }
}