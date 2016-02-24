<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\DTO\DownloadDTO;

/**
 * Description of UserRoleDto
 *
 * @author niteen
 */
class UserRoleDto {

    public $roleId;
    public $roleTitle;
    
    public function __construct($roleId = null, $roleTitle = null) {
        $this->roleId = $roleId;
        $this->roleTitle = $roleTitle;
    }
}
