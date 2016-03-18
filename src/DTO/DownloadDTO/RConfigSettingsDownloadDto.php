<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\DTO\DownloadDTO;

/**
 * Description of RConfigSettingsDownloadDto
 *
 * @author niteen
 */
class RConfigSettingsDownloadDto {
    
    public $cKey;
    public $cValue;
    
    public function __construct($configKey = null, $configValue = null) {
        $this->cKey = $configKey;
        $this->cValue= $configValue;
    }
}
