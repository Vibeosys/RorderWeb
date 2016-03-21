<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controller;
use App\Model\Table;
/**
 * Description of UserRoleController
 *
 * @author niteen
 */
class UserRoleController {
    
    private function getTableObj() {
        return new Table\UserRoleTable();
    }
    
    public function getUserRole() {
        return $this->getTableObj()->getRole();
    }
    
    public function getUserRoleStdObj() {
       $roles = $this->getUserRole();
        $userRole = new \stdClass();
        foreach ($roles as $role){
            $key = $role->roleId;
            $userRole->$key = $role->roleTitle;
        } 
        return $userRole;
    }
}
