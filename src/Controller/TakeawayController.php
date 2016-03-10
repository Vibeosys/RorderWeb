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
 * Description of TakeawayController
 *
 * @author niteen
 */
class TakeawayController extends ApiController{
    
    private function getTableObj() {
        return new Table\TakeawayTable();
    }
    
    public function getTakeawayNo($restaurantId) {
        $maxNo = $this->getTableObj()->getMaxNo($restaurantId);
        if($maxNo){
            return $maxNo;
        }  else {
            return $maxNo + 1;
        }
    }
}
