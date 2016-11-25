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
        . "RestaurantTitle,LogoUrl,Address,Area,City,Country,Phone,Footer) VALUES"
        . " (@RestaurantId,\"@RestaurantTitle\",\"@LogoUrl\",\"@Address\",\"@Area\","
        . "\"@City\",\"@Country\",\"@Phone\",\"@Footer\");");
class RestaurantController extends ApiController{
    
    private function getTableObj() {
        return new Table\RestaurantTable();;
    }
     
    public function isValidate($restaurantId) {
        return  $this->getTableObj()->check($restaurantId);
    }
    
    public function getAdminRestaurants($restaurantArray) {
        return $this->getTableObj()->getRestaurants($restaurantArray);
    }
    
    public function prepareInsertStatements($restaurantId) {
        $restaurants = $this->getAdminRestaurants(array($restaurantId));
        if(is_null($restaurants)){
            return false;
        }
        foreach ($restaurants as $restaurant){
         $preparedStatements = null;
            $preparedStatements .= R_INS_QRY;
            $preparedStatements = str_replace('@RestaurantId', $restaurant->restaurantId, $preparedStatements);
            $preparedStatements = str_replace('@RestaurantTitle', $restaurant->title, $preparedStatements);
            $preparedStatements = str_replace('@LogoUrl', $restaurant->logoUrl, $preparedStatements);
            $preparedStatements = str_replace('@Address', $restaurant->address, $preparedStatements);
            $preparedStatements = str_replace('@Area', $restaurant->area, $preparedStatements);
            $preparedStatements = str_replace('@City', $restaurant->city, $preparedStatements);
            $preparedStatements = str_replace('@Country', $restaurant->country, $preparedStatements);
            $preparedStatements = str_replace('@Phone', $restaurant->phone, $preparedStatements);
            $preparedStatements = str_replace('@Footer', $restaurant->footer, $preparedStatements);
        }
        return $preparedStatements;
    }
    
    public function updateRestaurantInfo($restaurantDto) {
        return $this->getTableObj()->update($restaurantDto);
    }
}
    
