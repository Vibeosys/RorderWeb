<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\DTO\DownloadDTO;

/**
 * Description of BillPrintDwnldDto
 *
 * @author niteen
 */
class BillPrintDwnldDto {

    public $srNo;
    public $id;
    public $desc;
    public $qty;
    public $rate;
    public $amt;
    
    public function __construct($srNO = null,$id = null,  $desc = null, $qty = null, 
            $rate = null, $amt = NULL) {
        $this->srNo = $srNO;
        $this->id = $id;
        $this->desc = $desc;
        $this->qty = $qty;
        $this->rate = $rate;
        $this->amt = $amt;
    }
}
