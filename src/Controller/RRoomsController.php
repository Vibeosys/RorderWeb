<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controller;
use App\Model\Table;
/**
 * Description of RRoomsController
 *
 * @author niteen
 */

define('RRM_INS_QRY', "INSERT INTO r_rooms (RoomId,Description,Active"
        . ") VALUES (@RoomId,\"@Description\",@Active);");
class RRoomsController extends ApiController{
    
    public function getTableObj() {
        return new Table\RRoomsTable();
    }
    
    public function prepareInsertStatement($restaurantId) {
        $allRooms = $this->getTableObj()->getRooms($restaurantId);
        if (!$allRooms) {
            return false;
        }
        $preparedStatements = '';

        foreach ($allRooms as $room) {
            $preparedStatements .= RRM_INS_QRY;
            $preparedStatements = str_replace('@RoomId', $room->roomId, $preparedStatements);
            $preparedStatements = str_replace('@Description', $room->description, $preparedStatements);
            $preparedStatements = str_replace('@Active', $room->active, $preparedStatements);
        }
        return $preparedStatements;
    }
    
    public function getStdRooms($restaurantId) {
        \Cake\Log\Log::debug('current restaurantId is :-'.$restaurantId);
        $allRooms = $this->getTableObj()->getRooms($restaurantId);
        if($allRooms){
            $mRoom = new \stdClass();
            foreach ($allRooms as $room){
                $key = $room->roomId;
                $mRoom->$key = $room->description;
            }
            return $mRoom;  
        }
        return FALSE;
    }
    
}
