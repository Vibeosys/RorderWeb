<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\DTO\DownloadDTO;

/**
 * Description of TakeawayDownloadDto
 *
 * @author niteen
 */
class TakeawayDownloadDto {
    
    public $tno;//takeawayNo
    public $tdc;//takeawaydelivetcharges
    public $tsi;//takeawaysourceId
    public $disPer;
    public $status;


    public function __construct($takeawayNo = null, $deliveryCharges = null, 
            $sourceId = null, $disPer = null, $status = null) {
        
        $this->tno = $takeawayNo;
        $this->tdc = $deliveryCharges;
        $this->tsi = $sourceId;
        $this->disPer = $disPer;
        $this->status = $status;
    }
}
