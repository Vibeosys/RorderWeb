<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\DTO\UploadDTO;
use App\DTO;
/**
 * Description of CustomerFeedbackUploadDto
 *
 * @author niteen
 */
class CustomerFeedbackUploadDto extends DTO\JsonDeserializer{
    
    public $custId;
    public $feedback;
    
    public function __construct($custId = null, $feedback = null) {
        $this->custId = $custId;
        $this->feedback = $feedback;
    }
}
