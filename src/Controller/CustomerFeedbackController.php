<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controller;
use App\Model\Table;
use Cake\Log\Log;
/**
 * Description of CustomerFeedbackController
 *
 * @author niteen
 */
class CustomerFeedbackController extends ApiController{
    
    private function getTableObj() {
        return new Table\CustomerFeedbackTable();
    }
    
    public function addCustomerFeedback($customerFeedbackList, $userInfo) {
        return $this->getTableObj()->insert($customerFeedbackList, $userInfo);
        
    }
}
