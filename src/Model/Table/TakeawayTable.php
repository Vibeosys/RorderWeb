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
use Cake\Datasource\ConnectionManager;
/**
 * Description of TakeawayTable
 *
 * @author niteen
 */
class TakeawayTable extends Table{
    
    private function connect() {
        return TableRegistry::get('takeaway');
    }
    
    public function getTakeaway($restaurantId) {
        $previousDate = date(VB_DATE_TIME_FORMAT, strtotime('-2 hour', strtotime(date(VB_DATE_TIME_FORMAT))));
        $conditions = ['RestaurantId =' => $restaurantId,
                        'CreatedDate >' => $previousDate];
        $order = 'TakeawayNo';
        $takeawayCounter = 0;
        $allTakeaway = null;
        try{
            $results = $this->connect()
                    ->find()
                    ->where($conditions)
                    ->orderDesc($order);
            if($results->count()){
                foreach ($results as $result){
                    $allTakeaway[$takeawayCounter++] = 
                            new DownloadDTO\TakeawayDownloadDto(
                                    $result->TakeawayNo, 
                                    $result->DeliveryCharges, 
                                    $result->SourceId);
                }
            }
            return $allTakeaway;    
        } catch (Exception $ex) {
            return false;
        }
        
    }
    public function getMaxNo($restaurantId) {
        $datasource = ConnectionManager::config('default');
        $connection = mysql_connect($datasource['host'], $datasource['username'], $datasource['password']);
        mysql_select_db($datasource['database'], $connection);
        $query = "call RestaurantDB.getMaxTakeawayNo(".$restaurantId.", @takawaymaxno);";
        $result =  mysql_query($query);
        $data = mysql_fetch_assoc($result);
        mysql_close($connection);
        return  $data['maxId'];
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
    
    public function getSingleTakeaway($takeawayNo , $restaurantId) {
        $conditions = ['RestaurantId =' => $restaurantId,
                        'TakeawayNo =' => $takeawayNo];
        $takeaway = null;
        try{
            $results = $this->connect()
                    ->find()
                    ->where($conditions);
            if($results->count()){
                foreach ($results as $result){
                    $takeaway = new UploadDTO\TakeawayUploadDto(
                                    $result->TakeawayId,
                                    $result->SourceId,
                                    $result->Discount,
                                    $result->DeliveryCharges,
                                    $result->CustId,
                                    $result->TakeawayNo,
                                    $result->UserId,
                                    $result->CreatedDate);
                }
            }
            return $takeaway;    
        } catch (Exception $ex) {
            return false;
        }
    }
}
