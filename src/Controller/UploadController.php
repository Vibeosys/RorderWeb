<?php
namespace App\Controller;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
use App\Model\Table;
use Cake\Log\Log;
use App\DTO;
use App\DTO\UploadDTO;
/**
 * Description of UploadController
 *
 * @author niteen
 */
class UploadController extends ApiController{
    
    
    private $table = ['OR'=>'orders','OD'=>'order_details','BL'=>'bill','BD'=>'bill_details','RT'=>'r_table'];
    public function index() {
        $this->autoRender = false;
        date_default_timezone_set('GMT');
        $jsonData = $this->request->input();
        if(empty($jsonData)){
            $this->response->body(DTO\ErrorDto::prepareError(104));
            Log::error('Uploaded data is empty');
            return ;
        }
        $result = UploadDTO\MainUploadDto::Deserialize($jsonData);
        $userData = UploadDTO\UserUploadDto::Deserialize($result->user);
        $userController = new UserController();
        if (!$userController->isUserValid($userData->userId, $userData->restaurantId)) {
            $this->response->body(DTO\ErrorDto::prepareError(102));
            \Cake\Log\Log::error("request with incorrect  userId :- ".$userData->userId);
            return;
        } 
        $uploadResult = false;
      if($result->data){
        foreach ($result->data as $index => $record){
            switch ($record->tableName){
                
                case $this->table['OR']:
                   if($record->tableData){
                       
                       $orderUploadDto  = new UploadDTO\OrderUploadDto($record->tableData->orderId, 
                                $record->tableData->orderStatus, 
                               $record->tableData->orderDate, $record->tableData->orderTime, 
                               $record->tableData->orderAmount, $record->tableData->userId, $record->tableData->tableId);
                       $orderController = new OrderController();
                    $uploadResult =  $orderController->placeOrder($userData->userId, $userData->restaurantId, $orderUploadDto);
                   
                   if($uploadResult){
                       if(is_integer($uploadResult)){
                            $this->response->body(DTO\ErrorDto::prepareSuccessMessage('Order has been placed for Order Number :- '.$uploadResult));
                       }else{
                           $this->response->body(DTO\ErrorDto::prepareSuccessMessage('Order has been updated for Order Number'));
                       }
                   }  else {
                       $this->response->body(DTO\ErrorDto::prepareError(105));
                   }
                   }
                    break;
                case $this->table['OD']:
                    if($record->tableData){
                       $orderDetailsUploadDto  = new UploadDTO\OrderDetailsUploadDto($record->tableData->orderDetailsId, 
                                $record->tableData->orderPrice, 
                               $record->tableData->orderQuantity, $record->tableData->orderId, 
                               $record->tableData->menuId, $record->tableData->menuTitle);
                       $orderDetailsController = new OrderDetailsController();
                    $uploadResult =  $orderDetailsController->placeOrderDetails($userData->userId, $userData->restaurantId, $orderDetailsUploadDto);
                   
                   if($uploadResult){
                       if(is_integer($uploadResult)){
                            $this->response->body(DTO\ErrorDto::prepareSuccessMessage('Order Details has been placed for Order Number :- '.$uploadResult));
                       }else{
                           $this->response->body(DTO\ErrorDto::prepareSuccessMessage('Order Details has been updated for Order Number'));
                       }
                   }  else {
                       $this->response->body(DTO\ErrorDto::prepareError(105));
                   }
                   }
                    break;
                case $this->table['BL']:
                    
                    echo 'this is bill case';
                    print_r($record->tableData);
                    break;
                case $this->table['BD']:
                    
                    echo 'this is bill details case';
                    break;
                case $this->table['RT']:
                    
                    echo 'this is rtable case';
                    print_r($record->tableData);
                    break;
                default :
                    echo 'Table Name not match with database';
                    break;
            }
        }
      }
    }
    
}
