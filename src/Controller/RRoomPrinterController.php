<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controller;
use App\Model\Table;
/**
 * Description of RroomprinterController
 *
 * @author niteen
 */

define('RRPTR_INS_QRY', "INSERT INTO r_room_printer (RoomId,RoomTypeId,"
        . "PrinterId,Description,Active) VALUES (@RoomId,@RoomTypeId,"
        . "@PrinterId,\"@Description\",@Active);");
class RRoomPrinterController extends ApiController{
    
    public function getTableObj() {
        return new Table\RRoomPrinterTable();
    }
    
    public function prepareInsertStatement($restaurantId) {
        $allPrinters = $this->getTableObj()->getRoomPrinter($restaurantId);
        if (!$allPrinters) {
            return false;
        }
        $preparedStatements = '';

        foreach ($allPrinters as $printer) {
            $preparedStatements .= RRPTR_INS_QRY;
            $preparedStatements = str_replace('@RoomId', $printer->roomId, $preparedStatements);
            $preparedStatements = str_replace('@RoomTypeId', $printer->roomTypeId, $preparedStatements);
            $preparedStatements = str_replace('@PrinterId', $printer->printerId, $preparedStatements);
            $preparedStatements = str_replace('@Description', $printer->description, $preparedStatements);
            $preparedStatements = str_replace('@Active', $printer->active, $preparedStatements);
        }
        return $preparedStatements;
    }
}
