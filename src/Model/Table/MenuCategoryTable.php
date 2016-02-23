<?php
namespace App\Model\Table;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
use App\DTO\DownloadDTO;
use Cake\Log\Log;
use Cake\ORM\Table;
use Cake\ORM\TableRegistry;

/**
 * Description of MenuCategoryTable
 *
 * @author niteen
 */
class MenuCategoryTable extends Table{

    private function connect() {
        return TableRegistry::get('menu_category');
    }
    
    public function getMenuCategory() {
      
        $menuCategories = $this->connect()->find();
        $count = $menuCategories->count();
        if(!$count){
            return false;
        }
        $allMenuCategories[] = null;
        $i = 0;
        foreach ($menuCategories as $menuCategory){
            
            $menuCategoryDto = new DownloadDTO\MenuCategoryDownloadDto(
                    $menuCategory->CategoryId,
                    $menuCategory->CategoryTitle, 
                    $menuCategory->CategoryImage, 
                    $menuCategory->Active, 
                    $menuCategory->Colour);
            
            $allMenuCategories[$i] = $menuCategoryDto;
            $i++;
        }
        return $allMenuCategories;
        
    }
    
    public function insert($allMenuCategory) {
        $insertResult = false;
        if(is_null($allMenuCategory)){
            return $insertResult;
        }
        $insertCounter = 0;
        foreach ($allMenuCategory as $category){
            $tableObj = $this->connect();
            $newCategory = $tableObj->newEntity();
            $newCategory->CategoryTitle = $category->categoryTitle;
            $newCategory->CategoryImage = $category->categoryImage;
            $newCategory->Active = $category->active;
            $newCategory->CreatedDate = date(VB_DATE_TIME_FORMAT);
            $newCategory->UpdatedDate = date(VB_DATE_TIME_FORMAT);
            $newCategory->Colour = $category->colour;
            if($tableObj->save($newCategory)){
                $insertCounter++;
            }
        }
        return $insertCounter;
    }
    
}
