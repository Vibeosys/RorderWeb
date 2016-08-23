<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Model\Table;
use Cake\ORM\Table;
use Cake\ORM\TableRegistry;
use Cake\Log\Log;
use App\DTO\UploadDTO;
use App\DTO\DownloadDTO;
/**
 * Description of SubMenuTable
 *
 * @author niteen
 */
class SubMenuTable extends Table{
    
    private function connect() {
        return TableRegistry::get('sub_menu');
    }
    
    public function getSubMenu($restaurantId) {
        $joins = [
            'a' => [
                'table' => 'menu',
                'type' => 'INNER', 
                'conditions' => 'a.MenuId = sub_menu.MenuId and a.RestaurantId ='.$restaurantId
            ]
        ];
        
        $fields = [
            'SubMenuId' => 'sub_menu.SubMenuId',
            'MenuId'    => 'sub_menu.MenuId',
            'SubMenuTitle'    => 'sub_menu.SubMenuTitle',
            'Price'    => 'sub_menu.Price',
        ];
        
        $allSubMenu = $this->connect()->find('all',array('field' => $fields))->join($joins);
        $count = $allSubMenu->count();
        Log::debug('Number of sub menu are :- '.$count);
        $SubMenu = null;
        if($count){
            $subMenuCounter = 0;
            foreach ($allSubMenu as $menu){
                $SubMenu[$subMenuCounter++] = new DownloadDTO\SubMenuDownloadDto(
                    $menu->SubMenuId, 
                    $menu->MenuId, 
                    $menu->SubMenuTitle, 
                    $menu->Price);
            }
            return $SubMenu;
        }else{
            return false;
        }
    }
    
    public function getSub($menuId, $restaurantId) {
        $joins = [
            'a' => [
                'table' => 'menu',
                'type' => 'INNER', 
                'conditions' => 'a.MenuId = sub_menu.MenuId and a.RestaurantId ='.$restaurantId.' and sub_menu.MenuId = '.$menuId
            ]
        ];
        
        $fields = [
            'SubMenuId' => 'sub_menu.SubMenuId',
            'MenuId'    => 'sub_menu.MenuId',
            'SubMenuTitle'    => 'sub_menu.SubMenuTitle',
            'Price'    => 'sub_menu.Price',
        ];
        
        $allSubMenu = $this->connect()->find('all',array('field' => $fields))->join($joins);
        $count = $allSubMenu->count();
        Log::debug('Number of sub menu are :- '.$count);
        $SubMenu = null;
        if($count){
            $subMenuCounter = 0;
            foreach ($allSubMenu as $menu){
                $SubMenu[$subMenuCounter++] = new DownloadDTO\SubMenuDownloadDto(
                    $menu->SubMenuId, 
                    $menu->MenuId, 
                    $menu->SubMenuTitle, 
                    $menu->Price);
            }
            return $SubMenu;
        }else{
            return false;
        }
    }
    
    public function getOrderSubMenu($subMenu) {
         $joins = [
            'a' => [
                'table' => 'menu',
                'type' => 'INNER', 
                'conditions' => 'a.MenuId = sub_menu.MenuId'
            ]
        ];
         $fields = [
             'MenuTitle'    => 'a.MenuTitle',
            'SubMenuId' => 'sub_menu.SubMenuId',
            'MenuId'    => 'sub_menu.MenuId',
            'SubMenuTitle'   => 'sub_menu.SubMenuTitle',
            'Price'    => 'sub_menu.Price'
        ];
        $conditions = array('sub_menu.SubMenuId IN' => $subMenu);
        $menuInfoList = $this->connect()->find('all', array('fields' => $fields,'conditions' => $conditions))->join($joins);
        $resultMenuList = NULL; $loopCounter = 0;
        foreach ($menuInfoList as $menuItemInfo)
        {
           
            $resultMenuList[$loopCounter] = new UploadDTO\MenuShortDto(
                    $menuItemInfo->MenuId,
                    $menuItemInfo->MenuTitle,
                    $menuItemInfo->Price,
                    $menuItemInfo->SubMenuId,
                    $menuItemInfo->SubMenuTitle);
            $loopCounter++;
        }
        return $resultMenuList;
    }
}
