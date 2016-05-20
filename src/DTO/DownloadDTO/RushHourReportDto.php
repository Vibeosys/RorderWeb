<?php
namespace App\DTO\DownloadDTO;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of RushHourReportDto
 *
 * @author niteen
 */
class RushHourReportDto {
    public $y;
    public $legendText;
    public $label;
    
    public function __construct($y = 0,$legendText = null,$label = null) {
        $this->y = $y;
        $this->legendText = $legendText;
        $this->label = $label;
    }
}
