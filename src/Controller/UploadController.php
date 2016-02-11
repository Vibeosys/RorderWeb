<?php

namespace App\Controller;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//use App\Model\Table;
use Cake\Log\Log;
use App\DTO;
use App\DTO\UploadDTO;

/**
 * Description of UploadController
 *
 * @author niteen
 */
class UploadController extends ApiController {

    private $operations = ['PO' => 'placeOrder','TO' => 'tableOccupy','GB' => 'generateBill'];

    public function index() {
        $this->autoRender = false;
        date_default_timezone_set('GMT');
        $jsonData = $this->request->input();
        if (empty($jsonData)) {
            $this->response->body(DTO\ErrorDto::prepareError(104));
            Log::error('Uploaded data is empty');
            return;
        }
        $result = UploadDTO\MainUploadDto::Deserialize($jsonData);
        $userData = UploadDTO\UserUploadDto::Deserialize($result->user);
        $userController = new UserController();
        $userValidateResult = $userController->validateUserForUpload($userData->userId, $userData->password, $userData->restaurantId);
        if (!$userValidateResult) {
            $this->response->body(DTO\ErrorDto::prepareError(102));
            \Cake\Log\Log::error("request with incorrect  userId :- " . $userData->userId);
            return;
        }

        $uploadResult = false;
        if (!$result->data) {
            Log::error("No data found for the request, data is blank");
            return;
        }
        foreach ($result->data as $index => $record) {
            switch ($record->operation) {

                case $this->operations['PO']:
                    $operationData = $record->operationData;
                    $orderNo = $this->placeOrder($operationData, $userData);
                    $this->response->body(DTO\ErrorDto::prepareSuccessMessage($orderNo));
                    /* if ($record->operationData) {

                      $orderUploadDto = new UploadDTO\OrderUploadDto(
                      $record->tableData->orderId, $record->tableData->custId, $record->tableData->orderStatus, $record->tableData->orderDate, $record->tableData->orderTime, $record->tableData->orderAmount, $record->tableData->userId, $record->tableData->tableId);
                      $orderController = new OrderController();
                      $uploadResult = $orderController->placeOrder($userData->userId, $userData->restaurantId, $orderUploadDto);

                      if ($uploadResult) {
                      if (is_integer($uploadResult)) {
                      $this->response->body(DTO\ErrorDto::prepareSuccessMessage('Order has been placed for Order Number :- ' . $uploadResult));
                      } else {
                      $this->response->body(DTO\ErrorDto::prepareSuccessMessage('Order has been updated for Order Number'));
                      }
                      } else {
                      $this->response->body(DTO\ErrorDto::prepareError(105));
                      }
                      } */
                    break;
                 case $this->operations['TO']:
                     $operationData = $record->operationData;
                     $result = $this->tableOccupy($operationData, $userData);
                    $this->response->body(DTO\ErrorDto::prepareSuccessMessage($result));
                  break; 
                case $this->operations['GB']:
                    $operationData = $record->operationData;
                    $result = $this->generateBill($operationData, $userData);
                   
                  break;
                default :
                    echo 'Operation name didnt match';
                    break;
            }
        }
    }

    /**
     * Submits order to database, by getting records from Menu table, calculating 
     * Inserts into Order and Order details table with appropriate qty.
     * @param type $operationData
     * @param type $userInfo
     * @return type 
     */
    private function placeOrder($operationData, $userInfo) {
        $orderUploadRequest = UploadDTO\OrderUploadDto::Deserialize($operationData);
        if (!is_array($orderUploadRequest->orderDetails)) {
            Log::error("No menu items are provided or wrong element in JSON");
            return NULL;
        }
        $menuIdList[] = null;
        $menuIdLoopCounter = 0;
        foreach ($orderUploadRequest->orderDetails as $menuItemIndex => $menuItemRecord) {
            $menuIdList[$menuIdLoopCounter] = $menuItemRecord->menuId;
            $menuIdLoopCounter++;
        }
        $orderTotalAmt = 0;
        $orderLoopCounter = 0;
        $orderDetailList[] = NULL;
        $menuController = new MenuController();
        $resultMenuInfoList = $menuController->getMenuItemList($userInfo->restaurantId, $menuIdList);
        foreach ($resultMenuInfoList as $menuInfo) {
            $resultArray = $this->search($orderUploadRequest->orderDetails, "menuId", $menuInfo->menuId);
            $menuQty = $resultArray->orderQty;
            $orderTotalAmt += $menuQty * $menuInfo->price;
            $orderDetailEntryDto = new UploadDTO\OrderDetailEntryDto(
                    $orderUploadRequest->orderId, $menuQty, $menuQty * $menuInfo->price, $menuInfo->menuId, $menuInfo->menuTitle, $menuInfo->price);
            $orderDetailList[$orderLoopCounter] = $orderDetailEntryDto;
            $orderLoopCounter++;
        }
        $orderController = new OrderController();
        $maxOrderNo = $orderController->getMaxOrderNo($userInfo->restaurantId);
        $orderEntryDto = new UploadDTO\OrderEntryDto(
                $orderUploadRequest->orderId, 
                $maxOrderNo, 
                $orderTotalAmt, 
                $userInfo->restaurantId, 
                $orderUploadRequest->custId, 
                $orderUploadRequest->tableId, 
                1, //order status 1 means placed.
                $userInfo->userId
        );
        $orderHeaderEntrySucceded = $orderController->addOrderEntry($orderEntryDto);
        if($orderHeaderEntrySucceded == 0)
        {
            Log::error('No order entry was inserted into db');
            return;        
        }
        $orderDetailController = new OrderDetailsController();
        $orderDetailEntrySucceeded = $orderDetailController->addOrderEntries($orderDetailList,$userInfo);
        if($orderDetailEntrySucceeded == 0)
         {
            Log::error('No order entry was inserted for order details into db');
            return;        
        }
        return $maxOrderNo;
    }

    function search($arrayToSearch, $key, $value) {
        $resultObject = NULL;

        $arrayCounter = 0;
        foreach ($arrayToSearch as $item => $record) {
            if($record->$key == $value)
            {
                $resultObject = $record;
            }
        }

        return $resultObject;
    }
    
    private function tableOccupy($operationData , $userInfo) {
        
        $tableOccupyUploadRequest = UploadDTO\RTableUploadDto::Deserialize($operationData);
        $rtableController = new RTablesController();
       
        return $rtableController->occupyTable($tableOccupyUploadRequest);
    }
    
    private function generateBill($operationData, $userInfo) {
        $generateBillUploadrequest = UploadDTO\BillUploadDto::Deserialize($operationData);
        
        if(!$generateBillUploadrequest){
            Log::error('Generate Bill details not serialized correctly');
            return false;
        }
        
        $orderController = new OrderController();
        $customerOrders = $orderController->getCustomerOrders(
                $generateBillUploadrequest->custId,$userInfo->restaurantId);
        if(is_null($customerOrders)){
            $this->response->body(DTO\ErrorDto::prepareError(106));
            return;
        }
        $billNetAmount = 0;
        $billDetailsList[] = NULL;
        $billDetailsCounter = 0;
        foreach ($customerOrders as $order){
            $billDetailsUploadDto = new UploadDTO\BillDetailsUploadDto(NULL,
                    $order->orderId, 
                    $order->orderNo, 
                    $order->orderAmt);
            $billNetAmount += $order->orderAmt;
            Log::debug('Bill Net Amount calculated for orderAmt :'.$order->orderAmt);
            $billDetailsList[$billDetailsCounter++] = $billDetailsUploadDto;
        }
        $totalBillTaxAmt = 0;
        $taxController = new TaxController();
        $billTaxList = $taxController->getTax($billNetAmount);
        foreach ($billTaxList as $billTax){
            $totalBillTaxAmt += $billTax->taxAmt;
        }
        $totalPayBillAmt = $billNetAmount + $totalBillTaxAmt;
        $billController = new BillController();
         $maxBillNo = $billController->getMaxBillNo($userInfo->restaurantId);
        if($totalPayBillAmt){
            $billEntryDto = new UploadDTO\BillEntryDto(
                    $maxBillNo,
                    $billNetAmount, 
                    $totalBillTaxAmt, 
                    $totalPayBillAmt, 
                    $userInfo->userId, 
                    $userInfo->restaurantId, 
                    $generateBillUploadrequest->custId, 
                    $generateBillUploadrequest->tableId);
            $generateBillResult = $billController->addBillEntry($billEntryDto); 
            Log::debug('your Bill generated for Bill No : '.$generateBillResult);
            if(!$generateBillResult){
                Log::error('Bill generation failed');
                return 0;
            }
        }  else {
        
            Log::error('Bill amount not valid so Bill is not generated for given request');
            return;
        }
        
        foreach ($billDetailsList as $billDetails){
            $billDetails->billNo = $generateBillResult;
        }
        $billDetailsController = new BillDetailsController();
        $addBillDetailsResult = $billDetailsController->addBillDetails($billDetailsList, $userInfo->userId, $userInfo->restaurantId);
        if(!$addBillDetailsResult){
                Log::error('Bill details generation failed');
                return 0;
        }
        foreach ($billTaxList as $billTax){
            $billTax->billNo = $generateBillResult;
        }
        $billTaxTransactionsConreoller = new BillTaxTransactionsController();
        $addBillTaxTransactionsResult = $billTaxTransactionsConreoller->addBillTaxTransactions($billTaxList);
        if(!$addBillTaxTransactionsResult){
                Log::error('Bill Tax Tansactions generation failed');
                return 0;
        }
         $this->response->body(DTO\ErrorDto::prepareSuccessMessage('Bill has been generated'));
        
        

        
        
    }

}
