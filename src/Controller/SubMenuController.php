<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controller;
use App\Model\Table;
/**
 * Description of SubMenuController
 *
 * @author niteen
 */
define('SUBMENU_INS_QRY', "INSERT INTO sub_menu (SubMenuId,MenuId,SubMenuTitle,"
        . "Price)VALUES (@SubMenuId,@MenuId,\"@SubMenuTitle\",@Price);");
class SubMenuController extends ApiController{
    
    private function getTableObj() {
        return new Table\SubMenuTable();
    }
    
    
    public function prepareInsertStatements($restaurantId) {

        $allMenus = $this->getTableObj()->getSubMenu($restaurantId);
        if (!$allMenus) {
            return false;
        }
        $preparedStatements = '';

        foreach ($allMenus as $menu) {
            $preparedStatements .= SUBMENU_INS_QRY;
            $preparedStatements = str_replace('@SubMenuId', $menu->subMenuId, $preparedStatements);
            $preparedStatements = str_replace('@MenuId', $menu->menuId, $preparedStatements);
            $preparedStatements = str_replace('@SubMenuTitle', $menu->subMenuTitle, $preparedStatements);
            $preparedStatements = str_replace('@Price', $menu->price, $preparedStatements);
        }
        return $preparedStatements;
    }
    
    public function getSubMenu($subMenuList) {
        return $this->getTableObj()->getOrderSubMenu($subMenuList);
    }
    
    public function getMenu() {
        $this->autoRender = false;
        $data = $this->request->data;
        \Cake\Log\Log::debug($data);
        $result = $this->getTableObj()->getSub($data['menuId'], $this->readCookie('cri'));
        $this->response->body(json_encode($result));
    }
    
}
