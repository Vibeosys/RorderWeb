<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controller;
use App\Model\Table;
/**
 * Description of RoomTypeController
 *
 * @author niteen
 */
define('RMTP_INS_QRY', "INSERT INTO room_type (RoomTypeId,RoomType,Active"
        . ") VALUES (@RoomTypeId,\"@RoomType\",@Active);");
class RoomTypeController extends ApiController{
    
    public function getTableObj() {
        return new Table\RoomTypeTable();
    }
    
    public function prepareInsertStatement() {
        $allRoomType = $this->getTableObj()->getType();
        if (!$allRoomType) {
            return false;
        }
        $preparedStatements = '';

        foreach ($allRoomType as $room) {
            $preparedStatements .= RMTP_INS_QRY;
            $preparedStatements = str_replace('@RoomTypeId', $room->roomTypeId, $preparedStatements);
            $preparedStatements = str_replace('@RoomType', $room->roomType, $preparedStatements);
            $preparedStatements = str_replace('@Active', $room->active, $preparedStatements);
        }
        return $preparedStatements;
    }
    
}
