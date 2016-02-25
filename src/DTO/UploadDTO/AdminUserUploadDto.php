<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\DTO\UploadDTO;

/**
 * Description of AdminUserUploadDto
 *
 * @author niteen
 */
class AdminUserUploadDto {

    public $adminUserName;
    public $adminUserPass;
    
    public function __construct($userName = null, $password = null) {
        $this->adminUserName = $userName;
        $this->adminUserPass = $password;
    }
}
