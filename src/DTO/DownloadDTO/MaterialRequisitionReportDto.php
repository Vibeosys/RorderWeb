<?php
namespace App\DTO\DownloadDTO;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MaterialRequisitionReportDto
 *
 * @author niteen
 */
class MaterialRequisitionReportDto {
    
    public $x;
    public $y;
    public $label;
    
    public function __construct($x = null,$y = null, $label = null) {
        $this->x = $x;
        $this->y = $y;
        $this->label = $label;
    }
}
