<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controller;
use App\Model\Table;
use App\DTO\UploadDTO;
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
    
    public function recipeItemList() {
        $data = $this->request->data;
        if($this->request->is('post') and isset($data['os'])){
              $this->redirect('inventory');
        }elseif ($this->request->is('post') and isset($data['cs'])) {
              $this->redirect('inventory');
            
        }elseif ($this->request->is('post') and isset($data['su'])) {
              $this->redirect('inventory/stockupload');
        }
        
       $allRecipeitems = $this->getTableObj()->getRecipeItems();
       
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
}
