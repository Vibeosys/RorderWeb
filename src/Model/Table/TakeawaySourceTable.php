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
 * Description of TakeawaySourceTable
 *
 * @author niteen
 */


class TakeawaySourceTable extends Table{
    
    public function connect() {
        return TableRegistry::get('takeaway_source');
    }
    public function getSource() {
        $allSources = null;
        $sourceCounter = 0;
        $conditions = ['Active =' => ACTIVE];
        try{
         $sources = $this->connect()->find()->where($conditions);
            if($sources->count()){
                foreach ($sources as $source){
                    $allSources[$sourceCounter++] = new 
                            DownloadDTO\TakeawaySourcedownloadDto(
                        $source->SourceId, 
                        $source->SourceName, 
                        $source->SourceImg, 
                        $source->Discount,
                        $source->Active);
             }
             Log::debug('Takeaway source data exist');
         }
         return $allSources;
        } catch (Exception $ex) {
            return null;
        }
    }
    
    
}
