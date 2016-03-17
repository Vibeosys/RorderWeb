<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\DTO\DownloadDTO;

/**
 * Description of RoomTypeDownloadDto
 *
 * @author niteen
 */
class RoomTypeDownloadDto {

    public $roomTypeId;
    public $roomType;
    public $active;
    
    public function __construct($roomTypeId = null, $roomType = null, 
            $active = null) {
        $this->roomTypeId = $roomTypeId;
        $this->roomType = $roomType;
        $this->active = $active;
    }
}
