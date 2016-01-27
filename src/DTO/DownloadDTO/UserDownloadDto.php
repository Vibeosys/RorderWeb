<?php
namespace App\DTO\DownloadDTO;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UserDownloadDto
 *
 * @author niteen
 */
class UserDownloadDto {
    
    public $userId;
    public $userName;
    public $password;
    public $active;
    public $createdDate;
    public $updatedDate;
    public $roleId;
    public $restaurantId;
    
    
     public function __construct($userId =null, $userName=null, $password=null, 
            $active=null,$createdDate=null,$updatedDate=null, $roleId=null, $restaurantId=null) {
        $this->userId = $userId;
        $this->userName = $userName;
        $this->password = $password;
        $this->active = $active;
        $this->createdDate = $createdDate;
        $this->updatedDate = $updatedDate;
        $this->roleId = $roleId;
        $this->restaurantId = $restaurantId;
    }
    
    
}
