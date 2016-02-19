<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Model\Table;

use App\DTO\DownloadDTO;
use Cake\Log\Log;
use Cake\ORM\Table;
use Cake\ORM\TableRegistry;
use App\DTO\UploadDTO;
use Cake\Datasource\ConnectionManager;

/**
 * Description of CustomerFeedbackTable
 *
 * @author niteen
 */
class CustomerFeedbackTable extends Table {

    private function connect() {
        return TableRegistry::get('customer_feedback');
    }

    public function insert(UploadDTO\CustomerFeedbackUploadDto $customerFeedback, $userInfo) {
        $conn = ConnectionManager::get('default');
        $conn->begin();
        $tableObj = $this->connect();
        $customerFeedbackCounter = 0;
        try {
            foreach ($customerFeedback->feedback as $feedback) {
                $newCustomerFeedback = $tableObj->newEntity();
                $newCustomerFeedback->CustId = $customerFeedback->custId;
                $newCustomerFeedback->UserId = $userInfo->userId;
                $newCustomerFeedback->FeedbackId = $feedback->feedbackId;
                $newCustomerFeedback->FeedbackRating = $feedback->feedbackRating;
                $newCustomerFeedback->CreatedDate = date(VB_DATE_TIME_FORMAT);
                
                if ($tableObj->save($newCustomerFeedback)) {
                    $customerFeedbackCounter++;
                }  else {
                    $customerFeedbackCounter = 0;
                }
            }
            
        } catch (Exception $ex) {
            $conn->rollback();
            return $customerFeedbackCounter;
        }
        if($customerFeedbackCounter){
            $conn->commit();
            return $customerFeedbackCounter;
        }
    }

}
