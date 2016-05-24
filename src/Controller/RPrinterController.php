<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controller;
use App\Model\Table;
use App\DTO\DownloadDTO;
/**
 * Description of RPrinterController
 *
 * @author niteen
 */
define('RPTR_INS_QRY', "INSERT INTO r_printers (PrinterId,IpAddress,PrinterName,"
        . "ModelName,Company,MacAddress,Active) VALUES (@PrinterId,\"@IpAddress\","
        . "\"@PrinterName\",\"@ModelName\",\"@Company\",\"@MacAddress\",@Active);");
class RPrinterController extends ApiController{
    
    public function getTableObj() {
        return new Table\RPrinterTable();
    }
    
    public function prepareInsertStatement($restaurantId) {
        $allPrinters = $this->getTableObj()->getPrinters($restaurantId);
        if (!$allPrinters) {
            return false;
        }
        $preparedStatements = '';

        foreach ($allPrinters as $printer) {
            $preparedStatements .= RPTR_INS_QRY;
            $preparedStatements = str_replace('@PrinterId', $printer->printerId, $preparedStatements);
            $preparedStatements = str_replace('@IpAddress', $printer->ipAddress, $preparedStatements);
            $preparedStatements = str_replace('@PrinterName', $printer->name, $preparedStatements);
            $preparedStatements = str_replace('@ModelName', $printer->model, $preparedStatements);
            $preparedStatements = str_replace('@Company', $printer->company, $preparedStatements);
            $preparedStatements = str_replace('@MacAddress', $printer->macAddress, $preparedStatements);
            $preparedStatements = str_replace('@Active', $printer->active, $preparedStatements);
        }
        return $preparedStatements;
    }
    
    public function printerList() {
        $restaurantId = parent::readCookie('cri');
        $result = $this->getTableObj()->getPrinters($restaurantId);
        if(!is_null($result)){
            $this->set([
                'rows' => $result
            ]);
        }
        
    }
    
    public function addNewPrinter() {
        
        $data = $this->request->data;
        $restaurantId = parent::readCookie('cri');
        if($this->request->is('post') and isset($data['save'])){
            $active = 1;
            $newPrinter = new DownloadDTO\RPrinterDownloadDto(null, 
                    $data['ip'], 
                    $data['name'], 
                    $data['model'], 
                    $data['company'], 
                    $data['mac'], 
                    $active);
            $result = $this->getTableObj()->addPrinter($newPrinter, $restaurantId);
            if($result){
                $this->set([
                    'suc_msg' => 'SUCCESS ! Pinter Has Added. ',
                'color' => SUCCESS_COLOR
                ]);    
            }  else {
                $this->set([
                    'suc_msg' => 'ERROR ! Unable to perform operation. ',
                'color' => ERROR_COLOR
                ]);    
                
            }
        }
        
    }
}
