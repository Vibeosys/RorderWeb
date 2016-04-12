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
use Cake\Mailer\Email;

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
        if($this->request->is('post') and isset($this->request->data['Login'])){
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
            Log::debug('current restaurantId set to :- '.$id);
            parent::writeCookie('cri', $id);
            $this->redirect('managedata');
       } elseif($this->request->is('post') and isset($this->request->data['inventory'])){
            $id = $this->request->data['restaurantId'];
            parent::writeCookie('cri', $id);
            $this->redirect('inventory/stockinventoryreport');
       }
       $adminId = parent::readCookie('aui');
       Log::debug('current admin user id :-'.$adminId);
       if(isset($adminId)){
           Log::debug('Login successfull');
           $restaurantAdminController = new RestaurantAdminController();
           $restaurants = $restaurantAdminController->getAdminsRestaurants($adminId);
           $restaurantController = new RestaurantController();
           $allRestaurants = $restaurantController->getAdminRestaurants($restaurants);
           $adminUserController = new AdminUserController();
           $adminInfo = $adminUserController->getAdminPermissionSet($adminId);
           $permitted = $this->isAuthorised($adminInfo->permissions, 'INVENTORY');
           $this->set([
               'data' => $allRestaurants,
                'permitted' => $permitted   
                   ]);
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
            Log::debug('Ajax request hited for tables of restaurantId :-'.$restId);
            $rtableController = new RTablesController();
            $restaurantTables = $rtableController->getRtables($restId);
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
            $this->response->body(json_encode($latestTakeaway));
        }
    }
    
    public function printPreview() {
            $tableId = $_COOKIE['cti'];
            $takeawayNo = 0;
            if(key_exists('ctkno', $_COOKIE)){
                $takeawayNo = $_COOKIE['ctkno'];
            }
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
            $billPrintInfo = array();
            $indexCounter = 0;
            $menuTitleList = array();
            foreach ($billOrderDetails as $menu){
                if(!key_exists($menu->menuTitle, $menuTitleList)){
                    $menuTitleList[$menu->menuTitle] = $menu;       
                }else{
                    foreach ($menuTitleList as $key => $value){
                        if($value->menuId == $menu->menuId and $value->subMenuId == $menu->subMenuId){
                        $value->qty += $menu->qty;
                        $value->orderPrice += $menu->orderPrice;
                        }
                    }
                }
            }
            foreach ($menuTitleList as $key => $value){
                $billPrintDto = new DownloadDTO\BillPrintDwnldDto(
                        $indexCounter + 1,
                        $value->menuId, 
                        $value->menuTitle,        
                        $value->qty, 
                        $value->orderPrice/$menu->qty, 
                        $value->orderPrice);
                $billPrintInfo[$indexCounter++] = $billPrintDto;
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
    
    public function sendMail() {
        $this->autoRender = FALSE;
        $data = $this->request->data;
        $from = [
            'hr@vibeosys.com' => $data['fname'].' '.$data['lname'],
        ];
       $to = 'anand@vibeosys.com';
       $subject = "QuickServe sales inquiry";
       $content = "";
       $content .= "<table style='height: 100%; margin-left: auto; margin-right: auto;' width='677'><tbody>"
            ."<tr><td colspan='2'><h1 style='text-align: center;'><span style='color: #ff0000;'><strong>Sales Inquiry</strong></span></h1></td></tr>"
            ."<tr><td style='text-align: justify;' width='30px'><h2 style='padding-left: 30px;'><strong>Name:</strong></h2></td>"
            ."<td>&nbsp;<span style='font-size: 12pt;'>".$data['fname']." ".$data['lname']."</span></td></tr>"//name
            ."<tr><td style='text-align: justify;'><h2 style='padding-left: 30px;'><strong>Email:</strong></h2></td>"
            ."<td><span style='font-size: 12pt;'>&nbsp;".$data['email'] ."</span></td></tr>"
            ."<tr><td style='text-align: justify;'><h2 style='padding-left: 30px;'><strong>Phone:</strong></h2></td>"
            ."<td>&nbsp;<span style='font-size: 12pt;'>".$data['phone']."</span></td></tr>"
            ."<tr><td style='text-align: justify;'><h2 style='text-align: justify; padding-left: 30px;'><strong>Restaurant:</strong></h2></td>"
            ."<td><span style='font-size: 12pt;'>&nbsp;".$data['restaurant']."</span></td></tr>"
            ."<tr><td style='text-align: justify;'><h2 style='text-align: justify; padding-left: 30px;'><strong>Comment</strong></h2></td>"
            ."<td style='word-break: break-all;'><p style='text-align: justify;'><span style='font-size: 12pt;'>".$data['msg']."</span></p></td></tr>"
           
               . "</tbody></table>";
       
        try{
            $mailer = new Email();
            
            $mailer->transport('quickserve');
         $mailer->template('', 'default');
         $headers = ['Content-Type:text/HTML'];
            $result =   $mailer->from($from)->emailFormat('html')
                                ->to($to)->template('default')
                                ->subject($subject)
                                ->send($content);
             if($result){
                 $this->response->body (true);
                 
             }else{
                $this->response->body (false);
             }
        } catch (Exception $e) {

            $this->response->body(false);

        }
    }
    
    public function setCookie() {
        $this->autoRender = FALSE;
        $data = $this->request->data;
        if($this->request->is('post')){
            $name = $data['name'];
            $value = $data['value'];
            parent::writeCookie($name, $value); 
        }
    }
    public function getCookie() {
        $this->autoRender = FALSE;
        $data = $this->request->data;
        $result = NULL;
        if($this->request->is('post')){
            $name = $data['name'];
            $result = parent::readCookie($name); 
        }
        $this->response->body($result);
    }
}
