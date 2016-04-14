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
        return  $this->getTableObj()->getMaxNo($restaurantId) + 1;
        
    }
    
    public function addTakeawayEntry($takeawayRequest, $userInfo) {
        $takeawayResult = $this->getTableObj()->takeawayInsert(
                $takeawayRequest, 
                $userInfo->restaurantId);
        if($takeawayResult){
            $takeawayEntry = $this->getTableObj()->getSingleTakeaway(
                    $takeawayResult, $userInfo->restaurantId);
            $syncController = new SyncController();
            $syncResult = $syncController->takeawayEntry(
                    $takeawayRequest->userId, 
                    json_encode($takeawayEntry), 
                    INSERT_OPERATION, 
                    $userInfo->restaurantId);
        }
        return $takeawayResult;
    }
    
    public function getLatestTakeaway($restaurantId) {
        return $this->getTableObj()->getTakeaway($restaurantId);
    }
    
    public function takeawayView() {
          $data = explode('/', $this->request->url);
        echo $data[1];
        $this->set([
            'option' => $data[1]
        ]);
    }
}
