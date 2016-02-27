<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controller;
use App\DTO\UploadDTO;
use App\DTO\DownloadDTO;
use Cake\Controller\Component\CookieComponent;
use Cake\Controller\ComponentRegistry;
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

        $userName = $this->Cookie->read('userName');
        $password = $this->Cookie->read('password');
        Log::info('cookie user name :- '.$userName);
        Log::info('Cookie Password :- '.$password);
        $session = $this->request->session();
        if($this->request->is('post') and isset($this->request->data['login'])){
            $requestData = $this->request->data;
            $adminCredential = new UploadDTO\AdminUserUploadDto(
                    $requestData['userName'], 
                    $requestData['password']);
            $adminUserController = new AdminUserController();
            $validResult = $adminUserController->isAdminUserValid($adminCredential);
            if($validResult){
                
                $session->write('login', TRUE);
                $session->write('AdminUserId', $validResult);
                $this->Cookie->configKey('userName', ['domain' => 'localhost','expires' => '1 day','path' => '/']);
                $this->Cookie->write('userName', $adminCredential->adminUserName);
                $this->Cookie->configKey('password', ['domain' => 'localhost','expires' => '1 day', 'path' => '/']);
                $this->Cookie->write('password', $adminCredential->adminUserPass);
                $this->redirect('mgmtpanel');
            }  else {
                $this->set([MESSAGE => 'ERROR..!Inccorect USERNAME or PASSWORD..',COLOR =>ERROR_COLOR]);    
            }
        }elseif (!is_null($userName) and !is_null ($password) and $session->read('login')) {
             $adminCredential = new UploadDTO\AdminUserUploadDto(
                    $userName, 
                    $password);
            $adminUserController = new AdminUserController();
            $validResult = $adminUserController->isAdminUserValid($adminCredential);
                $session->write('login', TRUE);
                $session->write('AdminUserId', $validResult);
            $this->redirect('mgmtpanel');
        }
    }
    public function mgmtPanel() {
        if($this->request->is('post') and isset($this->request->data['edit'])){
            $id = $this->request->data['restaurantId'];
            $this->redirect('mgmtpanel/edit/'.  base64_encode($id));
        }  elseif($this->request->is('post') and isset($this->request->data['view-stat'])){
            $id = $this->request->data['restaurantId'];
            $this->redirect('mgmtpanel/statistics/'.  base64_encode($id));
        } elseif ($this->request->is('post') and isset($this->request->data['mgmt'])) {
            $this->autoRender = false;
            var_dump($this->request->data);
            echo 'this is mgmt section';
       }
       $session = $this->request->session();
       if($session->read('login')){
           $adminId = $session->read('AdminUserId');
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
                    $session->write('rest-edit-message', 'Your data updated successfully..!');
                }  else {
                    $session->write('rest-edit-message', 'ERROR...Restaurant Updation Failed!');
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
    
    public function statistics($id) {
        $restaurantId = base64_decode($id);
    }
    
    public function logout() {
        $sessoin = $this->request->session();
        $sessoin->destroy();
        $this->redirect('/');
    }
    
    public function upload() {
         $this->autoRender = false;
        if($this->request->is('ajax')){
            //$this->autoRender = false;
            $data = $this->request->data;
            $fileName = $data[0]['name'];
            Log::debug('ajax request hit with FileName :- '.$fileName);
            //Log::debug($data);
            $return = '/img/'.$fileName;
            Log::debug('Logo return after uploading :- '.$return);
            $ext = $this->isImage($fileName);
            if($ext){
               if(move_uploaded_file($data[0]['tmp_name'],IMAGE_UPLOAD.$fileName)){
                   $this->response->type('multipart/form-data');
                   $this->response->body($return);
                  // Log::debug($this->response->body($return));
               }  else {
                   $this->response->body(false);
               }
            }
        }
        
    }
}
