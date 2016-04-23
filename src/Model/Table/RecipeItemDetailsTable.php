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
 * Description of RecipeItemTable
 *
 * @author niteen
 */
class RecipeItemDetailsTable extends Table{
   
    private function connect() {
        return TableRegistry::get('recipe_item_details');
    }
    public function getItems($restaurantId) {
        $joins = [
                    'a' => [
                            'table' => 'item_brand', 
                            'type' => 'INNER', 
                            'conditions' => 'a.BrandId = recipe_item_details.BrandId '
                        ],
                    'b' => [
                        'table' => 'recipe_item_master',
                        'type' => 'INNER',
                        'conditions' => 'b.ItemId = recipe_item_details.ItemId'
                         ],
                    'c' => [
                            'table' => 'unit_master', 
                            'type' => 'INNER', 
                            'conditions' => 'c.UnitId = b.UnitId '
                        ]
                 ];
        
        $fields = [
            'BrandCode' => 'a.BrandId',
            'BrandName' => 'a.BrandName',
            'ItemName' => 'b.ItemName',
            'Stock' => 'recipe_item_details.Quantity',
            'UnitId' => 'b.UnitId',
            'Unit'  => 'c.UnitTitle',
            'RStock' => 'recipe_item_details.RorderLevel',
        ];
        
        $response = FALSE;
        $counter = 0;
        $conditions = array('recipe_item_master.RestaurantId =' => $restaurantId);
        $allRecipItems =  $this->connect()->find('all',array('fields' => $fields, 'condition' => $conditions))->orderAsc('a.BrandId')
                    ->join($joins);
        if($allRecipItems->count()){
            foreach ($allRecipItems as $item){
                $response[$counter++] = new DownloadDTO\RecipeItemDetailsDwldDto
                        ($item->BrandCode, 
                        $item->BrandName, 
                        $item->Stock, 
                        $item->RStock, 
                        $item->Unit,
                        $item->ItemName);
            }
        }else{
            Log::debug('Records are not fount in recipe_item_details');
           
        }
        return $response;
    }
}
