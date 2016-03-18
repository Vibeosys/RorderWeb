<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Model\Table;
use Cake\ORM\Table;
use Cake\ORM\TableRegistry;
use App\DTO\DownloadDTO;
use Cake\Log\Log;
/**
 * Description of RroomprinterTable
 *
 * @author niteen
 */
class RRoomPrinterTable extends Table{
    
    public function connect() {
        return TableRegistry::get('r_room_printer');
    }
    
    public function getRoomPrinter($restaurantId) {
        $allRoomPrinter = null;
        $roomprinterCounter = 0;
        $joins = [
                     'a' => 
                        [
                            'table' => 'r_printers', 
                            'type' => 'INNER', 
                            'conditions' => 'a.PrinterId = '
                            . 'r_room_printer.PrinterId and a.RestaurantId = '.$restaurantId
                        ]
                ];
        $field = array('RoomId' => 'r_room_printer.RoomId',
            'RoomTypeId' => 'r_room_printer.RoomTypeId',
            'PrinterId' => 'r_room_printer.PrinterId' ,
            'Description' => 'r_room_printer.Description',
            'Active' => 'r_room_printer.Active' );
        try{
            $roomPrinters = $this->connect()->find('all',array('fields' => $field))
                    ->join($joins);
            foreach ($roomPrinters as $printer){
               $allRoomPrinter[$roomprinterCounter++] = 
                       new DownloadDTO\RRoomPrinterDownloadDto(
                               $printer->RoomId, 
                               $printer->RoomTypeId, 
                               $printer->PrinterId, 
                               $printer->Description, 
                               $printer->Active);
            } 
            return $allRoomPrinter;
        } catch (Exception $ex) {
            return null;
        }
    }
}
