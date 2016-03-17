<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\DTO\DownloadDTO;

/**
 * Description of RRoomsDownloadDto
 *
 * @author niteen
 */
class RRoomsDownloadDto {

    public $roomId;
    public $description;
    public $active;
    
    public function __construct($roomId = null, 
            $description = null, $active = null) {
        $this->roomId = $roomId;
        $this->description = $description;
        $this->active = $active;
    }
}
