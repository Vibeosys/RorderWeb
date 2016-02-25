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
use App\DTO\DownloadDTO;
/**
 * Description of PaymentModeMasterTable
 *
 * @author niteen
 */
class PaymentModeMasterTable extends Table{
    
    private function connect() {
        return TableRegistry::get('payment_mode_master');
    }
    public function getPaymentMode() {
        $allPaymentMode = null;
        $conditions = ['Active =' => ACTIVE];
        try {
           $paymentModes =  $this->connect()->find()->where($conditions);
           if($paymentModes->count()){
               $allPaymentMode = array();
               $paymentModeCounter = 0;
               foreach ($paymentModes as $paymentMode){
                   $paymentModeDto = new DownloadDTO\PaymentModeDownloadDto(
                           $paymentMode->PaymentModeId, 
                           $paymentMode->PaymentModeTitle,
                           $paymentMode->Active);
               $allPaymentMode[$paymentModeCounter++] = $paymentModeDto;    
               }
           }
           return $allPaymentMode;
        } catch (Exception $ex) {
            return false;
        }
    }
}
