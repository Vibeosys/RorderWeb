<?php

namespace App\Controller;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use App\Model\Table;
use Cake\Log\Log;
use App\DTO\DownloadDTO;
use App\DTO;

/**
 * Description of OrderController
 *
 * @author niteen
 */
class OrderController extends ApiController {

    private $insert = 'insert';
    private $update = 'update';

    private function getTableObj() {
        return new Table\OrderTable();
    }

    public function getMaxOrderNo($restaurantId) {
        $orderNo = $this->getTableObj()->getOrderNo($restaurantId);
        return $orderNo;
    }

    public function addOrderEntry($orderEntry) {
        $orderResponse = $this->getTableObj()->insert($orderEntry);
        if ($orderResponse) {
            $orderEntry->tableId = $this->isNull($orderEntry->tableId);
            $orderEntry->takeawayNo = $this->isNull($orderEntry->takeawayNo);
            $orderEntry->deliveryNo = $this->isNull($orderEntry->deliveryNo);
            $this->makeSyncEntry($orderEntry);
        }
        return $orderResponse;
    }


    private function makeSyncEntry($orderEntry) {
        $newOrder = $this->getTableObj()->getOrder($orderEntry->orderId);
        if ($newOrder) {
            $syncController = new SyncController();
            $result = $syncController->orderEntry(
                    $orderEntry->userId, 
                    json_encode($newOrder), 
                    $this->insert, 
                    $orderEntry->restaurantId);
        }
    }

    public function getCustomerOrders($custId, $restaurantId) {
        if($this->orderCheck($custId, $restaurantId, PLACED_ORDER_STATUS)){
            $this->response->body(DTO\ErrorDto::prepareError(106));
            $this->response->send();
            return null;
        }
        $result =  $this->getTableObj()->getCustomerOrderList($custId, $restaurantId);
        if(is_null($result)){
            $this->response->body(DTO\ErrorDto::prepareError(118));
             $this->response->send();
        }
        return $result;
    }
    
    public function changeOrderStatus($orderId, $status, $restaurantId) {
        
        $statusResult = $this->getTableObj()->changeStatus($orderId, $status);
        if($statusResult){
            $orderStatusDto = new DownloadDTO\OrderStatusDto($orderId, $status);
             $syncController = new SyncController();
            $result = $syncController->orderEntry(
                    NULL, 
                    json_encode($orderStatusDto), 
                    UPDATE_OPERATION, 
                    $restaurantId);
        }
        return $statusResult;
    }
    
    public function orderCheck($custId, $restaurantId, $orderStatus) {
        return $this->getTableObj()->IsOrderPresent($custId, $restaurantId, $orderStatus);
    }
    
    public function getLatestOrders($tableId, $takeawayNo,$deliveryNo, $restaurantId, $all) {
        return $this->getTableObj()->getTableOrders($tableId, $takeawayNo,$deliveryNo, $restaurantId, $all);
    }
    
    public function displayOrders() {
        $this->autoRender = FALSE;
        $restId = parent::readCookie('cri');
         $request = $this->request->query;
        Log::debug($request);
        Log::debug('Current restaurantId in order controller :- '.$restId);
        if(isset($restId)){
            $tableId = $request['table'];
            $takeawayNo = $request['takeaway'];
            $deliveryNo = $request['delivery'];
            $all = false;
            if(isset($request['cancel'])){
                $all = TRUE;
            }
            Log::debug('Now order list shows for table :-'.$tableId);
            Log::debug('Now order list shows for takeaway :-'.$takeawayNo);
            Log::debug('Now order list shows for delivery :-'.$deliveryNo);
            $latestOrders = $this->getTableObj()->getKotOrders($tableId, $takeawayNo, $deliveryNo, $restId);
            if(is_null($latestOrders)){
                 $this->response->body(json_encode([MESSAGE => DTO\ErrorDto::prepareMessage(126)]));
                return;
            }
            $userController = new UserController();
            $rtableController = new RTablesController();
            foreach ($latestOrders as $order){
                $user = $userController->getUserName($order->user);
                $order->user = $user->userName;
                $order->tableId = $rtableController->getBillTableNo($order->tableId);
                $order->orderTime = date('H:i',strtotime('+330 minutes',strtotime($order->orderTime)));
                $order->tableId = $this->isNull($order->tableId);
                $order->takeawayNo = $this->isNull($order->takeawayNo);
                $order->deliveryNo = $this->isNull($order->deliveryNo);
            }
             if($this->request->is('ajax')){
                $response = json_encode($latestOrders);
                Log::debug($response);
                $this->response->body($response);
            }
        }else if($this->request->is('ajax')){
         $this->response->body(json_encode([MESSAGE => DTO\ErrorDto::prepareMessage(126)]));
        }
    }
    
    public function placeOrder() {
         if(!$this->isLogin()){
            $this->redirect('login');
        }
        $data = explode('/', $this->request->url);
        Log::debug($data);
        $userController = new UserController();
        $restaurantId = $this->readCookie('cri');
        $users = $userController->getUsers($restaurantId);
        $menuCategoryController = new MenuCategoryController();
        $categories = $menuCategoryController->getMenuCategories();
        $menuController = new MenuController();
        $menus = $menuController->getMenus($restaurantId);
        $tableId = $this->readCookie('cti');
        $takeawayNo = $this->readCookie('ctn');
        $deliveryNo = $this->readCookie('cdn');
        $rtableController = new RTablesController();
        if($tableId){
            $tableTransactionController = new TableTransactionController();
            $custId = $tableTransactionController->getCurrentCustomer($tableId, $restaurantId);
        }else if($takeawayNo){
            $takeawayController = new TakeawayController();
            $custId = $takeawayController->getTakeawayCustomer($takeawayNo, $restaurantId);
        }else if($deliveryNo){
            $deliverycontroller = new DeliveryController();
            $custId = $deliverycontroller->getCurrentCustomer($deliveryNo, $restaurantId);
        }
        $rconfigSettingcontroller = new RConfigSettingsController();
        $set = ['users' => $users,
            'menus' => $menus,
            'categories' => $categories,
            'option' => $data[0],
            'tableId' => $tableId,
            'takeawayNo' => $takeawayNo,
            'deliveryNo' => $deliveryNo,
            'custId' => $custId,
            'kot_permission' => $rconfigSettingcontroller->allow($restaurantId, KOT_CONFIG_KEY)];
          if($tableId){
            $set['isOccupied'] = $rtableController->isOccupied ($tableId);
            $set['tableNo'] = $rtableController->getBillTableNo($tableId);
          }
        $this->set($set);
    }
    
    public function cancelOrder() {
        $this->autoRender = FALSE;
        $orderId = parent::readCookie('cancel_order_id');
        $orderStatus = $this->getTableObj()->getOrderStatus($orderId);
        if(!$orderStatus){
           $this->response->body(json_encode(DTO\ErrorDto::prepareError(143))); 
        }elseif($orderStatus == 3){
            $this->response->body(json_encode(DTO\ErrorDto::prepareError(144))); 
        }else{
        if($this->getTableObj()->deleteOrder($orderId)){
            $menuRecipeController = new MenuRecipeController();
            $menuRecipeController->restoreMenuRecipeItemQty($orderId);
            $this->response->body(json_encode(DTO\ErrorDto::prepareSuccessMessage("Order has been canceled.")));
        }else{
        Log::debug('Current cancel orderid :-'.$orderId);
        $this->response->body(json_encode(DTO\ErrorDto::prepareError(142)));
        }}
    }

}
