<?php

namespace App\Model\Table;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use App\DTO\DownloadDTO;
use App\DTO\UploadDTO;
use Cake\Log\Log;
use Cake\ORM\Table;
use Cake\ORM\TableRegistry;

/**
 * Description of MenuTable
 *
 * @author niteen
 */
class MenuTable extends Table {

    private function connect() {
        return TableRegistry::get('menu');
    }

    public function getMenu($restaurantId) {

        $menus = $this->connect()->find()->where(['restaurantId =' => $restaurantId]);
        $count = $menus->count();
        if (!$count) {
            return false;
        }
        $allMenus[] = null;
        $i = 0;
        foreach ($menus as $menu) {
            //if($restaurantId == $menu->RestaurantId){
            Log::debug('menu for restaurantId = ' . $restaurantId . ' is found');
            $menuDto = new DownloadDTO\MenuDownloadDto(
                    $menu->MenuId, 
                    $menu->MenuTitle, 
                    $menu->IconUrl, 
                    $menu->Price, 
                    $menu->Ingredients, 
                    $menu->Tags, 
                    $menu->AvailabilityStatus, 
                    $menu->Active, 
                    $menu->FoodType, 
                    $menu->IsSpicy, 
                    $menu->CreatedDate, 
                    $menu->UpdatedDate, 
                    $menu->CategoryId);
            //}
            $allMenus[$i] = $menuDto;
            $i++;
        }
        return $allMenus;
    }

    /**
     * Get menu item information by providing menu id list
     * @param menu id list
     */
    public function getMenuItemInfoList($restaurantId, $menuIdList) {
        $conditions = array('menu.MenuId IN ' => $menuIdList);
        $menuInfoList = $this->connect()->find('all', array('conditions' => $conditions));
        $resultMenuList[] = NULL; $loopCounter = 0;
        foreach ($menuInfoList as $menuItemInfo)
        {
            $resultMenuList[$loopCounter] = new UploadDTO\MenuShortDto(
                    $menuItemInfo->MenuId,
                    $menuItemInfo->MenuTitle,
                    $menuItemInfo->Price );
            $loopCounter++;
        }
        return $resultMenuList;
    }

}
