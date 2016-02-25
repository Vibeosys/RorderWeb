<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controller;
use App\DTO\UploadDTO;
use Cake\Controller\Component\CookieComponent;
use Cake\Controller\ComponentRegistry;

/**
 * Description of MgmtPanelController
 *
 * @author niteen
 */
class MgmtPanelController extends ApiController{
    private $cookie;
    public function login() {
        /* @var $userName type */
        $this->cookie = new CookieComponent(new ComponentRegistry());
        //$userName = $this->Cookie->read('userName');
        //$password = $this->Cookie->read('password');
        if($this->request->is('post') and isset($this->request->data['login'])){
            $requestData = $this->request->data;
            $adminCredential = new UploadDTO\AdminUserUploadDto(
                    $requestData['userName'], 
                    $requestData['password']);
            $adminUserController = new AdminUserController();
            $validResult = $adminUserController->isAdminUserValid($adminCredential);
            if($validResult){
                $session = $this->request->session();
                $session->write('login', TRUE);
                $session->write('AdminUserId', $validResult);
                $this->cookie->configKey('userName', ['expires' => +86400, 'path' => '/']);
                $this->cookie->write('userName', $adminCredential->adminUserName);
                $this->cookie->configKey('password', ['expires' => +86400, 'path' => '/']);
                $this->cookie->write('password', $adminCredential->adminUserName);
                $this->redirect('mgmtpanel');
            }  else {
                $this->set([MESSAGE => 'ERROR..!Inccorect USERNAME or PASSWORD..',COLOR =>ERROR_COLOR]);    
            }
        }elseif (isset ($userName) and isset ($password)) {
             $session = $this->request->session();
                $session->write('login', TRUE);
                $session->write('AdminUserId', $validResult);
            $this->redirect('mgmtpanel');
        }
    }
    public function mgmtPanel() {
        if($this->request->is('post') and isset($this->request->data['edit'])){
            $this->autoRender = false;
            var_dump($this->request->data);
            echo 'this is edit section';
        }  elseif($this->request->is('post') and isset($this->request->data['view-stat'])){
            $this->autoRender = false;
            var_dump($this->request->data);
            echo 'this is view stat section';
        } elseif ($this->request->is('post') and isset($this->request->data['mgmt'])) {
            $this->autoRender = false;
            var_dump($this->request->data);
            echo 'this is mgmt section';
       }
       $session = $this->request->session();
       if($session->read('login')){
           $adminId = $session->read('AdminUserId');
           $restaurantId = 123456;
           $restaurantController = new RestaurantController();
           $allRestaurants = $restaurantController->getAdminRestaurants($restaurantId);
           $this->set(['data' => $allRestaurants]);
       }  else {
           $this->set([MESSAGE => 'No restaurant Fonud',COLOR => ERROR_COLOR]);    
       }
       
    }
}
