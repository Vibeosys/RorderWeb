<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\DTO\DownloadDTO;

/**
 * Description of FbTypeDowunloadDto
 *
 * @author niteen
 */
class FbTypeDowunloadDto {
   
    public $fbTypeId;
    public $fbTypeName;
    
    public function __construct($fbTypeId = null, $fbTypeName = null) {
        $this->fbTypeId = $fbTypeId;
        $this->fbTypeName = $fbTypeName;
    }
}
