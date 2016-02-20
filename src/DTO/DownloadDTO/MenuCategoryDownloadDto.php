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
    public $colour;


    public function __construct(
            $categoryId = null, 
            $categoryTitle = null, 
            $categoryImage = null, 
            $active = null, 
            $colour = null) {

        $this->categoryId = $categoryId;
        $this->categoryTitle = $categoryTitle;
        $this->categoryImage = $categoryImage;
        $this->active = $active;
        $this->colour = $colour;
    }

}
