<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controller;
use App\Model\Table;
Use Cake\Log\Log;
/**
 * Description of MenuRecipeController
 *
 * @author niteen
 */
class MenuRecipeController extends ApiController{
    
    public function getTableObj() {
        return new Table\MenuRecipeTable();
    }
    
    public function getMenuRecipe($menuId) {
        return $this->getTableObj()->getRecipe($menuId);
    }
    
    public function addNewRecipeItem($insertRequest) {
        return $this->getTableObj()->insert($insertRequest);
    }
    
    public function editRecipeItem() {
       $this->autoRender = FALSE;
       $menuId = parent::readCookie('current-mid');
       $data = $this->request->data;
        if(!$this->isLogin()){
            $this->redirect('../login');
        }elseif ($this->request->is('post') and isset ($data['save'])) {
            $item = new \stdClass();
            foreach ($data as $key => $value){
                $item->$key = $value;
            }
            $item->menuId = $menuId;
            $result = $this->getTableObj()->update($item);
            if($result){
                $this->redirect('menu/editrecipe');   
            }
        }elseif ($this->request->is('post') and isset ($data['delete'])) {
            $item = new \stdClass();
            foreach ($data as $key => $value){
                $item->$key = $value;
            }
            $item->menuId = $menuId;
            $result = $this->getTableObj()->remove($item);
            if($result){
                $this->redirect('menu/editrecipe');   
            }
        }  else {
            $this->redirect('menu/editrecipe');    
        }
        
        
    }
}
