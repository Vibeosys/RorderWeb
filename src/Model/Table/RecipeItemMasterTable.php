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
    
    public function getRecipeItems($restaurantId) {
        $joins = [
                    'a' => [
                            'table' => 'unit_master', 
                            'type' => 'INNER', 
                            'conditions' => 'a.UnitId = recipe_item_master.UnitId '
                        ]
            
                 ];
        
        $fields = [
            'ItemId' => 'recipe_item_master.ItemId',
            'ItemName' => 'recipe_item_master.ItemName',
            'UnitId' => 'recipe_item_master.UnitId',
            'SLevel' => 'recipe_item_master.SafetyLevel',
            'RLevel' => 'recipe_item_master.RorderLevel',
            'Qty' => 'recipe_item_master.QtyInHand',
            'Unit' => 'a.UnitTitle',
        ];
        $response = FALSE;
        $counter = 0;
        $conditions = array('RestaurantId =' => $restaurantId);
        $allRecipItems =  $this->connect()->find('all',array('fields' => $fields, 'condition' => $conditions))
                    ->join($joins);
        if($allRecipItems->count()){
            foreach ($allRecipItems as $recipeItems){
                $response[$counter++] = new UploadDTO\RecipeItemMaterInsertDto(
                        $recipeItems->ItemName, 
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
    
}
