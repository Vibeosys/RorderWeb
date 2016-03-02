<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\DTO\DownloadDTO;

/**
 * Description of CustomerVisitDwnldDto
 *
 * @author niteen
 */
class CustomerVisitDwnldDto {

    public $restaurantId;
    public $month;
    public $year;
    public $day;
    public $f11to2;
    public $f2to3;
    public $f4to6;
    public $f6to8;
    public $f8to10;
    public $f10to12;
    
    public function __construct($restaurantId = null, 
            $month = null, 
            $year = null, 
            $day = null, 
            $f11to2 = 0,
            $f2to3 = 0,
            $f4to6 = 0,
            $f6to8 = 0,
            $f8to10 = 0,
            $f10to12 = 0) {

        $this->restaurantId = $restaurantId;
        $this->month = $month;
        $this->year = $year;
        $this->day = $day;
        $this->f11to2 = $f11to2;
        $this->f2to3 = $f2to3;
        $this->f4to6 = $f4to6;
        $this->f6to8 = $f6to8;
        $this->f8to10 = $f8to10;
        $this->f10to12 = $f10to12;
    }
    
}
