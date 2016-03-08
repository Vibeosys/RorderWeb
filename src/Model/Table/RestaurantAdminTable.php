<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Model\Table;
use Cake\ORM\TableRegistry;
use Cake\ORM\Table;
use Cake\Log\Log;
use App\DTO\UploadDTO;

/**
 * Description of RestaurantAdminTable
 *
 * @author niteen
 */
class RestaurantAdminTable extends Table{
    
    private function connect() {
        return TableRegistry::get('restaurant_admin');
    }
    
    public function getRestaurants($adminId) {
        $result = null;
        $counter = 0;
        if($adminId){
            $conditions = ['AdminUserId' => $adminId];
            $restaurants = $this->connect()->find()->where($conditions);
            foreach ($restaurants as $restaurant){
                $result[$counter] = $restaurant->RestaurantId;
                $counter++;
            }
            Log::debug('Admin information send');
        }
        return $result;
    }
    
}
