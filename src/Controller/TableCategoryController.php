<?php
namespace App\Controller;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
use App\Model\Table;
use Cake\Log\Log;

/**
 * Description of TableCategoryController
 *
 * @author niteen
 */
define('TC_INS_QRY', "INSERT INTO table_category (TableCategoryId,CategoryTitle,Image,CreatedDate,"
        . "UpdatedDate) VALUES (@TableCategoryId,\"@CategoryTitle\",\"@Image\",\"@CreatedDate\",\"@UpdatedDate\");");
class TableCategoryController extends ApiController{
    
    private function getTableObj() {
        
        return new Table\TableCategoryTable();
    }
    
    public function getTableCategories($restaurantId) {
        $result = $this->getTableObj()->getTableCategory($restaurantId);
        if($result){
            return $result;
        }
        return false;
    }
    
    public function prepareInsertStatements($restaurantId) {
        $allTableCategories = $this->getTableCategories($restaurantId);
        if (!$allTableCategories) {
            return false;
        }
        $preparedStatements = '';

        foreach ($allTableCategories as $category) {
            $preparedStatements .= TC_INS_QRY;
            $preparedStatements = str_replace('@TableCategoryId', $category->tableCategoryId, $preparedStatements);
            $preparedStatements = str_replace('@CategoryTitle', $category->categoryTitle, $preparedStatements);
            $preparedStatements = str_replace('@Image', $category->image, $preparedStatements);
            $preparedStatements = str_replace('@CreatedDate', $category->createdDate, $preparedStatements);
            $preparedStatements = str_replace('@UpdatedDate', $category->updatedDate, $preparedStatements);
        }
        return $preparedStatements;
        
        
    }
    
    
    
}
