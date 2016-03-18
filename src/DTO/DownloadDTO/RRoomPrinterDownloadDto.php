<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\DTO\DownloadDTO;

/**
 * Description of RRoomPrinterDownloadDto
 *
 * @author niteen
 */
class RRoomPrinterDownloadDto {
    
    public $roomId;
    public $roomTypeId;
    public $printerId;
    public $description;
    public $active;
    
    public function __construct($rpId = null, $roomType = null, 
            $printerId = null, $description = null, $active = null) {
        $this->roomId = $rpId;
        $this->roomTypeId = $roomType;
        $this->printerId = $printerId;
        $this->description = $description;
        $this->active = $active;
    }
}
