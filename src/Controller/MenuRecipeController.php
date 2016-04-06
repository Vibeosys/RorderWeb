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
}
