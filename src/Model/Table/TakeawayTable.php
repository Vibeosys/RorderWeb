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
 * Description of TakeawayTable
 *
 * @author niteen
 */
class TakeawayTable extends Table{
    
    private function connect() {
        return TableRegistry::get('takeaway');
    }
    
    public function addTakeawayEntry() {
        
    }
    public function getMaxNo($restaurantId) {
        $conditions = array(
            'conditions' => array('takeaway.RestaurantId =' => $restaurantId),
            'fields' => array('maxTakeawayNo' => 'MAX(takeaway.TakeawayNo)'));
        $takeawayEntry = $this->connect()->find('all', $conditions)->toArray();
        if ($takeawayEntry) {
            $maxTakeawayNo = $takeawayEntry[0]['maxTakeawayNo'];
            if (is_null($takeawayEntry)) {
                $maxTakeawayNo = 0;
            }
        }
        Log::debug('Order Number generated for new order orderNo is :- ' . $maxTakeawayNo);
        return $maxTakeawayNo;
    }
    
    public function takeawayInsert(UploadDTO\TakeawayUploadDto $takeawayRequest, $restaurantId) {
        
        try{
            $tableObj = $this->connect();
            $newEntity = $tableObj->newEntity();
            $newEntity->TakeawayId = $takeawayRequest->takeawayId;
            $newEntity->TakeawayNo = $takeawayRequest->takeawayNo;
            $newEntity->Discount = $takeawayRequest->discount;
            $newEntity->DeliveryCharges = $takeawayRequest->deliveryCharges;
            $newEntity->CustId = $takeawayRequest->custId;
            $newEntity->RestaurantId = $restaurantId;
            $newEntity->UserId = $takeawayRequest->userId;
            $newEntity->SourceId = $takeawayRequest->sourceId;
            $newEntity->CreatedDate = date(VB_DATE_TIME_FORMAT);
            $newEntity->UpdatedDate = date(VB_DATE_TIME_FORMAT);
            if($tableObj->save($newEntity)){
                Log::debug('Takeaway entry stored for custId :- '.$takeawayRequest->custId);
                return $takeawayRequest->takeawayNo;
            }
            Log::error('Takeaway entry stored for custId :- '.$takeawayRequest->custId);
            return FALSE;
        } catch (Exception $ex) {
            return FALSE;
        }
    }
    
    public function getDiscount($takeawayNo) {
        $conditions = ['TakeawayNo =' => $takeawayNo];
        try{
            $results = $this->connect()->find()->where($conditions);
            if($results->count()){
               foreach ($results as $result){
                  return $result->Discount;
                }
            }
            return FALSE;
        } catch (Exception $ex) {
            return FALSE;
        }
    }
}
