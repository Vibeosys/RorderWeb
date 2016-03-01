<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\DTO\DownloadDTO;

/**
 * Description of SalesHistoryDataDto
 *
 * @author niteen
 */
class SalesHistoryDataDto {

    public  $label;
    public $value;
    
    public function __construct($label = null, $value = null) {
        $this->label = $label;
        $this->value = $value;
    }
}
