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
    
    public function getRtable() {
        $rTables = $this->connect()->find();
        $count = $rTables->count();
        if(!$count){
           return false;
        }
        $allRTables[] = null;
        $i = 0;
        foreach ($rTables as $rTable){
            
            $rTablesDto = new DownloadDTO\RTableDownloadDto($rTable->tableId, $rTable->tableNo, 
                    $rTable->tableCategoryId, $rTable->capacity, $rTable->isOccupied, $rTable->createdDate, $rTable->updatedDate);
            
            $allRTables[$i] = $rTablesDto;
            $i++;
        }
        Log::debug('All RTable data successfully return');
        return $allRTables;
        
    }   
}
