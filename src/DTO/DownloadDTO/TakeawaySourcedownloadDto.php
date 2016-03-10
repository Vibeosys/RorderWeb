<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\DTO\DownloadDTO;

/**
 * Description of TakeawaySourcedownloadDto
 *
 * @author niteen
 */
class TakeawaySourcedownloadDto {

    public $sourceId;
    public $sourceName;
    public $sourceImg;
    public $discount;
    public $active;


    public function __construct($sourceId = null, $sourceName = null, 
            $sourceImg = null, $discount = null, $active = null) {
        $this->sourceId = $sourceId;
        $this->sourceName = $sourceName;
        $this->sourceImg = $sourceImg;
        $this->discount = $discount;
        $this->active = $active;
    }
}
