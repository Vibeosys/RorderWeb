<?php
namespace App\DTO\UploadDTO;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
use App\DTO;
/**
 * Description of UserUploaddto
 *
 * @author niteen
 */
class UserUploadDto extends DTO\JsonDeserializer{
    
    public $userId;
    public $userName;
    public $password;
    public $active;
    public $roleId;
    public $restaurantId;
    public $imei;


    public function __construct($userId =null, $userName=null, $password=null, 
            $active=null, $roleId=null, $restaurantId=null, $imei = null) {
        $this->userId = $userId;
        $this->userName = $userName;
        $this->password = $password;
        $this->active = $active;
        $this->roleId = $roleId;
        $this->restaurantId = $restaurantId;
        $this->imei = $imei;
    }
}
