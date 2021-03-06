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
class MgmtPanelController extends ApiController {

    public $components = array('Cookie');

    public function login() {
        $userName = parent::readCookie('un');
        $password = parent::readCookie('pw');
        if ($this->request->is('post') and isset($this->request->data['Login'])) {
            $requestData = $this->request->data;
            $password = $requestData['password'];
            $userName = $requestData['userName'];
            $resultUserId = $this->getLoggedInUserInfo($userName, $password);

            if ($resultUserId) {
                parent::writeCookie('aui', $resultUserId);
                parent::writeCookie('un', $userName);
                parent::writeCookie('pw', $password);
                $this->redirect('/');
            } else {
                $this->set([MESSAGE => DTO\ErrorDto::prepareMessage(121), COLOR => ERROR_COLOR]);
                return;
            }
        }
        if (!is_null($userName) and ! is_null($password)) {
            $resultUserId = $this->getLoggedInUserInfo($userName, $password);
            parent::writeCookie('aui', $resultUserId);
            $this->redirect('/');
        }
    }

    public function consol() {
        if ($this->request->is('post') and isset($this->request->data['edit'])) {
            $id = $this->request->data['restaurantId'];
            parent::writeCookie('eri', $id);
            $this->redirect('edit');
        } elseif ($this->request->is('post') and isset($this->request->data['mgmt'])) {
            $id = $this->request->data['restaurantId'];
            Log::debug('current restaurantId set to :- ' . $id);
            parent::writeCookie('cri', $id);
            $this->redirect('managedata');
        } elseif ($this->request->is('post') and isset($this->request->data['inventory'])) {
            $id = $this->request->data['restaurantId'];
            parent::writeCookie('cri', $id);
            $this->redirect('inventory/stockinventoryreport');
        }
        $loggedInUserId = parent::readCookie('aui');
        Log::debug('current logged in user id :-' . $loggedInUserId);
        $isLoggedInUserAdmin = FALSE;
        $restaurantController = new RestaurantController();
        // If logged in user a normal user with Manager privileges
        if (isset($loggedInUserId)) {
            $userController = new UserController();
            $userDetails = $userController->getUserInfo($loggedInUserId);
            if ($userDetails != NULL) {
                $permitted = $this->isAuthorised($userDetails->Permissions, 'INVENTORY');
                $allRestaurants = $restaurantController->getAdminRestaurants(array($userDetails->RestaurantId));
                $this->set([
                    'data' => $allRestaurants,
                    'permitted' => $permitted
                ]);
            } else {
                $isLoggedInUserAdmin = TRUE;
            }
        } else {
            $this->redirect('login');
        }


        // If logged in user an Admin then go ahead
        if ($isLoggedInUserAdmin) {
            Log::debug('Login for Admin entered');
            $restaurantAdminController = new RestaurantAdminController();
            $restaurantArray = $restaurantAdminController->getAdminsRestaurants($loggedInUserId);
            $allRestaurants = $restaurantController->getAdminRestaurants($restaurantArray);
            $adminUserController = new AdminUserController();
            $userInfo = $adminUserController->getAdminPermissionSet($loggedInUserId);
            $permitted = $this->isAuthorised($userInfo->permissions, 'INVENTORY');
            $this->set([
                'data' => $allRestaurants,
                'permitted' => $permitted
            ]);
        }
    }

    /**
     * Get Logged in user information
     * @param type $userName
     * @param type $password
     * @return type
     */
    private function getLoggedInUserInfo($userName, $password) {
        $adminCredential = new UploadDTO\AdminUserUploadDto(
                $userName, $password);
        $adminUserController = new AdminUserController();
        $validatedUserId = $adminUserController->isAdminUserValid($adminCredential);
        if (!$validatedUserId) {
            $userController = new UserController();
            $validatedUserId = $userController->isUserManager
                    ($adminCredential->adminUserName, $adminCredential->adminUserPass);
        }
        return $validatedUserId;
    }

    public function edit() {
        $data = $this->request->data;
        if ($this->request->is('post') and isset($data['save'])) {
            $filename = $data['file-upload']['name'];
            $file = $data['file-upload']['tmp_name'];
            $error = $data['file-upload'] ['error'];
            $ext = $this->getExtension($filename);
            $activ = null;
            if (isset($data['active'])) {
                $activ = 1;
            }
            if ($error) {
                $valid_file = TRUE;
                $logoUrl = null;
            } elseif (!in_array($ext, $this->img_valid_ext)) {
                $valid_file = FALSE;
                $this->set([
                    MESSAGE => 'Please choose valide image file.', COLOR => ERROR_COLOR]);
            } elseif (in_array($ext, $this->img_valid_ext)) {

                $imgDir = new Folder(IMAGE_UPLOAD, true);
                $filename = $this->getGUID() . $filename;
                $destination = $imgDir->path . $filename;
                if (move_uploaded_file($file, $destination)) {
                    $valid_file = TRUE;
                    $logoUrl = '/img/' . $filename;
                } else {
                    $valid_file = FALSE;
                }
            }
            if ($valid_file) {
                $restaurantDto = new DownloadDTO\RestaurantShowDto(
                        $data['restaurantId'], $data['title'], $logoUrl, $data['address'], $activ, $data['area'], $data['city'], $data['country'], $data['phone']);
                $restaurantController = new RestaurantController();
                $restaurantUpdateResult = $restaurantController->updateRestaurantInfo($restaurantDto);
                if ($restaurantUpdateResult) {
                    $this->set([
                        'suc_msg' => DTO\ErrorDto::prepareMessage(122),
                        COLOR => SUCCESS_COLOR]);
                } else {
                    $this->set([
                        'suc_msg'
                        => DTO\ErrorDto::prepareMessage(123),
                        COLOR => ERROR_COLOR]);
                }
            }
        } elseif ($this->request->is('post') and isset($data['cancel'])) {
            // $this->redirect('/');
        }
        $restaurantId = parent::readCookie('cri');
        if (isset($restaurantId)) {
            $restaurantController = new RestaurantController();
            $allRestaurants = $restaurantController->getAdminRestaurants(array($restaurantId));
            $this->set(['data' => $allRestaurants, 'rites' => false]);
        } else {
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
        if ($this->request->is('ajax')
        ) {
            $data = $this->request->data;

            $fileName = $data[0]['name'];
            Log::debug('ajax request hit with FileName :- ' . $fileName);
            $return = '/img/' . $fileName;
            Log::debug('Logo return after uploading :- ' . $return);
            $ext = $this->isImage($fileName);
            if ($ext) {
                if (move_uploaded_file($data[0]['tmp_name'], IMAGE_UPLOAD . $fileName)) {
                    $this->response->type('multipart/form-data');

                    $this->response->body($return);
                } else {
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
        if (isset($restId) and $this->request->is('ajax')) {
            Log::debug('Ajax request hited for tables of restaurantId :-' . $restId);
            $rtableController = new RTablesController();
            $restaurantTables = $rtableController->getRtables($restId);
            $this->response->body(
                    json_encode($restaurantTables));
        }
    }

    public function getTakeaway() {
        $this->autoRender = FALSE;
        $restId = parent::readCookie('cri');
        if (isset($restId) and $this->request->is('ajax')) {
            Log::debug('Ajax request hited for takeaway');
            $takeawayController = new TakeawayController();
            $latestTakeaway = $takeawayController->getLatestTakeaway($restId);
            if ($latestTakeaway) {
                $this->response->body(json_encode($latestTakeaway));
            } else {
                $this->response->body(0);
            }
        } else {
            $this->response->body(0);
        }
    }

    public function getDelivery() {
        $this->autoRender = FALSE;
        if (!$this->isLogin()) {
            $this->response->body(0);
            return;
        }
        $restId = parent::readCookie('cri');
        if (isset($restId) and $this->request->is('ajax')) {
            Log::debug('Ajax request hited for delivery');
            $deliveryController = new DeliveryController ( );
            $latestDelivery = $deliveryController->getDeliveries($restId);
            if ($latestDelivery) {
                $this->response->body(json_encode($latestDelivery));
            } else {
                $this->response->body(0);
            }
        }
    }

    public function printPreview() {
        $billNo = $this->request->query('billNo');
        if (!isset($billNo)) {
            Log::error('No bill number received in print preview method');
            $billNo = 0;
        }

        $tableId = parent::readCookie('cti');
        $takeawayNo = parent::readCookie('ctn');
        $deliveryNo = parent::readCookie('cdn');
        $restId = parent::readCookie('cri');

        Log::debug('Current tableId :-' . $tableId);
        Log::debug('Current takeawayNo :- ' . $takeawayNo);
        Log::debug('Current delivery number :- ' . $takeawayNo);
        if (!$tableId and ! $takeawayNo and ! $deliveryNo) {
            $this->redirect('login');
        }
        $billController = new BillController();
        $billInfo = $billController->getBillToPrint($billNo, $restId);
        if (is_null($billInfo)) {
            Log::error('Bill has not generated for this table');
            $this->set([ MESSAGE => DTO\ErrorDto::prepareMessage(124), COLOR => ERROR_COLOR]);
            return;
        }
        
        Log::debug('Bill has generated for this table');
        $billDetailsController = new BillDetailsController();
        $billDeatilsInfo = $billDetailsController->getOrderId($billInfo->billNo);
        $orders = array();
        foreach ($billDeatilsInfo as $info) {
            array_push($orders, $info->orderId);
        }
        $orderDetailsController = new OrderDetailsController();
        $billOrderDetails = $orderDetailsController->getbillOrderDetails($orders);
        $billPrintInfo = array();
        $indexCounter = 0;
        $menuTitleList = array();
        foreach ($billOrderDetails as $menu) {
            if (!key_exists($menu->menuTitle, $menuTitleList)) {
                $menuTitleList[$menu->menuTitle] = $menu;
            } else {
                foreach ($menuTitleList as $key => $value) {
                    if ($value->menuId == $menu->menuId and $value->subMenuId == $menu->subMenuId) {
                        $value->qty += $menu->qty;
                        $value->orderPrice += $menu->orderPrice;
                    }
                }
            }
        }
        foreach ($menuTitleList as $key => $value) {
            $billPrintDto = new DownloadDTO\BillPrintDwnldDto(
                    $indexCounter + 1, $value->menuId, $value->menuTitle, $value->qty, $value->orderPrice / $menu->qty, $value->orderPrice);
            $billPrintInfo[$indexCounter++] = $billPrintDto;
        }
        $restaurantController = new RestaurantController();
        $restaurantInfo = $restaurantController->getAdminRestaurants(array($restId));
        $userController = new UserController();
        $userInfo = $userController->getUserName($billInfo->userId);
        $rtableController = new RTablesController();
        $tableNo = $rtableController->getBillTableNo($tableId);
        if (isset($billInfo) and isset($restaurantInfo) and isset($billPrintInfo)) {
            $this->set([

                'table' => $tableNo,
                'bill' => $billInfo,
                'restaurants' => $restaurantInfo,
                'printInfo' => $billPrintInfo,
                'user' => $userInfo->userName]);
        } else {
            $this->set([MESSAGE => DTO\ErrorDto::prepareMessage(124), COLOR => ERROR_COLOR]);
        }
    }

    public function sendMail() {
        $this->autoRender = FALSE;
        $data = $this->request->data;
        $from = [
            'hr@vibeosys.com' => $data ['fname'] . ' ' . $data['lname'],
        ];
        $to = 'anand@vibeosys.com';
        $subject = "QuickServe sales inquiry";
        $content = "";
        $content .= "<table style='height: 100%; margin-left: auto; margin-right: auto;' width='677'><tbody>"
                . "<tr><td colspan='2'><h1 style='text-align: center;'><span style='color: #ff0000;'><strong>Sales Inquiry</strong></span></h1></td></tr>"
                . "<tr><td style='text-align: justify;' width='30px'><h2 style='padding-left: 30px;'><strong>Name:</strong></h2></td>"
                . "<td>&nbsp;<span style='font-size: 12pt;'>" . $data['fname'] . " " . $data['lname'] . "</span></td></tr>"//name
                . "<tr><td style='text-align: justify;'><h2 style='padding-left: 30px;'><strong>Email:</strong></h2></td>"
                . "<td><span style='font-size: 12pt;'>&nbsp;" . $data['email'] . "</span></td></tr>"
                . "<tr><td style='text-align: justify;'><h2 style='padding-left: 30px;'><strong>Phone:</strong></h2></td>"
                . "<td>&nbsp;<span style='font-size: 12pt;'>" . $data['phone'] . "</span></td></tr>"
                . "<tr><td style='text-align: justify;'><h2 style='text-align: justify; padding-left: 30px;'><strong>Restaurant:</strong></h2></td>" . "<td><span style='font-size: 12pt;'>&nbsp;" . $data['restaurant'] . "</span></td></tr>"
                . "<tr><td style='text-align: justify;'><h2 style='text-align: justify; padding-left: 30px;'><strong>Comment</strong></h2></td>"
                . "<td style='word-break: break-all;'><p style='text-align: justify;'><span style='font-size: 12pt;'>" . $data['msg'] .
                "</span></p></td></tr>"
                . "</tbody></table>";

        try {
            $mailer = new Email();

            $mailer->transport('quickserve');
            $mailer->template('', 'default');
            $headers = ['Content-Type:text/HTML'];
            $result = $mailer->from($from)->emailFormat('html')
                    ->to($to)->template('default')
                    ->subject($subject)
                    ->send($content);
            if
            ($result) {
                $this->response->body(true);
            } else {
                $this->response->body(false);
            }
        } catch (Exception $e) {

            $this->response->body(false);
        }
    }

    public function setCookie() {
        $this->autoRender = FALSE;
        $data = $this->request->data;
        if ($this->request->is('post')) {
            $name = $data['name'];
            $value = $data['value'];
            Log::debug('name of cookie: ' . $name .
                    'and value is :' . $value);
            parent::writeCookie($name, $value);
            //parent::readCookie($name);
            $this->response->body(1);
        }
    }

    public function getCookie() {
        $this->autoRender = FALSE;
        $data = $this->request->data;
        $result = 0;
        if ($this->request->is('post')) {
            $name = $data['name'];
            $result = parent::readCookie($name);
            Log::debug('cookie value of' . $name
                    . '  return:' . $result);
            if (is_null($result)) {
                $result = 0;
            }
        }

        $this->response->body($result);
        $this->response->type('text/html');
    }

    public function removeCookie() {
        $this->autoRender = FALSE;
        $data = $this->request->data;
        if ($this->request->is('post')) {
            $name = $data[
                    'name'];
            $result = parent::deleteCookie($name);
            Log::debug('cookie value of' . $name . 'deleted');
        }
        if (is_null($result)) {
            $result = 0;
        }
        $this->response->body($result);
        $this->response->type('text/html');
    }

    public function reports() {
        if (!$this->isLogin()) {
            $this->redirect('login');
        }
        $this->set([


            'rest' => parent::readCookie('cri')
        ]);
    }

    public function reportsNew() {
        if (!$this->isLogin()) {
            $this->redirect('login');
        }
        $this->set([
            'rest' => parent::readCookie('cri')
        ]);
    }

    public function commingSoon() {
        
    }

}
