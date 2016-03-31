<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\DTO\UploadDTO;
use App\DTO;

/**
 * Description of CustomerUpdateDto
 *
 * @author niteen
 */
class CustomerUpdateDto extends DTO\JsonDeserializer{
   
    public $custId;
    public $custEmail;
    public $custPhone;
    
    public function __construct($custId = null, $email = null, $phone = null) {
        $this->custId = $custId;
        $this->custEmail = $email;
        $this->custPhone = $phone;
    }
}
