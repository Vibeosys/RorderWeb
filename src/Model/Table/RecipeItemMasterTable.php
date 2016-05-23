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
 * Description of RecipeItemMasterTable
 *
 * @author niteen
 */
class RecipeItemMasterTable extends Table{
    
    public function connect() {
        return TableRegistry::get('recipe_item_master');
    }
    
    public function insert($bunchRequest) {
        $result = false;
        try{
            $tableObj = $this->connect();
            foreach ($bunchRequest as $request){ 
                $newEntity = $tableObj->newEntity();
                $newEntity->ItemName = $request->itemName;
                $newEntity->UnitId = $request->unitId;
                $newEntity->SafetyLevel = $request->sLevel;
                $newEntity->RorderLevel = $request->rLevel;
                $newEntity->QtyInHand = $request->qty;
                if($tableObj->save($newEntity)){
                  $result[$request->itemName] = $newEntity->ItemId;
                }
            }
            return $result;    
        } catch (Exception $ex) {
            return FALSE;
        }
    }
    
    public function update($itemId, $restaurantId, $stock) {
        $conditions = [
            'ItemId =' => $itemId,
            'RestaurantId =' => $restaurantId
        ];
        $key = ['QtyInHand' => $stock];
        try{
            $update = $this->connect()->query()->update();
            $update->set($key);
            $update->where($conditions);
            if($update->execute()){
                return true;
            }
            return FALSE;
        } catch (Exception $ex) {
            return FALSE;
        }
    }
     public function getStock($restaurantId) {
        $joins = [
                    'a' => [
                            'table' => 'unit_master', 
                            'type' => 'INNER', 
                            'conditions' => 'a.UnitId = recipe_item_master.UnitId '
                        ],
                    'b' => [
                        'table' => 'item_category',
                        'type' => 'INNER',
                        'conditions' => 'b.ItemCategoryId = recipe_item_master.ItemCategoryId'
                    ]
            
                 ];
        
        $fields = [
            'ItemId' => 'recipe_item_master.ItemId',
            'ItemName' => 'recipe_item_master.ItemName',
            'Category' => 'b.ItemCategoryTitle',
            'UnitId' => 'recipe_item_master.UnitId',
            'SLevel' => 'recipe_item_master.SafetyLevel',
            'RLevel' => 'recipe_item_master.RorderLevel',
            'Qty' => 'recipe_item_master.QtyInHand',
            'Unit' => 'a.UnitTitle',
        ];
        $response = FALSE;
        $counter = 0;
        $conditions = array('RestaurantId =' => $restaurantId,'QtyInHand <' => 'RorderLevel');
        $allRecipItems =  $this->connect()->find('all',array('fields' => $fields, 'condition' => $conditions))
                    ->join($joins);
        if($allRecipItems->count()){
            foreach ($allRecipItems as $recipeItems){
                $response[$counter++] = new UploadDTO\RecipeItemMaterInsertDto(
                        $recipeItems->ItemName, 
                        $recipeItems->Category,
                        $recipeItems->UnitId, 
                        $recipeItems->SLevel, 
                        $recipeItems->RLevel, 
                        $recipeItems->Qty, 
                        $recipeItems->ItemId, 
                        $recipeItems->Unit);
            }
        }
        return $response;
    }
    
    public function getRecipeItems($restaurantId, $type) {
     /*   $joins = [
                    'a' => [
                            'table' => 'unit_master', 
                            'type' => 'INNER', 
                            'conditions' => 'a.UnitId = recipe_item_master.UnitId '
                        ],
                    'b' => [
                        'table' => 'item_category',
                        'type' => 'INNER',
                        'conditions' => 'b.ItemCategoryId = recipe_item_master.ItemCategoryId'
                    ]
            
                 ];
        
        $fields = [
            'ItemId' => 'recipe_item_master.ItemId',
            'ItemName' => 'recipe_item_master.ItemName',
            'Category' => 'b.ItemCategoryTitle',
            'UnitId' => 'recipe_item_master.UnitId',
            'SLevel' => 'recipe_item_master.SafetyLevel',
            'RLevel' => 'recipe_item_master.RorderLevel',
            'Qty' => 'recipe_item_master.QtyInHand',
            'Unit' => 'a.UnitTitle',
        ];*/
        
        $response = FALSE;
        $counter = 0;
        if($type == 1){
        $unitId = [1,2,5];
        }else{
            $unitId = [3,4];
        }
        
        $conditions = array('RestaurantId =' => $restaurantId,'RorderLevel >' => 'QtyInHand', 'UnitId IN' => $unitId);
        $allRecipItems =  $this->connect()->find()->where($conditions);
                    //->join($joins);
        if($allRecipItems->count()){
            foreach ($allRecipItems as $recipeItems){
                $response[$counter++] = new UploadDTO\RecipeItemMaterInsertDto(
                        $recipeItems->ItemName, 
                        $recipeItems->Category,
                        $recipeItems->UnitId, 
                        $recipeItems->SLevel, 
                        $recipeItems->RorderLevel, 
                        $recipeItems->QtyInHand, 
                        $recipeItems->ItemId, 
                        $recipeItems->Unit);
            }
        }
        return $response;
    }
    
    public function getItems($restaurantId) {
        $response = FALSE;
        $counter = 0;
        $conditions = array('RestaurantId =' => $restaurantId);
        try{
            $allItems = $this->connect()->find()->where($conditions);
            if($allItems->count()){
                foreach ($allItems as $item){
                    $response[$counter++] = 
                            new DownloadDTO\RecipeItemMasterShortDto(
                                    $item->ItemId, $item->ItemName);
                }
            }
            return $response;    
        } catch (Exception $ex) {
            return FALSE;
        }
    }
    
}
