<?php

namespace App\Model\Table;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
use App\DTO\DownloadDTO;
use Cake\ORM\Table;
use Cake\ORM\TableRegistry;

/**
 * Description of SyncTable
 *
 * @author niteen
 */
class SyncTable extends Table {


    public function connect() {
        return TableRegistry::get('sync');
    }

    public function Insert($userId, $update, $table, $operation, $restaurantId) {
       try{
        $query = $this->connect()->newEntity();
        $query->UserId = $userId;
        $query->JsonSync = $update;
        $query->TableName = $table;
        $query->Operation = $operation;
        $query->UpdatedDate = date(VB_DATE_TIME_FORMAT);
        $query->RestaurantId = $restaurantId;
        $save = $this->connect()->save($query);
        if($save){
            return true;
        }
        return false;
       }  catch (Excetion $ex){
           \Cake\Log\Log::error("Database exception : ".$ex);
       }
    }

    public function getUpdate($userId , $restaurantId) {
        $rows = $this->connect()->find('all', ['order' => ['UpdatedDate' => 'ASC']
              ])->where(['UserId = ' => $userId,'RestaurantId =' => $restaurantId]);
        $updateCount = $rows->count();
        if ($updateCount) {
            $i = 0;
            foreach ($rows as $row) {
                $syncDto = new DownloadDTO\SyncDownloadDto($row->TableName, $row->JsonSync, $row->Operation);
                $update[$i] = $syncDto;
                $i++;
                \Cake\Log\Log::debug("table name :-".$row->TableName);
            }
            \Cake\Log\Log::debug("Sending update to sync controller");
            $data['data'] = $update;
            return $data;
        } else {
            \Cake\Log\Log::debug('Update not created');
            return false;
        }
    }

    public function deleteUpdate($UserId) {
        $rows = $this->connect()->find()->where(['UserId = ' => $UserId]);

        foreach ($rows as $row) {
            $entity = $this->connect()->get($row->SyncAutoNo);
            $result = $this->connect()->delete($entity);
        }
    }

}
