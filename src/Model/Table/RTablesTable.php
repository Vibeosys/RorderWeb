<?php
namespace App\Model\Table;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
use Cake\ORM\TableRegistry;
use Cake\Log\Log;
use Cake\ORM\Table;
use App\DTO\DownloadDTO;
use App\DTO\UploadDTO;
/**
 * Description of RTablesTable
 *
 * @author niteen
 */
class RTablesTable extends Table{
 
    public function connect() {
        return TableRegistry::get('r_tables');
    }
    
    public function getRtable($restaurantId) {
        $rTables = $this->connect()->find()->where(['RestaurantId = ' => $restaurantId]);
        $count = $rTables->count();
        if(!$count){
           return false;
        }
        $allRTables[] = null;
        $i = 0;
        foreach ($rTables as $rTable){
            
            $rTablesDto = new DownloadDTO\RTableDownloadDto($rTable->TableId, 
                    $rTable->TableNo, 
                    $rTable->TableCategoryId, 
                    $rTable->Capacity, 
                    $rTable->IsOccupied);
            
            $allRTables[$i] = $rTablesDto;
            $i++;
        }
        Log::debug('All RTable data successfully return');
        return $allRTables;
        
    }
    public function occupy($tableId,$isOccupied) {
        if($tableId){
            $conditions = ['TableId =' => $tableId];
            $updateTable = $this->connect()->query()->update();
            $updateTable->set(['IsOccupied' => $isOccupied]);
            $updateTable->where($conditions);
            if($updateTable->execute()){
                Log::debug('Table Occupied status changes for giveen request');
                return true;
            }
            Log::error('Table Occupied status changes for giveen request');
            return false;
        }
    }
    
    public function getTableNo($tableId) {
          $conditions = ['TableId =' => $tableId];
        try{
            $results = $this->connect()->find()->where($conditions);
            if($results->count()){
            foreach ($results as $result){
                return $result->TableNo;
            }
            }
            return null;
        } catch (Exception $ex) {
            return null;
        }
    }
    
     public function tableNoValidator($tableNo,$restaurantId) {
          $conditions = [
              'TableNo =' => $tableNo,
              'RestaurantId' => $restaurantId
              ];
        try{
            $results = $this->connect()->find()->where($conditions);
            if($results->count()){
            return 1;
            }
            return 0;
        } catch (Exception $ex) {
            return 0;
        }
    }
    
    public function insert($allTables) {
        $insertCounter = 0;
        foreach ($allTables as $table){
            $tableObj = $this->connect();
            $newTable = $tableObj->newEntity();
            $newTable->TableNo  = $table->tableNo;
            $newTable->TableCategoryId = $table->tableCategoryId;
            $newTable->Capacity = $table->capacity;
            $newTable->CreatedDate = date(VB_DATE_TIME_FORMAT);
            $newTable->UpdatedDate = date(VB_DATE_TIME_FORMAT);
            $newTable->IsOccupied = $table->isOccupied;
            $newTable->RestaurantId = $table->restaurantId;
            if($tableObj->save($newTable)){
                $insertCounter++;
            }
        }
        return $insertCounter;
    }
    
    public function tableOccupancyCheck($tableId, $isOccupied) {
        $conditions = ['TableId =' => $tableId,'IsOccupied =' => $isOccupied];
        $tables = $this->connect()->find()->where($conditions);
        $occupancyCheck = $tables->count();
        return $occupancyCheck;
    }
    
    public function update(UploadDTO\RTablesInsertDto $request) {
        $conditions = ['tableId =' => $request->tableId];
        $key = [
            'TableNo' => $request->tableNo,
            'TableCategoryId' => $request->tableCategoryId,
            'Capacity' => $request->capacity,
            'UpdatedDate' => date(VB_DATE_TIME_FORMAT),
            'IsOccupied'  => $request->isOccupied
        ];
        try{
            $update = $this->connect()->query()->update();
            $update->set($key);
            $update->where($conditions);
            if($update->execute()){
                return true; 
            }
            return FALSE;
        } catch (Exception $ex) {
            return FALSE;
        }
    }
    
    public function getUpdatedTable($tableId) {
        $conditions = ['TableId = ' => $tableId];
        $rTables = $this->connect()->find()->where($conditions);
        $count = $rTables->count();
        if(!$count){
           return false;
        }
        foreach ($rTables as $rTable){
            
            $rTablesDto = new DownloadDTO\RTableDownloadDto($rTable->TableId, 
                    $rTable->TableNo, 
                    $rTable->TableCategoryId, 
                    $rTable->Capacity, 
                    $rTable->IsOccupied);
        }
        Log::debug('Updated table successfully return');
        return $rTablesDto;
    }
}
