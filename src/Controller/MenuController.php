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
 * Description of MenuController
 *
 * @author niteen
 */
define('MENU_INS_QRY', "INSERT INTO menu (MenuId,MenuTitle,Image,Price,Ingredients,"
        . "Tags,AvailabilityStatus,Active,FoodType,IsSpicy,CreatedDate,UpdatedDate,CategoryId) "
        . "VALUES (@MenuId,\"@MenuTitle\",\"@Image\",@Price,\"@Ingredients\",\"@Tags\","
        . "@AvailabilityStatus,@Active,@FoodType,@IsSpicy,\"@CreatedDate\",\"@UpdatedDate\",@CategoryId);");

class MenuController extends ApiController {

    private function getTableObj() {
        return new Table\MenuTable();
    }

    public function getMenus($restaurantId) {

        $result = $this->getTableObj()->getMenu($restaurantId);
        if ($result) {
            return $result;
        }
        return false;
    }
    
    public function getMenuItemList($restaurantId, $menuItemIdList) {
        $result = $this->getTableObj()->getMenuItemInfoList($restaurantId, $menuItemIdList);
        if (isset($result)) {
            return $result;
        }
        return NULL;
    }

    public function prepareInsertStatements($restaurantId) {

        $allMenus = $this->getMenus($restaurantId);
        if (!$allMenus) {
            return false;
        }
        $preparedStatements = '';

        foreach ($allMenus as $menu) {
            $preparedStatements .= MENU_INS_QRY;
            $preparedStatements = str_replace('@MenuId', $menu->menuId, $preparedStatements);
            $preparedStatements = str_replace('@MenuTitle', $menu->menuTitle, $preparedStatements);
            $preparedStatements = str_replace('@Image', $menu->image, $preparedStatements);
            $preparedStatements = str_replace('@Price', $menu->price, $preparedStatements);
            $preparedStatements = str_replace('@Ingredients', $menu->ingredients, $preparedStatements);
            $preparedStatements = str_replace('@Tags', $menu->tags, $preparedStatements);
            $preparedStatements = str_replace('@AvailabilityStatus', $menu->availabilityStatus, $preparedStatements);
            $preparedStatements = str_replace('@Active', $menu->active, $preparedStatements);
            $preparedStatements = str_replace('@FoodType', $menu->foodType, $preparedStatements);
            $preparedStatements = str_replace('@IsSpicy', $menu->isSpicy, $preparedStatements);
            $preparedStatements = str_replace('@CreatedDate', $menu->createdDate, $preparedStatements);
            $preparedStatements = str_replace('@UpdatedDate', $menu->updatedDate, $preparedStatements);
            $preparedStatements = str_replace('@CategoryId', $menu->categortId, $preparedStatements);
        }
        return $preparedStatements;
    }

}
