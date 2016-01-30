<?php

namespace App\Controller;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


use App\Model\Table;
use App\DTO;

/**
 * Description of SyncController
 *
 * @author niteen
 */
class SyncController extends ApiController {

    public $usersTable = "users";
    public $menuTable = "menu";
    public $menuCategoryTable = "menu_category";
    public $menuTagTable = "menu_tag";
    public $rtableTable = "r_table";
    public $tableCategoryTable = "table_category";
    public $ordersTable = "orders";
    public $orderDetailsTable = "order_details";
    public $billTable = "bill";
    public $billDetailsTable = "bill_details";




    public function getTableObj() {
        return new Table\SyncTable();
    }

    public function usersEntry($newUserId, $restaurantId, $json, $operation) {
        $userController = new UserController();
        $allUser = $userController->getUsers($restaurantId);
        if ($allUser) {
            foreach ($allUser as $user) {
                if ($user->userId != $newUserId) {
                    $this->getTableObj()->Insert($user->userId, $json, $this->usersTable, $operation, $restaurantId);
                }
            }
        }
    }

    public function MenuEntry($json, $operation, $restaurantId) {
        $UserObj = new UserController;
        $allUser = $UserObj->getUsers($restaurantId);
        if ($allUser) {
            foreach ($allUser as $user) {

                $this->getTableObj()->Insert($user->userId, $json, $this->menuTable, $operation, $restaurantId);
            }
        }
    }

    public function menuCategoryEntry($json, $operation, $restaurantId) {
        $UserObj = new UserController;
        $allUser = $UserObj->getUsers($restaurantId);
        if ($allUser) {
            foreach ($allUser as $user) {

                $this->getTableObj()->Insert($user->userId, $json, $this->menuCategoryTable, $operation, $restaurantId);
            }
        }
    }

    public function menuTagEntry($json, $operation, $restaurantId) {
        $UserObj = new UserController;
        $allUser = $UserObj->getUsers($restaurantId);
        $i = 0;
        if ($allUser) {
            foreach ($allUser as $user) {

                $this->getTableObj()->Insert($user->userId, $json, $this->menuTagTable, $operation, $restaurantId);
            }
        }
    }

    public function rtableEntry($json, $operation, $restaurantId) {
        $UserObj = new UserController;
        $allUser = $UserObj->getUsers($restaurantId);
        $i = 0;
        if ($allUser) {
            foreach ($allUser as $user) {

                $this->getTableObj()->Insert($user->userId, $json, $this->rtableTable, $operation, $restaurantId);
            }
        }
    }

    public function tableCategoryEntry($json, $operation, $restaurantId) {
        $UserObj = new UserController;
        $allUser = $UserObj->getUsers($restaurantId);
        if ($allUser) {
            foreach ($allUser as $user) {

                $this->getTableObj()->Insert($user->userId, $json, $this->tableCategoryTable, $operation, $restaurantId);
            }
        }
    }

    public function orderEntry($userId, $json, $operation, $restaurantId) {
        $UserObj = new UserController;
        $allUser = $UserObj->getUsers($restaurantId);
        if ($allUser) {
            foreach ($allUser as $user) {
                if ($user->userId != $userId) {
                    $this->getTableObj()->Insert($user->userId, $json, $this->ordersTable, $operation, $restaurantId);
                    \Cake\Log\Log::debug('new sync entry for restaurantId :- '.$restaurantId);
                }  else {
                    \Cake\Log\Log::debug('new sync entry for restaurantId :- '.$restaurantId);
                    $this->getTableObj()->Insert($user->userId, $json, $this->ordersTable, 'update', $restaurantId);
                }
            }
        }
    }

    public function orderDetailsEntry($userId, $json, $operation, $restaurantId) {
        $UserObj = new UserController;
        $allUser = $UserObj->getUsers($restaurantId);
        if ($allUser) {
            foreach ($allUser as $user) {
                if ($user->userId != $userId) {
                    try {
                        $this->getTableObj()->Insert($user->userId, $json, $this->orderDetailsTable, $operation, $restaurantId);
                    } catch (Excption $ex) {
                        throw new Exception($ex);
                    }
                }
            }
        }
    }
    
    public function billEntry($userId, $json, $operation, $restaurantId) {
        
            
                if ($userId) {
                    try {
                        $this->getTableObj()->Insert($userId, $json, $this->billTable, $operation, $restaurantId);
                    } catch (Excption $ex) {
                        throw new Exception($ex);
                    }
                }
            
        
    }
    
    
    public function billDetailsEntry($userId, $json, $operation, $restaurantId) {
        
            
                if ($userId) {
                    try {
                        $this->getTableObj()->Insert($userId, $json, $this->billDetailsTable, $operation, $restaurantId);
                    } catch (Excption $ex) {
                        throw new Exception($ex);
                    }
                }
            
        
    }

   

    public function download($userId, $restaurantId) {
        $this->autoRender = false;
        \Cake\Log\Log::info("in Sync controller download method");
        $Update = $this->getTableObj()->getUpdate($userId, $restaurantId);
        if ($Update) {

            $this->response->body(json_encode($Update));
            $this->response->send();
            \Cake\Log\Log::debug("Update send to User : " . $userId." Update json for this user".  json_encode($Update));
            $this->getTableObj()->deleteUpdate($userId);
        } else {
            $this->response->body(DTO\ErrorDto::prepareError(103));
            $this->response->send();
        }
    }

}
