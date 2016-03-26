<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\DTO\DownloadDTO;

/**
 * Description of AdminUserController
 *
 * @author niteen
 */
class AdminUserDto {
    
    public $adminUserId;
    public $adminUserName;
    public $password;
    public $phone;
    public $email;
    public $permissions;
    
    public function __construct($aui = null, $aunm = null,$pwd = null, 
            $phone = null, $email = null, $permissions = null) {
        $this->adminUserId = $aui;
        $this->adminUserName = $aunm;
        $this->password = $pwd;
        $this->phone = $phone;
        $this->email = $email;
        $this->permissions = $permissions;
    }
}
