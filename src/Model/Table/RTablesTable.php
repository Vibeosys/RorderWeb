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
/**
 * Description of RTablesTable
 *
 * @author niteen
 */
class RTablesTable extends Table{
 
    private function connect() {
        return TableRegistry::get('r_tables');
    }
    
    public function getRtable($restaurantId) {
        $rTables = $this->connect()->find()->where(['RestaurantId' => $restaurantId]);
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
}
