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
        'UC' => 'updateCustomer',
        'PB' => 'payedBill',
        'AWC' => 'addWaitingCustomer',
        'DWC' => 'deleteWaitingCustomer',
        'CF' => 'customerFeedback',
        'CT' => 'closeTable',
        'AAE' => 'addApplicationError',
        'P' => 'print',
        'ATA' => 'addTakeaway',
        'AD' => 'addDelivery'];

    public function index() {
        $this->autoRender = false;
        date_default_timezone_set('GMT');
        $jsonData = $this->request->input();
        Log::debug($jsonData);
        if (empty($jsonData)) {
            $this->response->body(DTO\ErrorDto::prepareError(104));
            Log::error('Upload request data is empty');
            return;
        }
        $result = UploadDTO\MainUploadDto::Deserialize($jsonData);
        $userData = UploadDTO\UserUploadDto::Deserialize($result->user);
        if (!isset($userData->restaurantId)) {
            $userData->restaurantId = parent::readCookie('cri');
            $userData->userId = parent::readCookie('aui');
            $userData->password = parent::readCookie('pw');
        }
        $restaurantController = new RestaurantController();
        if (!$restaurantController->isValidate($userData->restaurantId)) {
            $this->response->body(DTO\ErrorDto::prepareError(100));
            \Cake\Log\Log::error("request with incorrect restaurantId :- " . $userData->restaurantId);
            return;
        }
        $restaurantIMEIController = new RestaurantImeiController();
        if (!$restaurantIMEIController->isPresent($userData->restaurantId, $userData->imei, $this->isNull($userData->macId))) {
            $this->response->body(DTO\ErrorDto::prepareError(116));
            \Cake\Log\Log::error("request with incorrect restaurantId :- " . $userData->restaurantId);
            return;
        }
        $userController = new UserController();
        $userValidateResult = $userController->validateUserForUpload(
                $userData->userId, $userData->password, $userData->restaurantId);
        if (is_null($userValidateResult)) {
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
                    $orderResponse = $this->placeOrder($operationData, $userData);
                    if ($orderResponse) {
                        $this->response->body(DTO\ErrorDto::prepareSuccessMessage($orderResponse));
                    } else {
                        $this->response->body(DTO\ErrorDto::prepareError(129));
                    }
                    break;
                case $this->operations['TO']:
                    $operationData = $record->operationData;
                    $result = $this->tableOccupy($operationData, $userData);
                    if ($result) {
                        $this->response->body(DTO\ErrorDto::prepareSuccessMessage($result));
                    } else {
                        $this->response->body(DTO\ErrorDto::prepareError(110));
                    }
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
                case $this->operations['DWC']:
                    $operationData = $record->operationData;
                    $this->deleteWaitingCustomer($operationData, $userData);
                    break;
                case $this->operations['CF']:
                    $operationData = $record->operationData;
                    $this->addCustomerFeedback($operationData, $userData);
                    break;
                case $this->operations['CT']:
                    $operationData = $record->operationData;
                    $this->closeTable($operationData, $userData);
                    break;
                case $this->operations['P']:
                    $operationData = $record->operationData;
                    $this->printBill($operationData, $userData);
                    break;
                case $this->operations['ATA']:
                    $operationData = $record->operationData;
                    $this->addTakeaway($operationData, $userData);
                    break;
                case $this->operations['UC']:
                    $operationData = $record->operationData;
                    $this->updateCustomer($operationData, $userData);
                    break;
                case $this->operations['AAE']:
                    $operationData = $record->operationData;
                    $this->addApplicationError($operationData, $userData);
                    break;
                case $this->operations['AD']:
                    $operationData = $record->operationData;
                    $this->addDelivery($operationData, $userData);
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
        $orderController = new OrderController();
        $orderCheck = $orderController->orderCheck(
                $orderUploadRequest->custId, $userInfo->restaurantId, BILLED_ORDER_STATUS);
        if ($orderCheck) {
            $this->response->body(DTO\ErrorDto::prepareError(105));
            return;
        }
        $menuIdList = null;
        $menuIdLoopCounter = 0;
        $subMenuIdLoopCounter = 0;
        $subMenuList = null;
        foreach ($orderUploadRequest->orderDetails as $menuItemIndex => $menuItemRecord) {
            if ($menuItemRecord->orderQty) {
                if ($menuItemRecord->subMenuId) {
                    $subMenuList[$subMenuIdLoopCounter++] = $menuItemRecord->subMenuId;
                } else {
                    $menuIdList[$menuIdLoopCounter] = $menuItemRecord->menuId;
                }
            }
            if (isset($menuItemRecord->note)) {
                $note = $menuItemRecord->note;
            } else {
                $note = null;
            }
            $orderNote[$menuItemRecord->menuId] = $note;
            $menuIdLoopCounter++;
        }
        if (!count($menuIdList) and ! count($subMenuList)) {
            $this->response->body(DTO\ErrorDto::prepareError(117));
            \Cake\Log\Log::error("request with zero menu quantity");
            return;
        }
        $orderTotalAmt = 0;
        $orderLoopCounter = 0;
        $orderDetailList[] = NULL;
        $MenuInfoList = null;
        $menuController = new MenuController();
        if (count($menuIdList)) {
            $MenuInfoList = $menuController->getMenuItemList(
                    $userInfo->restaurantId, $menuIdList);
        }
        $SubMenuInfo = null;
        if (count($subMenuList)) {
            $subMenuController = new SubMenuController();
            $SubMenuInfo = $subMenuController->getSubMenu($subMenuList);
        }
        if (is_null($MenuInfoList) and is_null($SubMenuInfo)) {
            $this->response->body(DTO\ErrorDto::prepareError(117));
            \Cake\Log\Log::error("request with zero menu quantity");
            return;
        }
        if ($MenuInfoList) {
            foreach ($MenuInfoList as $menuInfo) {
                $resultArray = $this->search($orderUploadRequest->orderDetails, "menuId", $menuInfo->menuId);
                $menuQty = $resultArray->orderQty;
                $orderTotalAmt += $menuQty * $menuInfo->price;
                $orderDetailEntryDto = new UploadDTO\OrderDetailEntryDto(
                        $orderUploadRequest->orderId, $menuQty, $menuQty * $menuInfo->price, $menuInfo->menuId, $menuInfo->subMenuId, $menuInfo->menuTitle, $menuInfo->price, $orderNote[$menuInfo->menuId]);
                $orderDetailList[$orderLoopCounter] = $orderDetailEntryDto;
                $orderLoopCounter++;
            }
        }
        if ($SubMenuInfo) {
            foreach ($SubMenuInfo as $menuInfo) {
                $resultArray = $this->subMenuSearch(
                        $orderUploadRequest->orderDetails, "menuId", $menuInfo->menuId, "subMenuId", $menuInfo->subMenuId);
                $menuQty = $resultArray->orderQty;
                $orderTotalAmt += $menuQty * $menuInfo->price;
                $orderDetailEntryDto = new UploadDTO\OrderDetailEntryDto(
                        $orderUploadRequest->orderId, $menuQty, $menuQty * $menuInfo->price, $menuInfo->menuId, $menuInfo->subMenuId, $menuInfo->menuTitle . '  ' . $menuInfo->subMenuTitle, $menuInfo->price, $orderNote[$menuInfo->menuId]);
                $orderDetailList[$orderLoopCounter] = $orderDetailEntryDto;
                $orderLoopCounter++;
            }
        }
        $orderStatus = PLACED_ORDER_STATUS;
        $rConfigSettingController = new RConfigSettingsController();
        if ($rConfigSettingController->allow($userInfo->restaurantId, KOT_CONFIG_KEY)) {
            $orderStatus = FULFILLED_ORDER_STATUS;
        }
        $this->transBegin();
        $maxOrderNo = $orderController->getMaxOrderNo($userInfo->restaurantId);
        $orderEntryDto = new UploadDTO\OrderEntryDto(
                $orderUploadRequest->orderId, $maxOrderNo, $orderTotalAmt, $userInfo->restaurantId, $orderUploadRequest->custId, $this->isZero($orderUploadRequest->tableId), $orderStatus, $userInfo->userId, $this->isZero($orderUploadRequest->takeawayNo), $this->isZero($orderUploadRequest->deliveryNo), $orderUploadRequest->orderType
        );
        $orderHeaderEntrySucceded = $orderController->addOrderEntry($orderEntryDto);
        if ($orderHeaderEntrySucceded == 0) {
            $this->transRollback();
            Log::error('No order entry was inserted into db');
            return;
        }
        $orderDetailController = new OrderDetailsController();
        $orderDetailEntrySucceeded = $orderDetailController->addOrderEntries($orderDetailList, $userInfo);
        if ($orderDetailEntrySucceeded == 0) {
            $this->transRollback();
            Log::error('No order entry was inserted for order details into db');
            return;
        }
        $this->transCommit();
        return $orderHeaderEntrySucceded;
    }

    function search($arrayToSearch, $key, $value) {
        $resultObject = NULL;

        $arrayCounter = 0;
        foreach ($arrayToSearch as $item => $record) {
            if ($record->$key == $value) {
                $resultObject = $record;
            }
        }
        return $resultObject;
    }

    public function subMenuSearch($arrayToSearch, $key, $value, $subKey, $subValue) {
        $resultObject = NULL;

        $arrayCounter = 0;
        foreach ($arrayToSearch as $item => $record) {
            if ($record->$key == $value and $record->$subKey == $subValue) {
                $resultObject = $record;
            }
        }
        return $resultObject;
    }

    private function tableOccupy($operationData, $userInfo) {

        $tableOccupyUploadRequest = UploadDTO\RTableUploadDto::Deserialize($operationData);
        $rtableController = new RTablesController();

        return $rtableController->occupyTable(
                        $tableOccupyUploadRequest, $userInfo->restaurantId);
    }

    private function generateBill($operationData, $userInfo) {
        $generateBillUploadrequest = UploadDTO\BillUploadDto::Deserialize($operationData);

        if (!$generateBillUploadrequest) {
            Log::error('Generate Bill details not serialized correctly');
            return false;
        }

        $orderController = new OrderController();
        $customerOrders = $orderController->getCustomerOrders(
                $generateBillUploadrequest->custId, $userInfo->restaurantId);
        if (is_null($customerOrders)) {
            Log::error('Bill has already been generated');
            //$this->response->body(DTO\ErrorDto::prepareError(107));
            return 0;
        }
        $billNetAmount = 0;
        $billDetailsList[] = NULL;
        $billDetailsCounter = 0;
        foreach ($customerOrders as $order) {
            $billDetailsUploadDto = new UploadDTO\BillDetailsUploadDto(NULL, $order->orderId, $order->orderNo, $order->orderAmt);
            $billNetAmount += $order->orderAmt;
            Log::debug('Bill Net Amount calculated for orderAmt :' . $order->orderAmt);
            $billDetailsList[$billDetailsCounter++] = $billDetailsUploadDto;
        }
        $totalBillTaxAmt = 0;
        $taxController = new TaxController();
        $billTaxList = $taxController->getTax($billNetAmount);
        if (!is_null($billTaxList)) {
            foreach ($billTaxList as $billTax) {
                $totalBillTaxAmt += $billTax->taxAmt;
            }
        }
        $billController = new BillController();
        $totalPayBillAmt = $billNetAmount + $totalBillTaxAmt;
        $maxBillNo = $billController->getMaxBillNo($userInfo->restaurantId);
        if ($totalPayBillAmt) {
            $billEntryDto = new UploadDTO\BillEntryDto(
                    $maxBillNo, $billNetAmount, $totalBillTaxAmt, $totalPayBillAmt, $userInfo->userId, $userInfo->restaurantId, $generateBillUploadrequest->custId, $this->isZero($generateBillUploadrequest->tableId), $this->isZero($generateBillUploadrequest->takeawayNo), $this->isZero($generateBillUploadrequest->deliveryNo));
            $salesReportDto = new DTO\DownloadDTO\SalesHistoryReportDto(
                    $userInfo->restaurantId, date('m'), date('Y'), $billNetAmount, $totalBillTaxAmt, $totalPayBillAmt);
            $generateBillResult = $billController->addBillEntry($billEntryDto);
            Log::debug('your Bill generated for Bill No : ' . $generateBillResult);
            if (!$generateBillResult) {
                Log::error('Bill generation failed');
                $this->response->body(DTO\ErrorDto::prepareError(107));
                return 0;
            }
        } else {

            Log::error('Bill amount not valid so Bill is not generated for given request');
            $this->response->body(DTO\ErrorDto::prepareError(107));
            return;
        }

        foreach ($billDetailsList as $billDetails) {
            $billDetails->billNo = $generateBillResult;
        }
        $billDetailsController = new BillDetailsController();
        $addBillDetailsResult = $billDetailsController->addBillDetails($billDetailsList, $userInfo->userId, $userInfo->restaurantId);
        if (!$addBillDetailsResult) {
            Log::error('Bill details generation failed');
            $this->response->body(DTO\ErrorDto::prepareError(107));
            return 0;
        }
        if (!is_null($billTaxList)) {
            foreach ($billTaxList as $billTax) {
                $billTax->billNo = $generateBillResult;
            }
        }
        $billTaxTransactionsController = new BillTaxTransactionsController();
        $addBillTaxTransactionsResult = $billTaxTransactionsController->
                addBillTaxTransactions($billTaxList);
        if (!$addBillTaxTransactionsResult) {
            Log::error('Bill Tax Tansactions generation failed');
            return;
        }
        $salesHistoryController = new SalesHistoryController();
        $reportResult = $salesHistoryController->makeSalesReportEntry($salesReportDto);
        if (!$reportResult) {
            Log::error('Sales History report data not saved properly');
            $this->response->body(DTO\ErrorDto::prepareError(107));
            return 0;
        }
        $this->response->body(DTO\ErrorDto::prepareSuccessMessage('Bill has been generated', $generateBillResult));
        foreach ($customerOrders as $billedOrder) {
            $changeOrderStatusResult = $orderController->changeOrderStatus(
                    $billedOrder->orderId, BILLED_ORDER_STATUS, $userInfo->restaurantId);
        }
        if (!$changeOrderStatusResult) {
            Log::error('Changing Billed Order status failed');
        }
    }

    private function orderFullfiled($operationData, $userInfo) {
        $orderFulfilledRequest = UploadDTO\OrderStatusUploadDto::Deserialize($operationData);
        if (!is_object($orderFulfilledRequest)) {
            Log::error('OrderFulfilled Request data not deserialized correctly');
            $this->response->body(DTO\ErrorDto::prepareError(109));
            return;
        }
        $orderController = new OrderController();
        $changeOrderStatusResult = $orderController->changeOrderStatus(
                $orderFulfilledRequest->orderId, FULFILLED_ORDER_STATUS, $userInfo->restaurantId);
        if (!$changeOrderStatusResult) {
            Log::error('Changing Billed Order status failed');
        }
        $this->response->body(DTO\ErrorDto::prepareSuccessMessage('Order Status has been changed'));
        return;
    }

    private function payedBill($operationData, $userInfo) {
        $payedBillRequest = UploadDTO\BillPaymentUploadDto::Deserialize($operationData);
        $billController = new BillController();
        $this->transBegin();
        $payedBillResult = $billController->changeBillPaymetStatus(
                $payedBillRequest, $userInfo);
        if ($payedBillResult) {
            $this->response->body(DTO\ErrorDto::prepareSuccessMessage('Bill payment has been done'));
            $transactionController = new TransactionMasterController();
            $reportResult = $transactionController->createTransactionReport(
                    $payedBillRequest->payedBy, $payedBillResult, $userInfo->restaurantId);
            $conditionText = $billController->getBillDetails($payedBillRequest->billNo);
            if (!is_null($conditionText['DeliveryNo'])) {
                $delivery = new DeliveryController();
                $delivery->closeDelivery($conditionText['DeliveryNo']);
            } else if (!is_null($conditionText['TakeawayNo'])) {

                $takeaway = new TakeawayController();
                $takeaway->closeTakeway($conditionText['TakeawayNo']);
            }
            if ($reportResult) {
                $this->transCommit();
            } else {
                $this->transRollback();
            }
            return;
        }
        $this->transRollback();
        $this->response->body(DTO\ErrorDto::prepareError(111));
        return;
    }

    private function addCustomer($operationData, $userInfo) {
        $addCustomerRequest = UploadDTO\CustomerUploadDto::Deserialize($operationData);
        $customerControllr = new CustomerController();
        $addCustomerResult = $customerControllr->addNewCustomer($addCustomerRequest, $userInfo);
        if ($addCustomerResult) {
            $this->response->body(DTO\ErrorDto::prepareSuccessMessage('New customer has been added'));
            return;
        }
        $this->response->body(DTO\ErrorDto::prepareError(112));
    }

    private function addWaitingCustomer($operationData, $userInfo) {
        $addWaitingCustomerRequest = UploadDTO\TableTransactionUploadDto::Deserialize($operationData);
        if (!isset($addWaitingCustomerRequest->userId)) {
            $addWaitingCustomerRequest->userId = $userInfo->userId;
        }
        $tableTransactionController = new TableTransactionController();
        $addWaitingCustomerResult = $tableTransactionController->addNewEntry(
                $addWaitingCustomerRequest, $userInfo);
        $currentHour = date('H.i');
        $timeSlot = $this->getTimeSlot($currentHour);
        Log::debug('Time Slot for current Request :' . $timeSlot);
        $customerVisitInsertData = new UploadDTO\CustomerVisitUpldDto(
                $userInfo->restaurantId, date('m'), date('Y'), date('d'), $timeSlot);
        if ($timeSlot) {
            $customerVisitController = new CustomerVisitController();
            $makeCustomerVisitResult = $customerVisitController->makeCustomerVisitReport($customerVisitInsertData);
            if (!$makeCustomerVisitResult) {
                Log::info('Customer visit could not be added for hour ' . $currentHour);
            }
        }
        if ($addWaitingCustomerResult) {
            $this->response->body(DTO\ErrorDto::prepareSuccessMessage('waiting request added'));
            return;
        }
        $this->response->body(DTO\ErrorDto::prepareError(113));
        return;
    }

    public function deleteWaitingCustomer($operationData, $userInfo) {
        $deleteCustomerRequest = UploadDTO\CustomerUploadDto::Deserialize($operationData);
        $customerController = new CustomerController();
        $closeTableRequest = new UploadDTO\TableTransactionUploadDto(null, null, $deleteCustomerRequest->custId);
        $tableTransactionController = new TableTransactionController();
        $tableTransactionResult = $tableTransactionController->deleteTransactionEntry($closeTableRequest, $userInfo);
        $customerResult = $customerController->deleteEntry($deleteCustomerRequest, $userInfo);
        if ($customerResult and $tableTransactionResult) {
            $this->response->body(DTO\ErrorDto::prepareSuccessMessage($deleteCustomerRequest->custName . ' has been removed from list'));
            return;
        }
        $this->response->body(DTO\ErrorDto::prepareError(119));
        return;
    }

    private function addCustomerFeedback($operationData, $userInfo) {
        $addCustomerFeedbackRequest = UploadDTO\CustomerFeedbackUploadDto::Deserialize($operationData);
        $customerFeedbackController = new CustomerFeedbackController();
        $addCustomerFeedbackResult = $customerFeedbackController->addCustomerFeedback($addCustomerFeedbackRequest, $userInfo);
        if ($addCustomerFeedbackResult) {
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
        if ($closeTableResult) {
            $this->response->body(DTO\ErrorDto::prepareSuccessMessage('Table record has been deleted from table transaction'));
            return;
        }
        $this->response->body(DTO\ErrorDto::prepareError(115));
        return;
    }

    public function addTakeaway($operationData, $userInfo) {
        $addTakeawayRequest = UploadDTO\TakeawayUploadDto::Deserialize($operationData);
        $takeawayController = new TakeawayController();
        $addTakeawayRequest->takeawayNo = $takeawayController->getTakeawayNo($userInfo->restaurantId);
        $addTakeawayRequest->userId = $userInfo->userId;
        $takeawayResult = $takeawayController->addTakeawayEntry($addTakeawayRequest, $userInfo);
        if ($takeawayResult) {
            $this->response->body(DTO\ErrorDto::prepareSuccessMessage($takeawayResult));
            return;
        }
        $this->response->body(DTO\ErrorDto::prepareError(120));
        return;
    }

    private function updateCustomer($operationData, $userInfo) {
        $customerUpdateRequest = UploadDTO\CustomerUpdateDto::Deserialize($operationData);
        $customerControllr = new CustomerController();
        $customerUpdateResult = $customerControllr->updateCustomer($customerUpdateRequest);
        if (is_null($customerUpdateResult)) {
            $this->response->body(DTO\ErrorDto::prepareError(138));
        } elseif ($customerUpdateResult) {
            $this->response->body(DTO\ErrorDto::prepareSuccessMessage('Customer information added.'));
        } else {
            $this->response->body(DTO\ErrorDto::prepareError(139));
        }
    }

    private function addApplicationError($operationData, $userInfo) {
        $addErrorRequest = UploadDTO\ApplicationErrorUploadDto::Deserialize($operationData);
        $applicationErrorControllr = new ApplicationErrorController();
        $addErrorResult = $applicationErrorControllr->AddError($addErrorRequest, $userInfo);
        if ($addErrorResult) {
            $this->response->body(DTO\ErrorDto::prepareError(99));
        } else {
            $this->response->body(DTO\ErrorDto::prepareError(140));
        }
    }

    private function addDelivery($operationData, $userInfo) {
        $addDeliveryRequest = UploadDTO\DeliveryUploadDto::Deserialize($operationData);
        $deliveryController = new DeliveryController();
        $addDeliveryRequest->deliveryNo = $deliveryController->getDeliveryNo($userInfo->restaurantId);
        $addDeliveryRequest->userId = $userInfo->userId;
        $takeawayResult = $deliveryController->addDeliveryEntry($addDeliveryRequest, $userInfo);
        if ($takeawayResult) {
            $this->response->body(DTO\ErrorDto::prepareSuccessMessage($takeawayResult));
            return;
        }
        $this->response->body(DTO\ErrorDto::prepareError(120));
        return;
    }

}
