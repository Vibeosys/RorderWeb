<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\DTO\DownloadDTO;

/**
 * Description of UnitMasterDownloadDto
 *
 * @author niteen
 */
class UnitMasterDownloadDto {
    
    public $unitId;
    public $unitTitle;
    public function __construct($unitId = null,$unitTitle = null) {
        $this->unitId = $unitId;
        $this->unitTitle = $unitTitle;
    }
}
