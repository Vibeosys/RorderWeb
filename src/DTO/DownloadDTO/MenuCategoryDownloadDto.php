<?php

namespace App\DTO\DownloadDTO;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MenuCategoryDownloadDto
 *
 * @author niteen
 */
class MenuCategoryDownloadDto {

    public $categoryId;
    public $categoryTitle;
    public $categoryImage;
    public $active;
    public $createdDate;
    public $updatedDate;
    public $colour;
    public $imgUrl;

    public function __construct(
            $categoryId = null, 
            $categoryTitle = null, 
            $categoryImage = null, 
            $active = null, 
            $createdDate = null, 
            $updatedDate = null,
            $colour = null,
            $imgUrl = null) {

        $this->categoryId = $categoryId;
        $this->categoryTitle = $categoryTitle;
        $this->categoryImage = $categoryImage;
        $this->active = $active;
        $this->createdDate = $createdDate;
        $this->updatedDate = $updatedDate;
        $this->colour = $colour;
        $this->imgUrl = $imgUrl;
    }

}
