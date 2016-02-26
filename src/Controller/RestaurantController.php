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
define('R_INS_QRY', "INSERT INTO restaurant (RestaurantId,"
        . "RestaurantTitle,LogoUrl) VALUES (@RestaurantId,\"@RestaurantTitle\",\"@LogoUrl\");");
class RestaurantController extends ApiController{
    
    private function getTableObj() {
        return new Table\RestaurantTable();;
    }
     
    public function getRestaurant($restaurantId) {
        return $this->getTableObj()->getData($restaurantId);
    }
    public function isValidate($restaurantId) {
        return  $this->getTableObj()->check($restaurantId);
    }
    
    public function getAdminRestaurants($restaurantId) {
        return $this->getTableObj()->getRestaurants($restaurantId);
    }
    
    public function prepareInsertStatements($restaurantId) {
        $restaurants = $this->getRestaurant($restaurantId);
        if(is_null($restaurants)){
            return false;
        }
         $preparedStatements = null;
            $preparedStatements .= R_INS_QRY;
            $preparedStatements = str_replace('@RestaurantId', $restaurants->restaurantId, $preparedStatements);
            $preparedStatements = str_replace('@RestaurantTitle', $restaurants->title, $preparedStatements);
            $preparedStatements = str_replace('@LogoUrl', $restaurants->logoUrl, $preparedStatements);
        return $preparedStatements;
    }
    
    public function updateRestaurantInfo($restaurantDto) {
        return $this->getTableObj()->update($restaurantDto);
    }
}
    
