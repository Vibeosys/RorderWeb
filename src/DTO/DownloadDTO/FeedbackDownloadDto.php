<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\DTO\DownloadDTO;

/**
 * Description of FeedbackDownloadDto
 *
 * @author niteen
 */
class FeedbackDownloadDto {
    
    public  $feedbackId;
    public  $feedbackTitle;
    public  $active;
    
    public function __construct($feedbackId = null, $feedbackTitle = null, 
            $active = null) {
        $this->feedbackId = $feedbackId;
        $this->feedbackTitle = $feedbackTitle;
        $this->active = $active;
    }
}
