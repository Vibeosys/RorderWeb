<?php
namespace App\DTO;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UserUploaddto
 *
 * @author niteen
 */
class UserUploadDto extends JsonDeserializer{
    
    public $userId;
    public $userName;
    public $password;
    public $active;
    public $createdDate;
    public $updatedDate;
    public $roleId;
    public $restaurantId;
    
    public function __construct($userId =null, $userName=null, $password=null, 
            $active=null, $roleId=null, $restaurantId=null) {
        $this->userId = $userId;
        $this->userName = $userName;
        $this->password = $password;
        $this->active = $active;
        $this->roleId = $roleId;
        $this->restaurantId = $restaurantId;
    }
}
