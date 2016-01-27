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
 * Description of RestaurantController
 *
 * @author niteen
 */
class RestaurantController extends ApiController{
    
    private function getTableObj() {
        return new Table\RestaurantTable();;
    }
     
    public function index() {
        $this->autoRender = false;
        
        if(1){
            $result  = $this->getTableObj()->getData();
            Log::debug("All restaurant send to anominous user");
            $this->response->body(json_encode($result));
        }
    }
    public function isValidate($id) {
        if($id){
            $result =  $this->getTableObj()->check($id);
            if($result){
                return true;
            }
        }
        return false;           

    }
}
