<?php

namespace App\Controller;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use App\Model\Table;
use Cake\Log\Log;
use App\DTO\DownloadDTO;
use Cake\Filesystem\Folder;

/**
 * Description of MenuCategoryController
 *
 * @author niteen
 */
define('MC_INS_QRY', "INSERT INTO menu_category (CategoryId,CategoryTitle,CategoryImage,Active,Colour)"
        . " VALUES (@CategoryId,\"@CategoryTitle\",\"@CategoryImage\",@Active,\"@Colour\");");
define('CATE_IMG_PATH',TMP.'menu_category_img'.DS);
class MenuCategoryController extends ApiController {
    
    
    
    private function getTableObj() {

        return new Table\MenuCategoryTable();
    }

    public function getMenuCategories() {
        $result = $this->getTableObj()->getMenuCategory();
        if ($result) {
            return $result;
        }
        return false;
    }

    public function prepareInsertStatements() {
        $allMenuCategories = $this->getMenuCategories();
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
            $preparedStatements = str_replace('@Colour', $menuCategory->colour, $preparedStatements);
        }
        return $preparedStatements;
    }

    public function addNewMenuCategory() {
         if(!$this->isLogin()){
            $this->redirect('login');
        }
         $data = $this->request->data();
         $counter = 0;
        if ($this->request->is('post') and isset($this->request->data['bulk'])) {
           
            $file = $data['file-upload']['tmp_name'];
            $extenstion = $this->getExtension($data['file-upload']['name']);
            if (empty($file)) {
                $this->set([MESSAGE => SELECT_FILE_MESSAGE, 'color' => 'red', 'bulk' => 1]);
            } elseif ($extenstion != CSV_EXT) {
                Log::debug('File extention :-'.$file);
                $this->set([MESSAGE => INCORRECT_FILE_MESSAGE, 'color' => 'red','bulk' => 1]);
            } else {
                if (($handle = fopen($file, "r")) !== FALSE) {
                    
                    $allMenuCategory = null;
                    fgetcsv($handle);
                    while (($filesop = fgetcsv($handle, 1000, ",")) !== false) {
                        $allMenuCategory[$counter] = new DownloadDTO\MenuCategoryDownloadDto(
                                null, 
                                $filesop[0], 
                                $filesop[1], 
                                ACTIVE, 
                                $filesop[2]);
                        $counter++;
                    }
                    fclose($handle);
                    $result = $this->getTableObj()->insert($allMenuCategory);
                }
                if ($result) {
                    $this->set([MESSAGE => 'You database has imported successfully. You have inserted ' . $result . ' recoreds', 'color' => 'green','bulk' => 1]);
                } else {
                    $this->set([MESSAGE => DB_FILE_ERROR, 'color' => 'red','bulk' => 1]);
                }
            }
        }elseif ($this->request->is('post') and isset($this->request->data['single'])) {
            $file = $data['image']['tmp_name'];
            $fileName = $data['image']['name'];
            $dir = new Folder(CATE_IMG_PATH, TRUE);
            $destination = $dir->path.$fileName;
            $extenstion = $this->getExtension($fileName);
            if (empty($file)) {
                $this->set([MESSAGE => SELECT_FILE_MESSAGE, 'color' => 'red', 'single' => 1]);
            } elseif (!in_array($extenstion, $this->img_valid_ext)) {
                Log::debug('File extention :-'.$file);
                $this->set([MESSAGE => INCORRECT_FILE_MESSAGE, 'color' => 'red','single' => 1]);
            } elseif(move_uploaded_file($file, $destination)) {
                $allMenuCategory[$counter] = new DownloadDTO\MenuCategoryDownloadDto(
                                null, 
                                $data['title'], 
                                $destination, 
                                ACTIVE, 
                                null);
                $result = $this->getTableObj()->insert($allMenuCategory);
                 if ($result) {
                    $this->redirect('menucategory');
                } else {
                    $this->set([MESSAGE => 'Error in image upload ! please try again.', 'color' => 'red','single' => 1]);
                }
            }else{
                $this->set([MESSAGE => 'Error in image upload ! please try again.', 'color' => 'red','single' => 1]);
            }
        }
        Log::debug('Cancel button pressed from menu category');
    }
    
    public function getStdMenuCategory() {
        $allMenuCategory = $this->getMenuCategories();
        if($allMenuCategory){
             $mCategory = new \stdClass();
            foreach ($allMenuCategory as $category){
                $key = $category->categoryId;
                $mCategory->$key = $category->categoryTitle;
            }
            return $mCategory;  
        }
        return FALSE;
    }
    public function menuCategoryList() {
        if(!$this->isLogin()){
            $this->redirect('login');
        }
        $menuCategories = $this->getTableObj()->getMenuCategory();
        $this->set([
            'menu_cate' => $menuCategories
        ]);
    }
    
    

}
