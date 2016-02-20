<?php
namespace App\DTO\DownloadDTO;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of RestaurantDto
 *
 * @author niteen
 */
class RestaurantDownloadDto{
   
    public $restaurantId;
    public $title;
    public $logoUrl;


    public function __construct($restaurantId = null, $title = null, 
            $logoUrl = null) {
        $this->restaurantId  =$restaurantId;
        $this->title  = $title;
        $this->logoUrl = $logoUrl;
    }
}
