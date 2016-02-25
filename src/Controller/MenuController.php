<?php

namespace App\Controller;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use App\Model\Table;
use Cake\Log\Log;
use Cake\Filesystem\File;
use App\DTO\DownloadDTO;

/**
 * Description of MenuController
 *
 * @author niteen
 */
define('MENU_INS_QRY', "INSERT INTO menu (MenuId,MenuTitle,Image,Price,Ingredients,"
        . "Tags,AvailabilityStatus,Active,FoodType,IsSpicy,CategoryId) "
        . "VALUES (@MenuId,\"@MenuTitle\",\"@Image\",@Price,\"@Ingredients\",\"@Tags\","
        . "@AvailabilityStatus,@Active,@FoodType,@IsSpicy,@CategoryId);");

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
        if (is_array($result)) {
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
            $preparedStatements = str_replace('@CategoryId', $menu->categoryId, $preparedStatements);
        }
        return $preparedStatements;
    }
    
    public function addNewMenu() {
       if ($this->request->is('post')) {
            $restaurantId = 999999;
            $data = $this->request->data();
            $file = $data['file-upload']['tmp_name'];
            $extenstion = $this->getExtension($data['file-upload']['name']);
            if (empty($file)) {
                $this->set(['message' => SELECT_FILE_MESSAGE,'color' => 'red']);
            } elseif ($extenstion != CSV_EXT) {
                $this->set([MESSAGE => INCORRECT_FILE_MESSAGE, 'color' => 'red']);
            } else {
                if (($handle = fopen($file, "r")) !== FALSE) {
                    $counter = 0;
                    $allMenus= null;
                    fgetcsv($handle);
                    while (($filesop = fgetcsv($handle, 1000, ",")) !== false) {
                            $menuDto = new \App\DTO\UploadDTO\MenuInsertDto(
                                    $filesop[0], 
                                    null, 
                                    $filesop[1], 
                                    $filesop[2], 
                                    null, 
                                    ACTIVE, 
                                    ACTIVE, 
                                    $filesop[3], 
                                    $filesop[4], 
                                    $filesop[5], 
                                    $restaurantId);
                           $allMenus[$counter] = $menuDto;
                           $counter++;
                    }
                    fclose($handle);
                    $result = $this->getTableObj()->insert($allMenus);
                    if ($result) {
                        $this->set(['message' => 'You database has imported successfully. You have inserted ' . $result . ' recoreds','color' => 'green']);
                    } else {
                        $this->set(['message' => DB_FILE_ERROR,'color' => 'red']);
                    }
                }
            }
        }
    }

}
