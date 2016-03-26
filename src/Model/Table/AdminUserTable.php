<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Model\Table;
use Cake\ORM\TableRegistry;
use Cake\ORM\Table;
use Cake\Log\Log;
use App\DTO\UploadDTO;
use App\DTO\DownloadDTO;
/**
 * Description of AdminUserTable
 *
 * @author niteen
 */
class AdminUserTable extends Table{
    
    private function connect() {
        return TableRegistry::get('admin_user');
    }
    
    public function validateCredential(UploadDTO\AdminUserUploadDto $credential) {
        $condition  = [
            'AdminUserName =' => $credential->adminUserName, 
            'Password =' => $credential->adminUserPass];
        $queryResult = $this->connect()->find()->where($condition);
        if($queryResult->count()){
            foreach ($queryResult as $result){
                return $result->AdminUserId;
            }
        }
        return false;
    }
    
    public function getAdminDetails($adminId) {
        $conditions = ['AdminUserId =' => $adminId];
        $adminDto  = null;
        $adminInfo = $this->connect()->find()->where($conditions);
        if($adminInfo->count()){
            foreach ($adminInfo as $admin){
                $adminDto = new DownloadDTO\AdminUserDto(
                        $admin->AdminUserId, 
                        $admin->AdminUserName, 
                        $admin->Password, 
                        $admin->Phone, 
                        $admin->Email, 
                        $admin->Permissions);
            }
        }
        return $adminDto;
    }
}
