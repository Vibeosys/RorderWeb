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
 * Description of TableCategoryTable
 *
 * @author niteen
 */
class TableCategoryTable  extends Table{ 
   
    private function connect() {
        return TableRegistry::get('table_category');
    }
    public function getTableCategory() {
       $tableCategories = $this->connect()->find();
       $count = $tableCategories->count();
        if(!$count){
            Log::debug('Table Categories are not found');
            return false;
        }
       $allTableCategory= null;
       $i = 0;
       foreach ($tableCategories as $category){
           $tableCategoryDto = new DownloadDTO\TableCategoryDownloadDto($category->TableCategoryId, 
                   $category->CategoryTitle, $category->Image);
           $allTableCategory[$i] = $tableCategoryDto;
           $i++;
       }
       Log::debug('Table Categories are successfully return');
     return $allTableCategory;
    }
    
    public function insert(DownloadDTO\TableCategoryDownloadDto $tableCategoryDto) {
        $result = false;
        if($tableCategoryDto){
            $tableObj = $this->connect();
            $newTableCategory  = $tableObj->newEntity();
            $newTableCategory->CategoryTitle = $tableCategoryDto->categoryTitle;
            $newTableCategory->Image = $tableCategoryDto->image;
            $newTableCategory->CreatedDate = date(VB_DATE_TIME_FORMAT);
            $newTableCategory->UpdatedDate = date(VB_DATE_TIME_FORMAT);
            if($tableObj->save($newTableCategory)){
                return $newTableCategory->TableCategoryId;
               
            }
            return $result;
        }
    }
    
    public function getSingleCategory($categoryId) {
        $condition = ['TableCategoryId' => $categoryId];
         $tableCategories = $this->connect()->find()->where($condition);
        if(!$tableCategories->count()){
            Log::debug('Table Categories are not found');
            return false;
        }
        foreach ($tableCategories as $category){
           $tableCategoryDto = new DownloadDTO\TableCategoryDownloadDto($category->TableCategoryId, 
                   $category->CategoryTitle, $category->Image);
           
       }
       return $tableCategoryDto;
    }
    
    
    
    
}
