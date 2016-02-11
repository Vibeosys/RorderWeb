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
    public function getRtables($restaurantId) {
        $result = $this->getTableObj()->getRtable($restaurantId);
        if($result){
            return $result;
        }
        return false;
    }
    public function occupyTable($tableOccupyRequest, $restaurantId) {
        $occupyResult = $this->getTableObj()->occupy(
                $tableOccupyRequest->tableId, 
                $tableOccupyRequest->isOccupied);
        if($occupyResult){
            $this->makeSyncEntry(json_encode($tableOccupyRequest), $restaurantId);
        }
        return $occupyResult;
    }
    
     public function prepareInsertStatements($restaurantId) {
        $allRtables = $this->getRtables($restaurantId);
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
    
    private function makeSyncEntry($json , $restaurantId) {
        $syncController = new SyncController();
        $syncController->rtableEntry($json, UPDATE, $restaurantId);
    }
    
}
