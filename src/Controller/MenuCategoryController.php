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
 * Description of MenuCategoryController
 *
 * @author niteen
 */
define('MC_INS_QRY', 
        "INSERT INTO menu_category (CategoryId,CategoryTitle,CategoryImage,Active,CreatedDate,UpdatedDate,Colour,ImgUrl)"
        . " VALUES (@CategoryId,\"@CategoryTitle\",\"@CategoryImage\",@Active,\"@CreatedDate\",\"@UpdatedDate\",\"@Colour\",\"@ImgUrl\");");
class MenuCategoryController extends ApiController{
    
    private function getTableObj() {
        
        return new Table\MenuCategoryTable();
    }
    
    public function getMenuCategories($restaurantId) {
        $result = $this->getTableObj()->getMenuCategory($restaurantId);
        if($result){
            return $result;
        }
        return false;
    }
    
    public function prepareInsertStatements($restaurantId) {
        $allMenuCategories = $this->getMenuCategories($restaurantId);
        if (!$allMenuCategories) {
            return false;
        }
        $preparedStatements = '';

        foreach ($allMenuCategories as $menuCategory) {
            $preparedStatements .= MC_INS_QRY;
            $preparedStatements = str_replace('@CategoryId', $menuCategory->categoryId, $preparedStatements);
            $preparedStatements = str_replace('@CategoryTitle', $menuCategory->categoryTitle, $preparedStatements);
            $preparedStatements = str_replace('@CategoryImage', $menuCategory->categoryImage, $preparedStatements);
            $preparedStatements = str_replace('@Active', $menuCategory->active, $preparedStatements);
            $preparedStatements = str_replace('@CreatedDate', $menuCategory->createdDate, $preparedStatements);
            $preparedStatements = str_replace('@UpdatedDate', $menuCategory->updatedDate, $preparedStatements);
            $preparedStatements = str_replace('@Colour', $menuCategory->colour, $preparedStatements);
            $preparedStatements = str_replace('@ImgUrl', $menuCategory->imgUrl, $preparedStatements);
            
        }
        return $preparedStatements;
    }
        
    
        
    
    
    
    
}
