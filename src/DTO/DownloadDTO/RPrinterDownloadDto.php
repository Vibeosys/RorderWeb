<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\DTO\DownloadDTO;

/**
 * Description of RPrinterDownloadDto
 *
 * @author niteen
 */
class RPrinterDownloadDto {
    
    public $printerId;
    public $ipAddress;
    public $name;
    public $model;
    public $company;
    public $macAddress;
    public $active;
    
    public function __construct($printerId = null, $ipAddress = null, 
            $name = null, $model = null, $company = null, $macAddress = null, 
            $active = null) {
        $this->printerId = $printerId;
        $this->ipAddress = $ipAddress; 
        $this->name = $name;
        $this->model = $model;
        $this->company = $company;
        $this->macAddress = $macAddress;
        $this->active = $active;
    }
            
    
}
