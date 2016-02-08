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
    public $iconUrl;
    public $price;
    public $ingredients;
    public $tags;
    public $availabilityStatus;
    public $active;
    public $foodType;
    public $isSpicy;
    public $createdDate;
    public $updatedDate;
    public $categortId;

    public function __construct($menuId, $menuTitle, $iconUrl, $price, $ingredients, $tags, 
            $availabilityStatus, $active, $foodType, $isSpicy, $createdDate, $updatedDate, $categoryId) {
        $this->menuId = $menuId;
        $this->menuTitle = $menuTitle;
        $this->iconUrl = $iconUrl;
        $this->price = $price;
        $this->ingredients = $ingredients;
        $this->tags = $tags;
        $this->availabilityStatus = $availabilityStatus;
        $this->active = $active;
        $this->foodType = $foodType;
        $this->isSpicy = $isSpicy;
        $this->createdDate = $createdDate;
        $this->updatedDate = $updatedDate;
        $this->categortId = $categoryId;
    }

}
