<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controller;
use App\Model\Table;
/**
 * Description of RestaurantAdminController
 *
 * @author niteen
 */
class RestaurantAdminController extends ApiController{
    
    private function getTableObj() {
        return new Table\RestaurantAdminTable();
    }
    
    public function getAdminsRestaurants($adminId) {
        return $this->getTableObj()->getRestaurants($adminId);
    }
}
