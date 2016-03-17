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
    public function initialize(array $config) {
        $this->belongsTo('r_printers', [
            'foreignKey' => 'PrinterId',
            'joinType' => 'INNER',
            
            ]);
    }
    
    public function getRoomPrinter($restaurantId) {
        $allRoomPrinter = null;
        $roomprinterCounter = 0;
        $condtion1 = ['RestaurantId =' => $restaurantId];
        try{
            $roomPrinters = $this->connect()->find('all')
                    ->join(['a' => [ 'table' => 'r_printers', 'type' => 'INNER', 'conditions' => 'a.PrinterId = r_room_printer.PrinterId and a.RestaurantId = '.$restaurantId]]);
            foreach ($roomPrinters as $printer){
                Log::debug('printer info :-'.$printer->RoomPrinterid);
            } 
            return $allRoomPrinter;
        } catch (Exception $ex) {
            return null;
        }
    }
}
