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
    public $menuTagTable = "menu_tags";
    public $rtableTable = "r_tables";
    public $tableCategoryTable = "table_category";
    public $ordersTable = "orders";
    public $orderDetailsTable = "order_details";
    public $billTable = "bill";
    public $billDetailsTable = "bill_details";
    public $customerTable = "customer";
    public $tableTransactionTable = "table_transaction";
    public $takeawayTable = "takeaway";
    public $deliveryTable = "delivery";




    public function getTableObj() {
        return new Table\SyncTable();
    }

    public function usersEntry($newUserId, $json, $operation, $restaurantId) {
        $userEntryCounter = 0;
        $userController = new UserController();
        $allUser = $userController->getUsers($restaurantId);
        if ($allUser) {
            foreach ($allUser as $user) {
                if ($user->userId != $newUserId) {
                    $this->getTableObj()->Insert($user->userId, $json, $this->usersTable, $operation, $restaurantId);
                    $userEntryCounter++;
                }
            }
        }
        return $userEntryCounter;
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
                    $this->getTableObj()->Insert($user->userId, $json, $this->ordersTable, UPDATE_OPERATION, $restaurantId);
                }
            }
        }
    }

    public function orderDetailsEntry($userId, $json, $operation, $restaurantId) {
        $syncEntryCounter = 0;
        $UserObj = new UserController;
        $allUser = $UserObj->getUsers($restaurantId);
        if ($allUser) {
            foreach ($allUser as $user) {
                    try {
                        if($this->getTableObj()->Insert($user->userId, $json, $this->orderDetailsTable, $operation, $restaurantId))
                        $syncEntryCounter++;
                    } catch (Excption $ex) {
                        throw new Exception($ex);
                    }
            }
            return $syncEntryCounter;
        }
    }
    
    public function billEntry($userId, $json, $operation, $restaurantId) {
        $UserObj = new UserController;
        $allUser = $UserObj->getUsers($restaurantId);
            if ($allUser) {
                foreach ($allUser as $user) {    
                    if ($user->userId != $userId) {
                         $this->getTableObj()->Insert($user->userId, $json, $this->billTable, $operation, $restaurantId);
                    } else {
                         $this->getTableObj()->Insert($user->userId, $json, $this->billTable, $operation, $restaurantId); 
                    }
                }
            }
    }
    
    public function billDetailsEntry($userId, $json, $operation, $restaurantId) {
        if ($userId) {
            try {
                return  $this->getTableObj()->Insert($userId, $json, $this->billDetailsTable, $operation, $restaurantId);
                } catch (Excption $ex) {
                    throw new Exception($ex);
                }
       }
    }
    
    public function customerEntry($userId, $json, $operation, $restaurantId) {
        $UserObj = new UserController;
        $allUser = $UserObj->getUsers($restaurantId);
        if ($allUser) {
            foreach ($allUser as $user) {
                if ($user->userId != $userId) {
                    $this->getTableObj()->Insert($user->userId, $json, $this->customerTable, $operation, $restaurantId);
                    \Cake\Log\Log::debug('new Customer entry for restaurantId :- '.$restaurantId);
                }  else {
                    \Cake\Log\Log::debug('new Customer entry for restaurantId :- '.$restaurantId);
                    $this->getTableObj()->Insert($user->userId, $json, $this->customerTable, UPDATE_OPERATION, $restaurantId);
                }
            }
        }
    }
    
    public function tableTransactionEntry($userId, $json, $operation, $restaurantId) {
        $UserObj = new UserController;
        $allUser = $UserObj->getUsers($restaurantId);
        if($operation == INSERT_OPERATION){
            $userOperation = UPDATE_OPERATION;
        }  else {
           $userOperation = $operation; 
        }
        if ($allUser) {
            foreach ($allUser as $user) {
                if ($user->userId != $userId) {
                    $this->getTableObj()->Insert($user->userId, $json, $this->tableTransactionTable, $operation, $restaurantId);
                    \Cake\Log\Log::debug('new Customer waiting entry for restaurantId :- '.$restaurantId);
                }  else {
                    \Cake\Log\Log::debug('new Customer waiting entry for restaurantId :- '.$restaurantId);
                    $this->getTableObj()->Insert($user->userId, $json, $this->tableTransactionTable, $userOperation, $restaurantId);
                }
            }
        }
    }
    
    public function takeawayEntry($userId, $json, $operation, $restaurantId) {
        $UserObj = new UserController;
        $allUser = $UserObj->getUsers($restaurantId);
        if ($allUser) {
            foreach ($allUser as $user) {
                if ($user->userId != $userId) {
                    $this->getTableObj()->Insert($user->userId, $json, $this->takeawayTable, $operation, $restaurantId);
                    \Cake\Log\Log::debug('new Customer waiting entry for restaurantId :- '.$restaurantId);
                }  else {
                    \Cake\Log\Log::debug('new Customer waiting entry for restaurantId :- '.$restaurantId);
                    $this->getTableObj()->Insert($user->userId, $json, $this->takeawayTable, UPDATE_OPERATION, $restaurantId);
                }
            }
        }
    }
    
    public function deliveryEntry($userId, $json, $operation, $restaurantId) {
        $UserObj = new UserController;
        $allUser = $UserObj->getUsers($restaurantId);
        if ($allUser) {
            foreach ($allUser as $user) {
                if ($user->userId != $userId) {
                    $this->getTableObj()->Insert($user->userId, $json, $this->deliveryTable, $operation, $restaurantId);
                }  else {
                    $this->getTableObj()->Insert($user->userId, $json, $this->deliveryTable, UPDATE_OPERATION, $restaurantId);
                }
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
