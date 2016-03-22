<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\DTO\UploadDTO;

/**
 * Description of MenuInsertDto
 *
 * @author niteen
 */
class MenuInsertDto {

    public $menuTitle;
    public $image;
    public $price;
    public $ingredients;
    public $tags;
    public $availabilityStatus;
    public $active;
    public $foodType;
    public $isSpicy;
    public $categoryId;
    public $restaurantId;
    public $roomId;
    public $menuId;


    public function __construct($menuTitle, $image, $price, $ingredients, $tags, 
            $availabilityStatus, $active, $foodType, $isSpicy, $categoryId, 
            $restaurantId,$roomId, $menuId = null) {
        $this->menuTitle = $menuTitle;
        $this->image = $image;
        $this->price = $price;
        $this->ingredients = $ingredients;
        $this->tags = $tags;
        $this->availabilityStatus = $availabilityStatus;
        $this->active = $active;
        $this->foodType = $foodType;
        $this->isSpicy = $isSpicy;
        $this->categoryId = $categoryId;
        $this->restaurantId = $restaurantId;
        $this->roomId = $roomId;
        $this->menuId = $menuId;
    }
}
