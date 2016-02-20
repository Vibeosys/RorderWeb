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
    
    public function getMenuCategory($restaurantId) {
        $conditions = ['RestaurantId =' => $restaurantId];
        $menuCategories = $this->connect()->find()->where($conditions);
        $count = $menuCategories->count();
        if(!$count){
            return false;
        }
        $allMenuCategories[] = null;
        $i = 0;
        foreach ($menuCategories as $menuCategory){
            
            $menuCategoryDto = new DownloadDTO\MenuCategoryDownloadDto($menuCategory->CategoryId,
                    $menuCategory->CategoryTitle, $menuCategory->CategoryImage, $menuCategory->Active, 
                    $menuCategory->CreatedDate, $menuCategory->UpdatedDate, $menuCategory->Colour, 
                    $menuCategory->ImgUrl);
            
            $allMenuCategories[$i] = $menuCategoryDto;
            $i++;
        }
        return $allMenuCategories;
        
    }
    
}
