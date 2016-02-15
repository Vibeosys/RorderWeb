<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\DTO\DownloadDTO;

/**
 * Description of MenuNoteDownloadDto
 *
 * @author niteen
 */
class MenuNoteDownloadDto {
    
    public $noteId;
    public $noteTitle;
    public $active;
    
    public function __construct($noteId = null, $noteTitle = null, $active = null) {
        $this->noteId = $noteId;
        $this->noteTitle = $noteTitle;
        $this->active = $active;
    }
}
