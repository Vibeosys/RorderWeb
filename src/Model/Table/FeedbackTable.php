<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Model\Table;
use Cake\ORM\Table;
use Cake\ORM\TableRegistry;
use Cake\Log\Log;
use App\DTO\UploadDTO;
use \App\DTO\DownloadDTO;
/**
 * Description of FeedbackTable
 *
 * @author niteen
 */
class FeedbackTable extends Table{
  
    private function connect() {
        return TableRegistry::get('feedback_master');
    }
    
    public function getFeedback($restaurantId) {
        $feedbackList = null;
        $feedbackCounter = 0;
        $conditions = ['RestaurantId =' => $restaurantId,'Active =' => ACTIVE];
        try{
            $allFeedback = $this->connect()->find()->where($conditions);
            if($allFeedback->count()){
                $feedbackList = array();
                foreach ($allFeedback as $feedback){
                    $feedbackDownloadDto = new DownloadDTO\FeedbackDownloadDto(
                            $feedback->FeedbackId, 
                            $feedback->FeedbackTitle, 
                            $feedback->Active);
                    $feedbackList[$feedbackCounter++] = $feedbackDownloadDto;
                }
            }
            return $feedbackList;
        } catch (Exception $ex) {
            return $feedbackList;
        }
    }
    
}
