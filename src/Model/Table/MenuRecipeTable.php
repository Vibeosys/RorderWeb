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
 * Description of MenuRecipeTable
 *
 * @author niteen
 */
class MenuRecipeTable extends Table{
    
    public function connect() {
        return TableRegistry::get('menu_recipe');
    }
    
    public function getRecipe($menuId) {
        $joins = [
            'a' => [
                'table' => 'recipe_item_master',
                'type' => 'INNER',
                'conditions' => 'menu_recipe.ItemId = a.ItemId'
            ],
            'b' => [
                'table' => 'unit_master',
                'type' => 'INNER',
                'conditions' => 'menu_recipe.UnitId = b.UnitId and menu_recipe.MenuId ='. $menuId
            ],
        ];
        
        $fields = [
            'ItemId' => 'menu_recipe.ItemId',
            'ItemName' => 'a.ItemName',
            'UsedQty' => 'menu_recipe.quantity',
            'UnitId' => 'menu_recipe.UnitId',
            'UnitTitle' => 'b.UnitTitle',
        ];
        $conditions = ['menu_recipe.MenuId =' => $menuId];
        $allRecipe = null;
        $recipeCounter = 0;
        try{
            $resultSet = $this->connect()->find('all',['fields' => $fields])->join($joins);
            foreach ($resultSet as $result){
                $allRecipe[$recipeCounter++] = new 
                        DownloadDTO\MenuRecipeDownloadDto(
                                $result->ItemId, 
                                $result->ItemName, 
                                $result->UsedQty, 
                                $result->UnitId, 
                                $result->UnitTitle); 
            }
            return $allRecipe;
        } catch (Exception $ex) {
            return FALSE;
        }
        
    }
    
    public function insert($request) {
        try{
            $tableObj = $this->connect();
            $newEntity = $tableObj->newEntity();
            $newEntity->MenuId = $request->menuId;
            $newEntity->ItemId = $request->itemId;
            $newEntity->quantity = $request->qty;
            $newEntity->UnitId = $request->unitId;
            if($tableObj->save($newEntity)){
                return true;
            }
            return FALSE;
        } catch (Exception $ex) {
            return FALSE;
        }
    }
    
   
}
