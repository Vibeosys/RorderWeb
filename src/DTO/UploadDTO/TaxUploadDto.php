<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\DTO\UploadDTO;

/**
 * Description of TaxUploadDto
 *
 * @author niteen
 */
class TaxUploadDto {
    
    public $taxId;
    public $taxTitle;
    public $percentage;
    
    public function __construct($taxId = null, $taxTitle = null, $percentage = null) {
        
        $this->taxId  = $taxId;
        $this->taxTitle = $taxTitle;
        $this->percentage = $percentage;
        
    }
}
