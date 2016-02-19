<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controller;
use App\Model\Table;
/**
 * Description of RestaurantIMEIController
 *
 * @author niteen
 */
class RestaurantImeiController {
    
    private function getTableObj() {
        return new Table\RestaurantImeiTable();
    }
    
    public function isPresent($restaurantId, $imei) {
        return $this->getTableObj()->check($restaurantId, $imei);
    }
}
