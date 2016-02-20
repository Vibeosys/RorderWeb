<?php
namespace App\DTO\DownloadDTO;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TableCategoryDownloadDto
 *
 * @author niteen
 */
class TableCategoryDownloadDto {
    
    public $tableCategoryId;
    public $categoryTitle;
    public $image;
    
    public function __construct($tableCategoryId, $categoryTitle, $image) {
        
        $this->tableCategoryId = $tableCategoryId;
        $this->categoryTitle = $categoryTitle;
        $this->image = $image;
    }
    
}
