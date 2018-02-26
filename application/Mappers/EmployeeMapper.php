<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 2/26/18
 * Time: 1:36 AM
 */

namespace mappers;

namespace mappers;

require_once('AbstractDataMapper.php');

use \classes\Employee;
use modelMapper\AbstractDataMapper;

class EmployeeMapper extends AbstractDataMapper
{
    protected $entityTable = 'employee';

    public function insert(Employee $employee)
    {
        $this->adapter->insert($this->entityTable,array(
            "Employee_Number" => $employee->Employee_Number,
            "tax_pin" => $employee->tax_pin,
            "date_hired" => $employee->date_hired,
            "id_number" => $employee->id_number,
            "verifier_phone" => $employee->verifier_phone
        ));

    }

    public function delete($id)
    {
        // TODO: Implement delete() method.
        if($id instanceof Employee)
        {
            $id = $id->id;
        }

        return $this->adapter->delete($this->entityTable,array("id"=>$id));
    }

    protected function createEntity(array $row)
    {
        // TODO: Implement createEntity() method.
        return new Employee($row['id'],$row['Employee_Number'],$row['tax_pin'],$row['date_hired'],$row['id_number'],$row['verifier_phone']);
    }
}