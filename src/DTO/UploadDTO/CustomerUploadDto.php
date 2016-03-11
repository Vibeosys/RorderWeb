<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\DTO\UploadDTO;
use App\DTO;
/**
 * Description of CustomerUploadDto
 *
 * @author niteen
 */
class CustomerUploadDto extends DTO\JsonDeserializer {
    
    public $custId;
    public $custName;
    public $custAddress;
    public $custPhone;




    public function __construct($custId = null, $custName = null, 
            $address = null, $phone = null) {
        
        $this->custId = $custId;
        $this->custName = $custName;
        $this->custAddress = $address;
        $this->custphone = $phone;
    }
}
