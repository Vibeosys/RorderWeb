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
    
    public function getData() {
        if (!$this->connect()->find()->count()) {
            return false;
        }
        $rows = $this->connect()->find();
         $restaurants[] = null;
        $i = 0;
        foreach ($rows as $row) {
         
                $entity = new DownloadDTO\RestaurantDownloadDto($row->RestaurantId, $row->Title);  
                $restaurants[$i]= $entity;
                $i++;
            
        }
        return $restaurants;
        
    }
    public function check($id) {
        $result = $this->connect()->find()->where(['RestaurantId =' => $id]);
        if($result->count()){
            \Cake\Log\Log::debug('restaurant checking result = '.$result->count());
            return true;
        }
        return false;
    }
    
    
}
