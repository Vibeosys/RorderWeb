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
                $this->redirect('mgmtpanel');
            }  else {
                $this->set([MESSAGE => 'Error Incorrect credentials. please verify',COLOR =>ERROR_COLOR]);    
            }
        }elseif (!is_null($userName) and !is_null ($password)) {
             $adminCredential = new UploadDTO\AdminUserUploadDto(
                    $userName, 
                    $password);
            $adminUserController = new AdminUserController();
            $validResult = $adminUserController->isAdminUserValid($adminCredential);
            $this->redirect('mgmtpanel');
        }
    }
    public function mgmtPanel() {
        if($this->request->is('post') and isset($this->request->data['edit'])){
            $id = $this->request->data['restaurantId'];
            $this->redirect('mgmtpanel/edit/'.  base64_encode($id));
        } elseif ($this->request->is('post') and isset($this->request->data['mgmt'])) {
            $id = $this->request->data['restaurantId'];
            parent::writeCookie('cri', $id);
            $this->redirect('mgmtpanel/managedata');
       }
       $adminId = parent::readCookie('aui');
       if(isset($adminId)){
           $restaurantAdminController = new RestaurantAdminController();
           $restaurants = $restaurantAdminController->getAdminsRestaurants($adminId);
           $restaurantController = new RestaurantController();
           $allRestaurants = $restaurantController->getAdminRestaurants($restaurants);
           $this->set(['data' => $allRestaurants]);
       }  else {
           $this->redirect('/');
       }
       
    }
    
    public function edit($id) {
        if($this->request->is('post') and isset($this->request->data['save'])){
            $data = $this->request->data;
            $fileName = $data['file-upload']['name'];
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
                        $data['country']);
                $restaurantController = new RestaurantController();
                $restaurantUpdateResult = $restaurantController->updateRestaurantInfo($restaurantDto);
                $session = $this->request->session();
                if($restaurantUpdateResult){
                    parent::writeCookie('rem', 'Your data updated successfully..!');
                }  else {
                    parent::writeCookie('rem', 'ERROR...Restaurant Updation Failed!');
                }
                $this->redirect('mgmtpanel');
            }
        }elseif ($this->request->is('post') and isset($this->request->data['cancel'])) {
            $this->redirect('mgmtpanel');
        }
        $restaurantId = base64_decode($id);
        $restaurantController = new RestaurantController();
        $allRestaurants = $restaurantController->getAdminRestaurants(array($restaurantId));
        $this->set(['data' => $allRestaurants,'rites' => false]);
    }
    
    public function manageData() {
        $restId = parent::readCookie('cri');
    }
    
    public function logout() {
        parent::deleteCookie('un');
        parent::deleteCookie('pw');
        parent::deleteCookie('aui');
        parent::deleteCookie('cri');
        $this->redirect('/');
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
        $restId = parent::readCookie('cri');
        Log::debug('Current restaurant is : -'.$restId);
        if(empty($restId)){
             $this->redirect('/');
        }
        if($this->request->is('post')){
            $this->autoRender = false;
            $tableId  =  $this->request->data['bi'];
           
            $billController = new BillController();
            $billInfo = $billController->getBill($tableId);
            if(is_null($billInfo)){
                $this->set([MESSAGE => 'Bill has been not generated for this table',COLOR => ERROR_COLOR]);
                return;
            }
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
            $menuInfo = $menuController->getMenuItemList($menuList);
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
            var_dump($billPrintInfo);
        }  else {
            $rtableController = new RTablesController();
            $restaurantTables = $rtableController->getRtables($restId);
            if(isset($restaurantTables)){
                $this->set('tables', $restaurantTables);
            }  else {
                $this->set(['message' => 'ERROR Occured...Table are not found',COLOR => ERROR_COLOR]);
            }
        }
    }
}
