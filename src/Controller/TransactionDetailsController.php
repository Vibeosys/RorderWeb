<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controller;
use App\Model\Table;
use App\DTO\DownloadDTO;
use App\DTO\UploadDTO;
use App\DTO;
/**
 * Description of TransactionDetailsController
 *
 * @author niteen
 */
class TransactionDetailsController extends ApiController{
    
     private function getTableObj() {
        return new Table\TransactionDetailsTable();
    }
    
    public function saveReport($request) {
        $result = $this->getTableObj()->getTransactionDetailsId($request);
        if($result){
         $response = $this->getTableObj()->update($request, $result);
        }  else {
        $response = $this->getTableObj()->insert($request);    
        }
        return $response;
    }
    
    public function generateReport($restaurantId) {
        return  $this->getTableObj()->getReport($restaurantId);
    }
}
