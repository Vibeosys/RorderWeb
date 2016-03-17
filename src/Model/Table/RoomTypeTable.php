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
 * Description of RoomTypeTable
 *
 * @author niteen
 */
class RoomTypeTable extends Table{
    
    public function connect() {
        return TableRegistry::get('room_types');
    }
    
    public function getType() {
        $allRoomType = null;
        $roomTypeCounter = 0;
        $conditions = ['Active = ' => ACTIVE];
        try{
            $RoomTypes = $this->connect()->find()->where($conditions);
            if($RoomTypes->count()){
                foreach ($RoomTypes as $room){
                    $allRoomType[$roomTypeCounter++] = 
                            new DownloadDTO\RoomTypeDownloadDto(
                                    $room->RoomTypeId, 
                                    $room->RoomType, $room->Active);
                }
            }
            return $allRoomType;    
        } catch (Exception $ex) {
            return null;
        }
    }
}
