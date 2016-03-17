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
 * Description of RRoomsTable
 *
 * @author niteen
 */
class RRoomsTable extends Table{
    
    public function connect() {
        return TableRegistry::get('r_rooms');
    }
    
    public function getRooms($restaurantId) {
        $condtions = ['RestaurantId = ' => $restaurantId,
            'Active = ' => ACTIVE];
        $allRooms = null;
        $roomCounter = 0;
        try{
            $Rrooms = $this->connect()->find()->where($condtions);
            if($Rrooms->count()){
                foreach ($Rrooms as $room){
                    $allRooms[$roomCounter++] = new DownloadDTO\RRoomsDownloadDto(
                            $room->RoomId, $room->Description, $room->Active);
                }
            }
            return $allRooms;
        } catch (Exception $ex) {
            return NULL;
        }
    }
}
