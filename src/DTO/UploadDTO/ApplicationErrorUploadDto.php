<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\DTO\UploadDTO;
use App\DTO;
/**
 * Description of ApplicationErrorUploadDto
 *
 * @author niteen
 */
class ApplicationErrorUploadDto extends DTO\JsonDeserializer{
    
    public $source;
    public $method;
    public $description;
    public $errorDate;
    public $errorTime;


    public function __construct($source = null, $method = null, $desc = null,
            $errorDate = null, $errorTime = null) {
        $this->source = $source;
        $this->method = $method;
        $this->description = $desc;
        $this->errorDate = $errorDate;
        $this->errorTime = $errorTime;
    }
}
