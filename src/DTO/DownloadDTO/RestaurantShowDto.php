<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\DTO\DownloadDTO;

/**
 * Description of RestaurantShowDto
 *
 * @author niteen
 */
class RestaurantShowDto {
    public $restaurantId;
    public $title;
    public $logoUrl;
    public $address;
    public $active;
    public $area;
    public $city;
    public $country;
    public $phone;
    public $footer;


    public function __construct($restaurantId = null, $title = null, 
            $logoUrl = null,$address = null, $active = null, $area = null, $city = null, 
            $country = null,$phone = null, $footer = null) {
        $this->restaurantId = $restaurantId;
        $this->title  = $title;
        $this->logoUrl = $logoUrl;
        $this->address = $address;
        $this->active = $active;
        $this->area = $area;
        $this->city = $city;
        $this->country  = $country;
        $this->phone = $phone;
        $this->footer = $footer;
    }
}
