<?php
namespace App\Controller;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
use App\Model\Table;
use Cake\Log\Log;

/**
 * Description of FeedbackController
 *
 * @author niteen
 */
define('FM_INS_QRY', "INSERT INTO feedback_master (FeedbackId,"
        . "FeedbackTitle,Active) VALUES (@FeedbackId,\"@FeedbackTitle\",@Active);");
class FeedbackController extends ApiController{
    private function getTableobj() {
        return new Table\FeedbackTable();
    }
    
    public function getFeedbackList() {
        return $this->getTableobj()->getFeedback();
    }
    
    public function prepareInsertStatements() {
        $feedbackList = $this->getFeedbackList();
        if(is_null($feedbackList)){
            return false;
        }
         $preparedStatements = null;

        foreach ($feedbackList as $feedback) {
            $preparedStatements .= FM_INS_QRY;
            $preparedStatements = str_replace('@FeedbackId', $feedback->feedbackId, $preparedStatements);
            $preparedStatements = str_replace('@FeedbackTitle', $feedback->feedbackTitle, $preparedStatements);
            $preparedStatements = str_replace('@Active', $feedback->active, $preparedStatements);
        }
        return $preparedStatements;
        
    }
}
