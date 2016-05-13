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
 * Description of DeliveryTable
 *
 * @author niteen
 */
class DeliveryTable extends Table{
    
     private function connect() {
        return TableRegistry::get('delivery');
    }
    
    public function getMaxNo($restaurantId) {
        $datasource = ConnectionManager::config('default');
        $connection = mysql_connect($datasource['host'], $datasource['username'], $datasource['password']);
        mysql_select_db($datasource['database'], $connection);
        $query = "call RestaurantDB.getMaxDeliveryNo(".$restaurantId.", @deliverymaxno);";
        $result =  mysql_query($query);
        $data = mysql_fetch_assoc($result);
        mysql_close($connection);
        return  $data['maxId'];
    }
    
    public function insert($request, $restaurantId) {      
        try{
            $tableObj = $this->connect();
            $newEntity = $tableObj->newEntity();
            $newEntity->DeliveryId = $request->deliveryId;
            $newEntity->DeliveryNo = $request->deliveryNo;
            $newEntity->Discount = $request->discount;
            $newEntity->DeliveryCharges = $request->deliveryCharges;
            $newEntity->CustId = $request->custId;
            $newEntity->RestaurantId = $restaurantId;
            $newEntity->UserId = $request->userId;
            $newEntity->SourceId = $request->sourceId;
            $newEntity->CreatedDate = date(VB_DATE_TIME_FORMAT);
            $newEntity->UpdatedDate = date(VB_DATE_TIME_FORMAT);
            if($tableObj->save($newEntity)){
                Log::debug('Delivery entry stored for custId :- '.$request->custId);
                return $request->deliveryNo;
            }
            Log::error('Delivery entry stored for custId :- '.$request->custId);
            return FALSE;
        } catch (Exception $ex) {
            return FALSE;
        }
    }
    
    public function getSingleDelivery($deliveryNo , $restaurantId) {
        $conditions = [
                            'RestaurantId =' => $restaurantId,
                            'DeliveryNo =' => $deliveryNo
                      ];
        $delivery = null;
        try{
            $results = $this->connect()
                    ->find()
                    ->where($conditions);
            if($results->count()){
                foreach ($results as $result){
                    $delivery = new UploadDTO\DeliveryUploadDto(
                                    $result->DeliveryId,
                                    $result->SourceId,
                                    $result->Discount,
                                    $result->DeliveryCharges,
                                    $result->CustId,
                                    $result->DeliveryNo,
                                    $result->UserId,
                                    $result->CreatedDate);
                }
            }
            return $delivery;    
        } catch (Exception $ex) {
            return false;
        }
    }
    
    public function getDelivery($restaurantId) {
        $previousDate = date(VB_DATE_TIME_FORMAT, strtotime('-2 hour', strtotime(date(VB_DATE_TIME_FORMAT))));
         $conditions = [
                            'RestaurantId =' => $restaurantId,
                            'CreatedDate =' => $previousDate
                      ];
        $delivery = FALSE;
        $order = 'DeliveryNo';
        $counter = 0;
        try{
            $results = $this->connect()
                    ->find()
                    ->where($conditions)
                    ->orderAsc($order);
            if($results->count()){
                foreach ($results as $result){
                    $delivery[$counter] = new DownloadDTO\TakeawayDownloadDto(
                                    $result->DeliveryNo,
                                    $result->DeliveryCharges,
                                    $result->SourceId,
                                    $result->Discount,
                                    $result->Status);
                }
            }
            return $delivery;    
        } catch (Exception $ex) {
            return false;
        }
    }
    
    public function getCustomer($deliveryNo, $restaurantId) {
         $condition = array('RestaurantId =' => $restaurantId,'DeliveryNo =' => $deliveryNo);
         $conditions = array(
            'conditions' => $condition,
            'fields' => array('CustId'));
        $data = $this->connect()->find('all', $conditions)->first();
        $result = null;
        if($data){
          $result = $data->CustId;
        }
        return $result;
    }
}
