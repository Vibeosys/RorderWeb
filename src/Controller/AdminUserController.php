<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controller;
use App\Model\Table;
/**
 * Description of AdminUserController
 *
 * @author niteen
 */
class AdminUserController extends ApiController{
  
    private function getTableObj() {
        return new Table\AdminUserTable();
    }
    
    public function isAdminUserValid($adminUserCredential) {
        if(isset($adminUserCredential)){
           // $adminUserCredential->adminUserPass = $this->encrypt($adminUserCredential->adminUserPass);
            return $this->getTableObj()->validateCredential($adminUserCredential);
        }
        return false;
    }
}
