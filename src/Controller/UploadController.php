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

    private $operations = [
        'PO' => 'placeOrder',
        'TO' => 'tableOccupy',
        'GB' => 'generateBill', 
        'OFF' => 'orderFulfilled',
        'AC' => 'addCustomer',
        'PB' => 'payedBill',
        'AWC' => 'addWaitingCustomer',
        'CF' =>'customerFeedback',
        'CT' =>'closeTable'];

    public function index() {
        $this->autoRender = false;
        date_default_timezone_set('GMT');
        $jsonData = $this->request->input();
        if (empty($jsonData)) {
            $this->response->body(DTO\ErrorDto::prepareError(104));
            Log::error('Upload request data is empty');
            return;
        }
        $result = UploadDTO\MainUploadDto::Deserialize($jsonData);
        $userData = UploadDTO\UserUploadDto::Deserialize($result->user);
        $userController = new UserController();
        $userValidateResult = $userController->validateUserForUpload(
                $userData->userId, 
                $userData->password, 
                $userData->restaurantId);
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
                    break;
                 case $this->operations['TO']:
                     $operationData = $record->operationData;
                     $result = $this->tableOccupy($operationData, $userData);
                     if($result){
                         $this->response->body(DTO\ErrorDto::prepareSuccessMessage($result));
                         return;
                     }
                     $this->response->body(DTO\ErrorDto::prepareError(110));
                  break; 
                case $this->operations['GB']:
                    $operationData = $record->operationData;
                    $result = $this->generateBill($operationData, $userData);
                  break;
                case $this->operations['PB']:
                    $operationData = $record->operationData; 
                    $this->payedBill($operationData, $userData);
                    break;
                case $this->operations['OFF']:
                       $operationData = $record->operationData; 
                       $this->orderFullfiled($operationData, $userData);
                  break; 
                case $this->operations['AC']:
                    $operationData = $record->operationData; 
                    $this->addCustomer($operationData, $userData);
                    break;
                case $this->operations['AWC']:
                    $operationData = $record->operationData;
                    $this->addWaitingCustomer($operationData, $userData);
                    break;
                case $this->operations['CF']:
                    $operationData = $record->operationData;
                    $this->addCustomerFeedback($operationData, $userData);
                    break;
                case $this->operations['CT']:
                    $operationData = $record->operationData;
                    $this->closeTable($operationData, $userData);
                    break;
                default :
                    $this->response->body(DTO\ErrorDto::prepareError(108));
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
       
        return $rtableController->occupyTable(
                $tableOccupyUploadRequest ,
                $userInfo->restaurantId);
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
        if(!is_null($billTaxList)){
            foreach ($billTaxList as $billTax){
                $totalBillTaxAmt += $billTax->taxAmt;
            }
        }
        $totalPayBillAmt = $billNetAmount + $totalBillTaxAmt;
        $totalPayBillAmt = round($totalPayBillAmt, 2);
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
            $this->response->body(DTO\ErrorDto::prepareError(107));
            return;
        }
        
        foreach ($billDetailsList as $billDetails){
            $billDetails->billNo = $generateBillResult;
        }
        $billDetailsController = new BillDetailsController();
        $addBillDetailsResult = $billDetailsController->addBillDetails($billDetailsList, $userInfo->userId, $userInfo->restaurantId);
        if(!$addBillDetailsResult){
                Log::error('Bill details generation failed');
                $this->response->body(DTO\ErrorDto::prepareError(107));
                return 0;
        }
        if(!is_null($billTaxList)){
            foreach ($billTaxList as $billTax){
                $billTax->billNo = $generateBillResult;
            }
        }
        $billTaxTransactionsController = new BillTaxTransactionsController();
        $addBillTaxTransactionsResult = $billTaxTransactionsController->
                addBillTaxTransactions($billTaxList);
        if(!$addBillTaxTransactionsResult){
                Log::error('Bill Tax Tansactions generation failed');
                
        }
         $this->response->body(DTO\ErrorDto::prepareSuccessMessage('Bill has been generated'));
         foreach ($customerOrders as $billedOrder){
             $changeOrderStatusResult = $orderController->changeOrderStatus(
                     $billedOrder->orderId, 
                     BILLED_ORDER_STATUS,
                     $userInfo->restaurantId);
         }
         if(!$changeOrderStatusResult){
             Log::error('Changing Billed Order status failed');
         }
    }
    
    private function orderFullfiled($operationData, $userInfo) {
        $orderFulfilledRequest = UploadDTO\OrderStatusUploadDto::Deserialize($operationData);
        if(!is_object($orderFulfilledRequest)){
            Log::error('OrderFulfilled Request data not deserialized correctly');
            $this->response->body(DTO\ErrorDto::prepareError(109));
            return ;
        }
        $orderController = new OrderController();
        $changeOrderStatusResult = $orderController->changeOrderStatus(
                     $orderFulfilledRequest->orderId, 
                     FULFILLED_ORDER_STATUS,
                     $userInfo->restaurantId);
        if(!$changeOrderStatusResult){
             Log::error('Changing Billed Order status failed');
        }
        $this->response->body(DTO\ErrorDto::prepareSuccessMessage('Order Status has been changed'));
        return;
    }
    
    private function payedBill($operationData, $userInfo) {
        $payedBillRequest = UploadDTO\BillPaymentUploadDto::Deserialize($operationData);
        $billController = new BillController();
        $payedBillResult = $billController->changeBillPaymetStatus($payedBillRequest, $userInfo);
        if($payedBillResult){
            $this->response->body(DTO\ErrorDto::prepareSuccessMessage('Bill payment has been done'));
            return ;
        }
        $this->response->body(DTO\ErrorDto::prepareError(111));
        return;
    }
    
    private function addCustomer($operationData, $userInfo) {
        $addCustomerRequest = UploadDTO\CustomerUploadDto::Deserialize($operationData);
        $customerControllr = new CustomerController();
        $addCustomerResult = $customerControllr->addNewCustomer($addCustomerRequest, $userInfo);
        if($addCustomerResult){
            $this->response->body(DTO\ErrorDto::prepareSuccessMessage('New customer has been added'));
            return ;
        }
        $this->response->body(DTO\ErrorDto::prepareError(112));
    }
    
    private function addWaitingCustomer($operationData, $userInfo) {
        $addWaitingCustomerRequest = UploadDTO\TableTransactionUploadDto::Deserialize($operationData);
        $tableTransactionController = new TableTransactionController();
        $addWaitingCustomerResult = $tableTransactionController->addNewEntry($addWaitingCustomerRequest, $userInfo);
        if($addWaitingCustomerResult){
            $this->response->body(DTO\ErrorDto::prepareSuccessMessage('waiting request added'));
            return;
        }
        $this->response->body(DTO\ErrorDto::prepareError(113));
        return;
    }
    
    private function addCustomerFeedback($operationData, $userInfo) {
        $addCustomerFeedbackRequest = UploadDTO\CustomerFeedbackUploadDto::Deserialize($operationData);
        $customerFeedbackController = new CustomerFeedbackController();
        $addCustomerFeedbackResult = $customerFeedbackController->addCustomerFeedback($addCustomerFeedbackRequest, $userInfo);
         if($addCustomerFeedbackResult){
            $this->response->body(DTO\ErrorDto::prepareSuccessMessage('Customer feedback saved successfully'));
            return;
        }
        $this->response->body(DTO\ErrorDto::prepareError(114));
        return;
    }
    
    private function closeTable($operationData, $userInfo) {
         $closeTableRequest = UploadDTO\TableTransactionUploadDto::Deserialize($operationData);
        $tableTransactionController = new TableTransactionController();
        $closeTableResult = $tableTransactionController->deleteTransactionEntry($closeTableRequest, $userInfo);
        if($closeTableResult){
            $this->response->body(DTO\ErrorDto::prepareSuccessMessage('Table record has been deleted from table transaction'));
            return;
        }
        $this->response->body(DTO\ErrorDto::prepareError(115));
        return;
    }

}
