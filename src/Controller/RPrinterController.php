<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controller;
use App\Model\Table;
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
    
}