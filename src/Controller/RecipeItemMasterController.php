<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controller;
use App\Model\Table;
use App\DTO\UploadDTO;
use Cake\Log\Log;
/**
 * Description of RecipeItemMasterController
 *
 * @author niteen
 */
class RecipeItemMasterController extends ApiController{
    
    private function getTableObj() {
        return new Table\RecipeItemMasterTable();
    }
    
    public function AddNewRecipeItem() {
          if(!$this->isLogin()){
            $this->redirect('login');
        }
       if ($this->request->is('post') and isset($this->request->data['add-item'])) {
            $restaurantId = parent::readCookie('cri');
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
                    $allItems= null;
                    $fileCount = count(fgetcsv($handle));
                    while (($filesop = fgetcsv($handle, 1000, ",")) !== false) {
                        $allItems[$counter++] = new UploadDTO\RecipeItemMaterInsertDto(
                                $filesop[0], 
                                $filesop[1], 
                                $filesop[2], 
                                $filesop[3], 
                                $filesop[4]);
                    }
                    fclose($handle);
                    $result = $this->getTableObj()->insert($allItems);
                    if ($result) {
                        $this->set(['message' => 'You database has imported successfully. You have inserted ' . count($result) . ' recoreds','color' => 'green']);
                    } else {
                        $this->set(['message' => DB_FILE_ERROR,'color' => 'red']);
                    }
                }
            }
        }
    }
    
    public function inventory() {
         if(!$this->isLogin()){
            $this->redirect('login');
        }
        $page = $this->request->param('page');
        $data = $this->request->data;
        $restaurantId = $this->readCookie('cri');
        if($this->request->is('post') and isset($data['os'])){
              $this->redirect('inventory');
        }elseif ($this->request->is('post') and isset($data['cs'])) {
              $this->redirect('inventory');
            
        }elseif ($this->request->is('post') and isset($data['su'])) {
              $this->redirect('inventory/stockupload');
        }
        
       $allRecipeitems = $this->getTableObj()->getRecipeItems($restaurantId);
       $this->set([
                'items' => $allRecipeitems
       ]);
        
    }
    
    public function stockUpload() {
        $data = $this->request->data;
        if($this->request->is('post') and isset($data['add-m'])){
            parent::writeCookie('msu-message', 'Material Stock Updated');  
            $this->redirect('inventory/stockupload');
              
        }elseif ($this->request->is('post') and isset($data['add-mb'])) {
            parent::writeCookie('mbsu-message', 'Material Brand Stock Updated');
            $this->redirect('inventory/stockupload');
            
        }elseif ($this->request->is('post') and isset($data['su'])) {
              $this->redirect('inventory/stockupload');
        } 
        $message = parent::readCookie('msu-message');
        parent::deleteCookie('msu-message');
        $message1 = parent::readCookie('mbsu-message');
        parent::deleteCookie('mbsu-message');
        if($message){
            \Cake\Log\Log::debug('message:- '.$message);
            $this->set(['message',$message]);
        }  else {
            \Cake\Log\Log::debug('message:- '.$message1);
            $this->set(['message',$message1]);
        }
    }
    
    public function materialStockUpload() {
         if(!$this->isLogin()){
            $this->redirect('login');
        }
        
    }
    public function materialBrandStockUpload() {
         if(!$this->isLogin()){
            $this->redirect('login');
        }
        
    }
    
    public function materialStockModification() {
         if(!$this->isLogin()){
            $this->redirect('login');
        }
        
    }
    
    public function materialBrandStockModification() {
         if(!$this->isLogin()){
            $this->redirect('login');
        }
        
    }
    
    public function stockInventoryReport() {
         if(!$this->isLogin()){
            $this->redirect('login');
        }
        
    }
    
    public function materialRequisitionReport() {
         if(!$this->isLogin()){
            $this->redirect('login');
        }
        
    }
    
    public function materialBrandwiseRequisitionReport() {
         if(!$this->isLogin()){
            $this->redirect('login');
        }
        
    }
   /* 
    private function paginatedItem($restaurantId, $page = 1) {
        $recipeItemTable = $this->getTableObj();
        $count = $recipeItemTable->connect()->find()->count(); 
        Log::debug('Number of menu available in list is :- '.$count);
        if(!$count){
            return Null;
        }
        $conditions = array('RestaurantId =' => $restaurantId);
        $limit = PAGE_LIMIT;
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
        $allRecipItems = $this->paginate($recipeItemTable->connect()->find('all',array('fields' => $fields,'condition' => $conditions))
                    ->join($joins),['limit' => $limit, 'page' => $page]);
        $allItems = null;
        $itemCounter = 0;
        
        foreach ($allRecipItems as $recipeItems){
                $allItems[$itemCounter++] = new UploadDTO\RecipeItemMaterInsertDto(
                        $recipeItems->ItemName, 
                        $recipeItems->UnitId, 
                        $recipeItems->SLevel, 
                        $recipeItems->RLevel, 
                        $recipeItems->Qty, 
                        $recipeItems->ItemId, 
                        $recipeItems->Unit);
            }
            return $allItems;     
    }
    * 
    */
    
}
