<?php

namespace App\Controller;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use App\Model\Table;
use Cake\Log\Log;
use App\DTO\UploadDTO;
use App\DTO\DownloadDTO;
use App\DTO;

/**
 * Description of BillController
 *
 * @author niteen
 */
class BillController extends ApiController {

    private $insert = 'insert';

    private function getTableObj() {

        return new Table\BillTable();
    }

    public function getMaxBillNo($restaurantId) {
        $billNo = $this->getTableObj()->getBillNo($restaurantId);
        if ($billNo) {
            return $billNo + 1;
        } else {
            return 1;
        }
    }

    public function addBillEntry($billEntryDto) {
        $billEntryResult = $this->getTableObj()->insert($billEntryDto);
        if ($billEntryResult) {
            Log::debug('you bill is generated');
            $billEntryDto->tableId = $this->isNull($billEntryDto->tableId);
            $billEntryDto->takeawayNo = $this->isNull($billEntryDto->takeawayNo);
            $billEntryDto->deliveryNo = $this->isNull($billEntryDto->deliveryNo);
            $result = $this->makeSyncEntry($billEntryDto);
            return $billEntryResult;
        }
        return false;
    }

    public function getBillDetails($billNo) {
        return $this->getTableObj()->getTakeawayAndDeliveryDetails($billNo);
    }
    
    public function getBillToPrint($billNo, $restaurantId){
        return $this->getTableObj()->getBillToPrint($billNo, $restaurantId);
    }

    public function getBill($tableId, $takeawayNo, $deliveryNo) {
        if (isset($tableId) or isset($takeawayNo) or isset($deliveryNo)) {
            return $this->getTableObj()->getCustomerBill($tableId, $takeawayNo, $deliveryNo);
        }
        return null;
    }

    public function changeBillPaymetStatus($billPaymentRequest, $userInfo) {
        $chagePaymentStatusResult = $this->getTableObj()->changePaymentStatus(
                $billPaymentRequest, $userInfo->restaurantId);
        if ($chagePaymentStatusResult) {
            $syncController = new SyncController();
            $newBillEntry = $this->getTableObj()->getNewBill(
                    $billPaymentRequest->billNo, $userInfo->restaurantId, $userInfo->userId);
            $syncController->billEntry($userInfo->userId, json_encode($newBillEntry), UPDATE_OPERATION, $userInfo->restaurantId);
            Log::debug('Payment is done successfully for BillNo :- ' . $billPaymentRequest->billNo);
            return $chagePaymentStatusResult;
        }
        Log::error('Error in Payment for BillNo :- ' . $billPaymentRequest->billNo);
        return $chagePaymentStatusResult;
    }

    private function makeSyncEntry(UploadDTO\BillEntryDto $billEntryDto) {

        $newBillEntry = $this->getTableObj()->getNewBill(
                $billEntryDto->billNo, $billEntryDto->restaurantId, $billEntryDto->userId);
        if (!is_null($newBillEntry)) {
            $syncController = new SyncController();
            $syncResult = $syncController->billEntry($billEntryDto->userId, json_encode($newBillEntry), $this->insert, $billEntryDto->restaurantId);
            Log::debug(' New bill entry successfully place in sync table');
            return $syncResult;
        }
        Log::error('Error occured in sync entry of new bill');
        return;
    }

    public function displayBill() {
        $this->autoRender = FALSE;
        $restId = parent::readCookie('cri');
        $request = $this->request->query;
        Log::debug($request);
        Log::debug('Current restaurantId in order controller :- ' . $restId);
        if (isset($restId)) {
            $tableId = $request['table'];
            $takeawayNo = $request['takeaway'];
            $deliveryNo = $request['delivery'];
            Log::debug('Now bill list shows for table :-' . $tableId . 'or for takeawayNo :- ' . $takeawayNo);
            $latestBill = $this->getTableObj()->getTableBill($tableId, $takeawayNo, $deliveryNo, $restId);
            if (is_null($latestBill)) {
                $this->response->body(json_encode([MESSAGE => DTO\ErrorDto::prepareMessage(126)]));
                return;
            }
            $userController = new UserController();
            $rtableController = new RTablesController();
            foreach ($latestBill as $bill) {
                $user = $userController->getUserName($bill->user);
                $bill->user = $user->userName;
                $bill->tableNo = $rtableController->getBillTableNo($bill->tableNo);
                $bill->date = date('d-m-Y H:i', strtotime('+330 minutes', strtotime($bill->date)));
            }
            if ($this->request->is('ajax')) {
                $response = json_encode($latestBill);
                Log::debug($response);
                $this->response->body($response);
            }
        } else if ($this->request->is('ajax')) {
            $this->response->body(json_encode([MESSAGE => DTO\ErrorDto::prepareMessage(126)]));
        }
    }

    public function getDiscountAmount() {
        $this->autoRender = FALSE;
        if (!$this->isLogin()) {
            $this->response->body(DTO\ErrorDto::prepareError(104));
            return;
        } else if ($this->request->is('post')) {
            $restaurantId = parent::readCookie('cri');
            $data = $this->request->data;
            $disAmt = $this->getTableObj()->getDiscount($restaurantId, $data['billNo'], $data['discount']);
            Log::debug('Dicount amount :- ' . $disAmt);
            $this->response->body($disAmt);
        }
    }

    public function getLatestBill() {
        $this->autoRender = FALSE;
        if (!$this->isLogin()) {
            $this->response->body(DTO\ErrorDto::prepareError(104));
            return;
        } else if ($this->request->is('post')) {
            $restaurantId = parent::readCookie('cri');
            $data = $this->request->data;
            Log::debug($data);
            $result = $this->getTableObj()->getBillInfo($data['table'], $data['takeaway'], $data['delivery'], $restaurantId);
            if (is_null($result)) {
                $this->response->body(0);
            } else {
                $this->response->body(json_encode($result));
            }
            Log::debug('data :- ' . json_encode($result));
        }
    }

    public function generateStatus() {
        
    }

    public function billPayment() {
        $paymentModeController = new PaymentModeMasterController();
        $paymentOptions = $paymentModeController->getPaymetModes();
        $this->set(['p_option' => $paymentOptions]);
    }

    public function invalidEntry() {
        
    }

}
