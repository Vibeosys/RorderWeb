<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\DTO\UploadDTO;

/**
 * Description of CustomerVisitUpldDto
 *
 * @author niteen
 */
class CustomerVisitUpldDto {

    public $restaurantId;
    public $month;
    public $year;
    public $day;
    public $timeSlot;
    
    public function __construct($restaurantId = null, $month = null, $year = null, $day = null, $timeSlot = null) {
        $this->restaurantId = $restaurantId;
        $this->month = $month;
        $this->year = $year;
        $this->day = $day;
        $this->timeSlot = $timeSlot;
    }
}
