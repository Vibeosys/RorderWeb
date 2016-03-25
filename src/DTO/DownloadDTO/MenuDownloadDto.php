<?php

namespace App\DTO\DownloadDTO;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MenuDownloadDto
 *
 * @author niteen
 */
class MenuDownloadDto {

    public $menuId;
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
    public $roomId;
    public $fbTypeId;

    public function __construct($menuId, $menuTitle, $image, $price, $ingredients, $tags, 
            $availabilityStatus, $active, $foodType, $isSpicy, $categoryId, $roomId, $fbTypeId = null) {
        $this->menuId = $menuId;
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
        $this->roomId = $roomId;
        $this->fbTypeId = $fbTypeId;
    }

}
