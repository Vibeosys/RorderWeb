<?php
namespace App\Model\Table;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
use Cake\ORM\Table;
use Cake\ORM\TableRegistry;
use App\DTO\DownloadDTO;
/**
 * Description of RestaurantTable
 *
 * @author niteen
 */
class RestaurantTable extends Table{
       
    public function connect() {
      
        return TableRegistry::get('restaurant');
    }
    
    public function getData($restaurantId) {
        $conditions = ['RestaurantId =' => $restaurantId];
        $rows = $this->connect()->find()->where($conditions);
         $restaurant = null;
        foreach ($rows as $row) {
                $entity = new DownloadDTO\RestaurantDownloadDto(
                        $row->RestaurantId, 
                        $row->Title, 
                        $row->LogoUrl);  
                $restaurant = $entity;
        }
        return $restaurant;
    }
    
    public function check($restaurantId) {
        $conditions = ['RestaurantId =' => $restaurantId,'Active =' => ACTIVE];
        $result = $this->connect()->find()->where($conditions);
        if($result->count()){
            \Cake\Log\Log::debug('restaurant checking result = '.$result->count());
            return true;
        }
        return false;
    }
}
