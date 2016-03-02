<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\DTO\DownloadDTO;

/**
 * Description of SalesMainDto
 *
 * @author niteen
 */
class SalesMainDto {
   
    public $chart;
    public $data;
    
    public function __construct($chart =  null, $data = null) {
        $this->chart = $chart;
        $this->data = $data;
    }
}
