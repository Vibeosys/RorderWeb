<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Model\Table;
use Cake\ORM\Table;
use Cake\ORM\TableRegistry;
use App\DTO\DownloadDTO;
/**
 * Description of UserRoleTable
 *
 * @author niteen
 */
class UserRoleTable extends Table{
    
    private function connect() {
        return TableRegistry::get('user_role');
    }
    public function getRole() {
        $allUserRole = null;
        $userRoleCounter = 0;
        try{
            $userRoles  = $this->connect()->find();
            if($userRoles->count()){
                foreach ($userRoles as $role){
                    $allUserRole[$userRoleCounter] = new DownloadDTO\UserRoleDto(
                            $role->RoleId, $role->RoleTitle);
                    $userRoleCounter++;
                }
            }
            return $allUserRole;    
        } catch (Exception $ex) {
            return false;
        }
    }
}
