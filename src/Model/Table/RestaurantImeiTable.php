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
/**
 * Description of RestaurantIMEITable
 *
 * @author niteen
 */
class RestaurantImeiTable extends Table{
    
    private function connect() {
        return TableRegistry::get('restaurant_imei');
    }
    
    public function check($restaurantId, $imei) {
        $conditions = ['RestaurantId =' => $restaurantId, 'IMEI =' => $imei];
        $queryResult = $this->connect()->find()->where($conditions);
        $check = $queryResult->count();
        return $check;
    }
}
