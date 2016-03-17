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
 * Description of RprinterTable
 *
 * @author niteen
 */
class RPrinterTable extends Table{
    
    public function connect() {
        return TableRegistry::get('r_printers');
    }
    
    public function getPrinters($restaurantId) {
         $condtions = ['RestaurantId = ' => $restaurantId,
            'Active = ' => ACTIVE];
        $allPrinters = null;
        $printerCounter = 0;
        try{
            $Printers = $this->connect()->find()->where($condtions);
            if($Printers->count()){
                foreach ($Printers as $printer){
                    $allPrinters[$printerCounter++] =
                            new DownloadDTO\RPrinterDownloadDto(
                                    $printer->PrinterId, 
                                    $printer->IpAddress, 
                                    $printer->PrinterName, 
                                    $printer->ModelName, 
                                    $printer->Company, 
                                    $printer->MacAddress, 
                                    $printer->Active);
                }
            }
            return $allPrinters;
        } catch (Exception $ex) {
            return NULL;
        }
    }
}
