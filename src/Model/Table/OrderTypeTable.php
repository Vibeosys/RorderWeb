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
 * Description of OrderTypeTable
 *
 * @author niteen
 */
class OrderTypeTable extends Table{
    
    private function connect() {
        return TableRegistry::get('order_type');
    }
    
    public function getType() {
        $allType = null;
        $orderTypeCounter = 0;
        $conditions = ['Active =' => ACTIVE];
        try{
         $orderTypes = $this->connect()->find()->where($conditions);
            if($orderTypes->count()){
                foreach ($orderTypes as $type){
                    $allType[$orderTypeCounter++] = new 
                    DownloadDTO\OrderTypeDownloadDto(
                        $type->OrderTypeId, 
                        $type->OrderTypeTitle, 
                        $type->Active);
             }
             Log::debug('Order types are exist');
         }
         return $allType;
        } catch (Exception $ex) {
            return null;
        }
    }
}
