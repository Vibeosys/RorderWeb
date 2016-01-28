<?php
namespace App\Controller;

use App\Model\Table;
use Cake\Log\Log;
/**
 * Description of RTablesController
 *
 * @author niteen
 */
define('RT_INS_QRY', "INSERT INTO r_tables (TableId,TableNo,TableCategoryId,Capacity,IsOccupied,CreatedDate,"
        . "UpdatedDate) VALUES (@TableId,@TableNo,@TableCategoryId,@Capacity,@IsOccupied,\"@CreatedDate\",\"@UpdatedDate\");");
class RTablesController extends ApiController {
    
    
    private function getTableObj() {
        return new Table\RTablesTable();
    }
    public function getRtables() {
        $result = $this->getTableObj()->getRtable();
        if($result){
            return $result;
        }
        return false;
    }
    
     public function prepareInsertStatements() {
        $allRtables = $this->getRtables();
        if (!$allRtables) {
            return false;
        }
        $preparedStatements = '';

        foreach ($allRtables as $rTables) {
            $preparedStatements .= RT_INS_QRY;
            $preparedStatements = str_replace('@TableId', $rTables->tableId, $preparedStatements);
            $preparedStatements = str_replace('@TableNo', $rTables->tableNo, $preparedStatements);
            $preparedStatements = str_replace('@TableCategoryId', $rTables->tableCategoryId, $preparedStatements);
            $preparedStatements = str_replace('@Capacity', $rTables->capacity, $preparedStatements);
            $preparedStatements = str_replace('@IsOccupied', $rTables->isOccupied, $preparedStatements);
            $preparedStatements = str_replace('@CreatedDate', $rTables->createdDate, $preparedStatements);
            $preparedStatements = str_replace('@UpdatedDate', $rTables->updatedDate, $preparedStatements);
        }
        return $preparedStatements;
    }
    
}
