<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\DTO\DownloadDTO;

/**
 * Description of OrderTypeDownloadDto
 *
 * @author niteen
 */
class OrderTypeDownloadDto {
    
    public $id;
    public $title;
    public $active;

    public function __construct($id = null, $title = null, $active = null) {
        $this->id = $id;
        $this->title = $title;
        $this->active = $active;
    }
}
