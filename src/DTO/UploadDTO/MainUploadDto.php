<?php
namespace App\DTO\UploadDTO;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
use App\DTO;
/**
 * Description of MainUploadDto
 *
 * @author niteen
 */
class MainUploadDto extends DTO\JsonDeserializer{
    
    public $user;
    public $data;
    
    public function __construct($user = null,$dada = null) {
        
        $this->user = $user;
        $this->data = $data;
    }
}
