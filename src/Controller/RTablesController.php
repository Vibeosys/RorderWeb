<?php
namespace App\Controller;

use App\Model\Table;
use Cake\Log\Log;
use App\DTO\UploadDTO;
/**
 * Description of RTablesController
 *
 * @author niteen
 */
define('RT_INS_QRY', "INSERT INTO r_tables (TableId,TableNo,TableCategoryId,Capacity,IsOccupied"
        . ") VALUES (@TableId,@TableNo,@TableCategoryId,@Capacity,@IsOccupied);");
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
        if($this->getTableObj()->tableOccupancyCheck(
                $tableOccupyRequest->tableId, 
                $tableOccupyRequest->isOccupied)){
                return false;
        }
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
            $preparedStatements = str_replace('@TableId', $rTables->tableId, 
                    $preparedStatements);
            $preparedStatements = str_replace('@TableNo', $rTables->tableNo, 
                    $preparedStatements);
            $preparedStatements = str_replace('@TableCategoryId', 
                    $rTables->tableCategoryId, $preparedStatements);
            $preparedStatements = str_replace('@Capacity', $rTables->capacity, 
                    $preparedStatements);
            $preparedStatements = str_replace('@IsOccupied', $rTables->isOccupied, 
                    $preparedStatements);
        }
        return $preparedStatements;
    }
    
    private function makeSyncEntry($json , $restaurantId) {
        $syncController = new SyncController();
        $syncController->rtableEntry($json, UPDATE_OPERATION, $restaurantId);
    }
    
    
    public function addNewTables() {
         if(!$this->isLogin()){
            $this->redirect('login');
        }
          if ($this->request->is('post') and isset($this->request->data['add-table'])) {
            $data = $this->request->data();
            $file = $data['file-upload']['tmp_name'];
            $extenstion = $this->getExtension($data['file-upload']['name']);
            if (empty($file)) {
                $this->set([MESSAGE => SELECT_FILE_MESSAGE, 'color' => 'red']);
            } elseif ($extenstion != CSV_EXT) {
                $this->set([MESSAGE => INCORRECT_FILE_MESSAGE, 'color' => 'red']);
            } else {
                if (($handle = fopen($file, "r")) !== FALSE) {
                    $counter = 0;
                    $allTables = null;
                    fgetcsv($handle);
                    while (($filesop = fgetcsv($handle, 1000, ",")) !== false) {
                        $allTables[$counter] = new UploadDTO\RTablesInsertDto(
                                $filesop[0], 
                                $filesop[1], 
                                $filesop[2], 
                                INACTIVE, 
                                12345);
                        $counter++;
                    }
                    fclose($handle);
                    $result = $this->getTableObj()->insert($allTables);
                }
                if ($result) {
                    $this->set([MESSAGE => 'You database has imported successfully. '
                        . 'You have inserted ' . $result . ' recoreds', 'color' => 'green']);
                } else {
                    $this->set([MESSAGE => DB_FILE_ERROR, 'color' => 'red']);
                }
            }
        }
    }
    
}
