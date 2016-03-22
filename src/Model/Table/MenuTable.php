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

    public function connect() {
        return TableRegistry::get('menu');
    }

    public function getMenu($restaurantId) {

        $menus = $this->connect()->find()->where(['RestaurantId =' => $restaurantId]);
        $count = $menus->count();
        if (!$count) {
            return false;
        }
        $allMenus[] = null;
        $i = 0;
        foreach ($menus as $menu) {
            $menuDto = new DownloadDTO\MenuDownloadDto(
                    $menu->MenuId, 
                    $menu->MenuTitle, 
                    $menu->Image, 
                    $menu->Price, 
                    $menu->Ingredients, 
                    $menu->Tags, 
                    $menu->AvailabilityStatus, 
                    $menu->Active, 
                    $menu->FoodType, 
                    $menu->IsSpicy, 
                    $menu->CategoryId,
                    $menu->RoomId);
            $allMenus[$i] = $menuDto;
            $i++;
        }
        return $allMenus;
    }

    /**
     * Get menu item information by providing menu id list
     * @param menu id list
     */
    public function getMenuItemInfoList($menuIdList) {
        $conditions = array('menu.MenuId IN ' => $menuIdList);
        $menuInfoList = $this->connect()->find('all', array('conditions' => $conditions));
        $resultMenuList = NULL; $loopCounter = 0;
        foreach ($menuInfoList as $menuItemInfo)
        {
            $resultMenuList[$loopCounter] = new UploadDTO\MenuShortDto(
                    $menuItemInfo->MenuId,
                    $menuItemInfo->MenuTitle,
                    $menuItemInfo->Price);
            $loopCounter++;
        }
        return $resultMenuList;
    }
    
    public function insert($allMenu) {
         $insertResult = false;
        if(is_null($allMenu)){
            return $insertResult;
        }
        $insertCounter = 0;
        foreach ($allMenu as $menu){
            $tableObj = $this->connect();
            $newMenu = $tableObj->newEntity();
            $newMenu->MenuTitle = $menu->menuTitle;
            $newMenu->Image = $menu->image; 
            $newMenu->Price = $menu->price; 
            $newMenu->Ingredients = $menu->ingredients;
            $newMenu->Tags = $menu->tags; 
            $newMenu->AvailabilityStatus = $menu->availabilityStatus; 
            $newMenu->Active = $menu->active; 
            $newMenu->FoodType = $menu->foodType; 
            $newMenu->IsSpicy = $menu->isSpicy; 
            $newMenu->CreatedDate = date(VB_DATE_TIME_FORMAT);
            $newMenu->UpdatedDate = date(VB_DATE_TIME_FORMAT);
            $newMenu->CategoryId = $menu->categoryId+22;
            $newMenu->RestaurantId = $menu->restaurantId;
            $newMenu->RoomId = $menu->roomId;
            if($tableObj->save($newMenu)){
                $insertCounter++;
            }
        }
        return $insertCounter;
    }
    
    public function update(UploadDTO\MenuInsertDto $request) {
        $conditions = ['MenuId =' => $request->menuId];
        $key = [
            'MenuTitle' => $request->menuTitle,
            'Image' => $request->image,
            'Price' => $request->price,
            'Ingredients' => $request->ingredients,
            'Tags' => $request->tags,
            'AvailabilityStatus' => $request->availabilityStatus,
            'Active' => $request->active,
            'FoodType' => $request->foodType,
            'IsSpicy' => $request->isSpicy,
            'UpdatedDate' => date(VB_DATE_TIME_FORMAT),
            'CategoryId' => $request->categoryId,
            'RoomId' => $request->roomId
               ];
        try{
            $update = $this->connect()->query()->update();
            $update->set($key);
            $update->where($conditions);
            if($update->execute()){
                return true;
            }  else {
                return FALSE;
            }
        } catch (Exception $ex) {
           return FALSE;
        }
    }
    
    public function getUpdateMenu($menuId) {
        $conditions = ['MenuId = ' => $menuId];
        $menus = $this->connect()->find()->where($conditions);
        $count = $menus->count();
        if (!$count) {
            return false;
        }
        foreach ($menus as $menu) {
            $menuDto = new DownloadDTO\MenuDownloadDto(
                    $menu->MenuId, 
                    $menu->MenuTitle, 
                    $menu->Image, 
                    $menu->Price, 
                    $menu->Ingredients, 
                    $menu->Tags, 
                    $menu->AvailabilityStatus, 
                    $menu->Active, 
                    $menu->FoodType, 
                    $menu->IsSpicy, 
                    $menu->CategoryId,
                    $menu->RoomId);
        }
        return $menuDto;
    }

}
