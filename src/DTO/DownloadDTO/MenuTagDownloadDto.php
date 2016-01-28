<?php
namespace App\DTO\DownloadDTO;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MenuTagDownloadDto
 *
 * @author niteen
 */
class MenuTagDownloadDto {
    
    public $tagId;
    public $tagTitle;
    
    public function __construct($tagId, $tagTitle) {
        $this->tagId = $tagId;
        $this->tagTitle = $tagTitle;
    }
}
