<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controller;
use App\DTO\UploadDTO;
use App\DTO\DownloadDTO;
use App\Controller\Component;
use Cake\Log\Log;
use App\DTO;
use Cake\Filesystem\Folder;
/**
 * Description of MgmtPanelController
 *
 * @author niteen
 */
class MgmtPanelController extends ApiController{
    
    public $components = array('Cookie');
    public function login() {
        $userName = parent::readCookie('un');
        $password = parent::readCookie('pw');
        if($this->request->is('post') and isset($this->request->data['login'])){
            $requestData = $this->request->data;
            $adminCredential = new UploadDTO\AdminUserUploadDto(
                    $requestData['userName'], 
                    $requestData['password']);
            $adminUserController = new AdminUserController();
            $validResult = $adminUserController->isAdminUserValid($adminCredential);
            if($validResult){
                parent::writeCookie('aui', $validResult);
                parent::writeCookie('un', $adminCredential->adminUserName);
                parent::writeCookie('pw', $adminCredential->adminUserPass);
                $this->redirect('/');
            }  else {
                $this->set([MESSAGE => DTO\ErrorDto::prepareMessage(121),COLOR =>ERROR_COLOR]);    
            }
        }elseif (!is_null($userName) and !is_null ($password)) {
             $adminCredential = new UploadDTO\AdminUserUploadDto(
                    $userName, 
                    $password);
            $adminUserController = new AdminUserController();
            $validResult = $adminUserController->isAdminUserValid($adminCredential);
             parent::writeCookie('aui', $validResult);
            $this->redirect('/');
        }
    }
    public function consol() {
        if($this->request->is('post') and isset($this->request->data['edit'])){
            $id = $this->request->data['restaurantId'];
            parent::writeCookie('eri', $id);
            $this->redirect('edit');
        } elseif ($this->request->is('post') and isset($this->request->data['mgmt'])) {
            $id = $this->request->data['restaurantId'];
            parent::writeCookie('cri', $id);
            $this->redirect('managedata');
       }
       $adminId = parent::readCookie('aui');
       if(isset($adminId)){
           Log::debug('Login successfull');
           $restaurantAdminController = new RestaurantAdminController();
           $restaurants = $restaurantAdminController->getAdminsRestaurants($adminId);
           $restaurantController = new RestaurantController();
           $allRestaurants = $restaurantController->getAdminRestaurants($restaurants);
           $this->set(['data' => $allRestaurants]);
       }  else {
           $this->redirect('login');
       }
    }
    
    public function edit() {
        if($this->request->is('post') and isset($this->request->data['save'])){
            $data = $this->request->data;
            if(!$data['file-upload']['error']){
                
            $fileName = $data['file-upload']['name'];
            Log::debug('edit restaurant request contain image :- '.$fileName);
            if(!$this->isImage($fileName)){
                $this->set([
                    MESSAGE => INCORRECT_FILE_MESSAGE.'"png, jpg, jpeg"',
                    COLOR => ERROR_COLOR]);
                return;
            }
            $uploadedFile = $data['file-upload']['tmp_name'];
            $imgDir = new Folder(IMAGE_UPLOAD, true);
            $fileName = $this->getGUID().$fileName;
            $destination = $imgDir->path.$fileName;
            $uploadResult = move_uploaded_file($uploadedFile, $destination);
            }  else {
            $uploadResult = TRUE;    
            $fileName = null;
            }
            $activ = null;
            if(isset($data['active'])){
                $activ = $data['active'];
            }
            if($uploadResult){
                $restaurantDto = new DownloadDTO\RestaurantShowDto(
                        $data['restaurantId'], 
                        $data['title'], 
                        $fileName, 
                        $data['address'], 
                        $activ, 
                        $data['area'], 
                        $data['city'], 
                        $data['country'],
                        $data['phone']);
                $restaurantController = new RestaurantController();
                $restaurantUpdateResult = $restaurantController->updateRestaurantInfo($restaurantDto);
                $session = $this->request->session();
                if($restaurantUpdateResult){
                    parent::writeCookie('rem', DTO\ErrorDto::prepareMessage(122));
                }  else {
                    parent::writeCookie('rem', DTO\ErrorDto::prepareMessage(123));
                }
                $this->redirect('/');
            }
        }elseif ($this->request->is('post') and isset($this->request->data['cancel'])) {
            $this->redirect('/');
        }
        $restaurantId = parent::readCookie('eri');
        if(isset($restaurantId)){
            $restaurantController = new RestaurantController();
            $allRestaurants = $restaurantController->getAdminRestaurants(array($restaurantId));
            $this->set(['data' => $allRestaurants,'rites' => false]);
        }  else {
            $this->redirect('login');
        }
    }
    
    public function manageData() {
        $restId = parent::readCookie('cri');
    }
    
    public function logout() {
        parent::deleteCookie('un');
        parent::deleteCookie('pw');
        parent::deleteCookie('aui');
        parent::deleteCookie('cri');
        parent::deleteCookie('eri');
        $this->redirect('login');
    }
    
    public function upload() {
         $this->autoRender = false;
        if($this->request->is('ajax')){
            $data = $this->request->data;
            $fileName = $data[0]['name'];
            Log::debug('ajax request hit with FileName :- '.$fileName);
            $return = '/img/'.$fileName;
            Log::debug('Logo return after uploading :- '.$return);
            $ext = $this->isImage($fileName);
            if($ext){
               if(move_uploaded_file($data[0]['tmp_name'],IMAGE_UPLOAD.$fileName)){
                   $this->response->type('multipart/form-data');
                   $this->response->body($return);
               }  else {
                   $this->response->body(false);
               }
            }
        }
    }
    
    public function printBill() {
       
        
    }
    
    public function getTables() {
        $this->autoRender = FALSE;
        $restId = parent::readCookie('cri');
        if(isset($restId) and $this->request->is('ajax') ){
            Log::debug('Ajax request hited for tables');
            $rtableController = new RTablesController();
            $restaurantTables = $rtableController->getRtables($restId);
            //$this->response->type('text/plain');
            $this->response->body(json_encode($restaurantTables));
        }
    }
    
    public function getTakeaway() {
        $this->autoRender = FALSE;
        $restId = parent::readCookie('cri');
        if(isset($restId) and $this->request->is('ajax') ){
            Log::debug('Ajax request hited for takeaway');
            $takeawayController = new TakeawayController();
            $latestTakeaway = $takeawayController->getLatestTakeaway($restId);
            Log::debug('letest takeaway :-'.json_encode($latestTakeaway));
            $this->response->body(json_encode($latestTakeaway));
        }
    }
    
    public function printPreview() {
            $tableId = $_COOKIE['cti'];
            $takeawayNo = $_COOKIE['ctn'];
            Log::debug('Current tableId :-'.$tableId);
            Log::debug('Current takeawayNo :- '.$takeawayNo);
             if(empty($tableId) and empty($takeawayNo)){
                $this->redirect('login');
            }
            $billController = new BillController();
            $billInfo = $billController->getBill($tableId, $takeawayNo);
            if(is_null($billInfo)){
                Log::error('Bill has not generated for this table');
                $this->set([MESSAGE => DTO\ErrorDto::prepareMessage(124),COLOR => ERROR_COLOR]);
                return;
            }
            Log::debug('Bill has generated for this table');
            $billDetailsController = new BillDetailsController();
            $billDeatilsInfo = $billDetailsController->getOrderId($billInfo->billNo);
             $orders = array();
            foreach ($billDeatilsInfo as $info){
                array_push($orders, $info->orderId);
            }
            $orderDetailsController = new OrderDetailsController();
            $billOrderDetails = $orderDetailsController->getbillOrderDetails($orders);
             $menuList = array();
            foreach ($billOrderDetails as $printinfo){
                if(!in_array($printinfo->menuId, $menuList)){
                    array_push($menuList, $printinfo->menuId);
                }
            }
            $menuController = new MenuController();
            $menuInfo = $menuController->getMenuItemList(null,$menuList);
            $billPrintInfo = array();
            $indexCounter = 0;
            foreach ($menuInfo as $menu){
                $billPrintDto = new DownloadDTO\BillPrintDwnldDto(
                        $indexCounter + 1,
                        $menu->menuId, 
                        $menu->menuTitle, 
                        0, 
                        $menu->price, 
                        0);
                $billPrintInfo[$indexCounter++] = $billPrintDto;
            }
            foreach ($billOrderDetails as $orderDetails){
                foreach ($billPrintInfo as $pinfo){
                   if($orderDetails->menuId == $pinfo->id){
                       $pinfo->qty = $pinfo->qty + $orderDetails->qty;
                       $pinfo->amt = $pinfo->amt + ($pinfo->rate * $orderDetails->qty);
                   } 
                }
            }
            $restId = parent::readCookie('cri');
            $restaurantController = new RestaurantController();
            $restaurantInfo = $restaurantController->getAdminRestaurants(array($restId));
            $userController = new UserController();
            $userInfo = $userController->getUserName($billInfo->userId);
            $rtableController = new RTablesController();
            $tableNo = $rtableController->getBillTableNo($tableId);
            if(isset($billInfo) and isset($restaurantInfo) and isset($billPrintInfo)){
                $this->set(['table' => $tableNo,
                    'bill' => $billInfo,
                    'restaurants' => $restaurantInfo, 
                    'printInfo' => $billPrintInfo, 
                    'user' => $userInfo->userName]);
            }else{
                $this->set([MESSAGE => DTO\ErrorDto::prepareMessage(124),COLOR => ERROR_COLOR]);
            }
    }
}
