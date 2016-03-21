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
 * Description of PermissionSetTable
 *
 * @author niteen
 */
class PermissionSetTable extends Table {
    
    public function connect() {
        return TableRegistry::get('permission_set');
    }
    
    public function getSets() {
       $conditions = ['Active = ' => ACTIVE];
       $allPermissionSet = null;
       $permissionCounter = 0;
        try{
            $sets = $this->connect()->find()->where($conditions);
            if($sets->count()){
                foreach ($sets as $set){ 
                    $allPermissionSet[$permissionCounter++] = 
                            new DownloadDTO\PermissionSetDownloadDto(
                                    $set->PermissionId, 
                                    $set->PermissionKey, 
                                    $set->Description, 
                                    $set->Active);
                }
            }
            return $allPermissionSet;
        } catch (Exception $ex) {
            return NULL;
        }
    }
}
