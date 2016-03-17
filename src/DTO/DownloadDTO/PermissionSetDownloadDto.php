<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\DTO\DownloadDTO;

/**
 * Description of PermissionSetDownloadDto
 *
 * @author niteen
 */
class PermissionSetDownloadDto {

    public $permissionId;
    public $permissionKey;
    public $description;
    public $active;
    
    public function __construct($permissionId = null,$permissionKey = null,
            $description = null,$active = null ) {
        $this->permissionId = $permissionId;
        $this->permissionKey = $permissionKey;
        $this->description = $description;
        $this->active = $active;
    }
}
