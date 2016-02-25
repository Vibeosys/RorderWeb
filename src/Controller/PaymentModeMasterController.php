<?php
namespace App\Controller;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
use App\Model\Table;
use Cake\Log\Log;


/**
 * Description of PaymentModeMasterController
 *
 * @author niteen
 */
define('PMM_INS_QRY', "INSERT INTO payment_mode_master (PaymentModeId,"
        . "PaymentModeTitle,Active) VALUES (@PaymentModeId,\"@PaymentModeTitle\",@Active);");
class PaymentModeMasterController extends ApiController{
    
    private function getTableObj() {
        return new Table\PaymentModeMasterTable();
    }
    
    public function getPaymetModes() {
        return $this->getTableObj()->getPaymentMode();
    }
    
    public function prepareInsertStatements() {
        $allPaymentMode = $this->getPaymetModes();
        if(!$allPaymentMode){
            return false;
        }
         $preparedStatements = '';

        foreach ($allPaymentMode as $paymentMode) {
            $preparedStatements .= PMM_INS_QRY;
            $preparedStatements = str_replace('@PaymentModeId', $paymentMode->paymentMOdeId, $preparedStatements);
            $preparedStatements = str_replace('@PaymentModeTitle', $paymentMode->paymentModeTitle, $preparedStatements);
            $preparedStatements = str_replace('@Active', $paymentMode->active, $preparedStatements);
        }
        return $preparedStatements;
    }
    
}
