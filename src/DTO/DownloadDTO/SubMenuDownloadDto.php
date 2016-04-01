<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\DTO\DownloadDTO;

/**
 * Description of SubMenuDownloadDto
 *
 * @author niteen
 */
class SubMenuDownloadDto {
    
    public $subMenuId;
    public $menuId;
    public $subMenuTitle;
    public $price;
    
    public function __construct($subMenuId = null, $menuId = null, 
            $subMenuTitle = null, $price = null) {
        $this->subMenuId = $subMenuId;
        $this->menuId = $menuId;
        $this->subMenuTitle = $subMenuTitle;
        $this->price = $price;
    }
}
