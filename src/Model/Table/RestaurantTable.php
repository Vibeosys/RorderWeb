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
use Cake\Network\Exception;
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
    
    public function getRestaurants($restaurantId) {
        $restaurant = null;
        if($restaurantId){
        $conditions = ['RestaurantId IN' => $restaurantId];
        $rows = $this->connect()->find()->where($conditions);
        $i = 0;
        foreach ($rows as $row) {
                $entity = new DownloadDTO\RestaurantShowDto(
                        $row->RestaurantId, 
                        $row->Title, 
                        $row->LogoUrl,
                        $row->Address,
                        $row->Active,
                        $row->Area,
                        $row->City,
                        $row->Country);  
                $restaurant[$i] = $entity;$i++;
        }
        }
        return $restaurant;
    }
    
    public function update(DownloadDTO\RestaurantShowDto $restaurantInfo) {
        $key = [
                'Title' => $restaurantInfo->title,
                'LogoUrl' => $restaurantInfo->logoUrl,
                'Address' => $restaurantInfo->address,
                'Area' => $restaurantInfo->area,
                'City' => $restaurantInfo->city,
                'Country' => $restaurantInfo->country
                ];
        $conditions = ['RestaurantId =' => $restaurantInfo->restaurantId];
        if(!is_null($restaurantInfo->active)){
             $key['Active'] = $restaurantInfo->active;
        }
        try{
            $tableObj = $this->connect()->query()->update();
            $tableObj->set($key);
            $tableObj->where($conditions);
            if($tableObj->execute()){
                return true;
            }
            return false;
        } catch (Exception $ex) {
            throw new Exception\NotFoundException('Database error occured in restaurant info updation');
        }
    }
}
