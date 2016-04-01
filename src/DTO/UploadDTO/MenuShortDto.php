<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\DTO\UploadDTO;

/**
 * Description of MenuShortDto
 *
 * @author anand
 */
class MenuShortDto {
    
    public $menuId;
    public $menuTitle;
    public $price;
    public $subMenuId;
    public $subMenuTitle;


    public function __construct($menuId = NULL, $menuTitle = NULL, $price = NULL,
            $subMenuId = null, $subMenuTitle = null) {
        $this->menuId = $menuId;
        $this->menuTitle = $menuTitle;
        $this->price = $price;
        $this->subMenuId = $subMenuId;
        $this->subMenuTitle = $subMenuTitle;
    }
}
