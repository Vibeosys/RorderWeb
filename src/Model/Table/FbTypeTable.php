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
 * Description of FbTypeTable
 *
 * @author niteen
 */
class FbTypeTable extends Table{

    private function conncet() {
        return TableRegistry::get('fb_types');
    }
    
    public function getFbTypes() {
        $conditions = ['Active = ' => ACTIVE];
        try{
            $alltypes = $this->conncet()->find()->where($conditions);
            $fbTypes = null;
            $fbCounter = 0;
            if($alltypes->count()){
                foreach ($alltypes as $type){
                    $fbTypes[$fbCounter++] = new DownloadDTO\FbTypeDowunloadDto(
                            $type->FbTypeId, $type->FbTypeName);
                }
            }
            return $fbTypes;
        } catch (Exception $ex) {
            return NULL;
        }
    }
    
}
