<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Model\Table;
use Cake\ORM\Table;
use Cake\ORM\TableRegistry;
use Cake\Log\Log;
use App\DTO\UploadDTO;
use App\DTO\DownloadDTO;
/**
 * Description of UnitMasterTable
 *
 * @author niteen
 */
class UnitMasterTable extends Table{
    
    private function connect() {
        return TableRegistry::get('unit_master');   
    }
    
    public function getUnits() {
        $allUnits = FALSE;
        $counter = 0;
        try{
            $units = $this->connect()->find();
            if($units->count()){
                foreach ($units as $unit){
                    $allUnits[$counter++] = new 
                            DownloadDTO\UnitMasterDownloadDto(
                                    $unit->UnitId, 
                                    $unit->UnitTitle);
                }
            }
            return $allUnits;
        } catch (Exception $ex) {
            return FALSE;
        }
    }
}
