<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\DTO\DownloadDTO;

/**
 * Description of transactionReportDto
 *
 * @author niteen
 */
class transactionReportDto {
    
    public $label;
    public $value;
    
    public function __construct($label = null, $value = null, $color = null) {
        $this->label = $label;
        $this->value = $value;
    }
}
