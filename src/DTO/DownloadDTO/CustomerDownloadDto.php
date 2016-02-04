<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\DTO\DownloadDTO;

/**
 * Description of CustomerDownloadDto
 *
 * @author anand
 */
class CustomerDownloadDto {
    //put your code here
    
    public $custId;
    public $custName;
    public $custPhone;
    public $custEmail;
    public $active;    
    
    public function __construct($custId, $custName, $custPhone, $custEmail) {
        $this->custId = $custId;
        $this->custName = $custName;
        $this->custPhone = $custPhone;
        $this->custEmail = $custEmail;
    }
}
