<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\DTO\DownloadDTO;

/**
 * Description of OrderKotPrintDto
 *
 * @author niteen
 */
class OrderKotPrintDto {
    
    public  $id;
    public $desc;
    public $qty;
    public $note;
    
    public function __construct($id = null, $desc = null, $qty = null, $note = null) {
        $this->id = $id;
        $this->desc = $desc;
        $this->qty = $qty;
        $this->note = $note;
    }
    
}
