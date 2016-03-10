<?php
namespace App\Controller;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
use App\Model\Table;
use Cake\Log\Log;
use Cake\Filesystem\Folder;
use App\DTO\DownloadDTO;

/**
 * Description of TableCategoryController
 *
 * @author niteen
 */
define('TC_INS_QRY', "INSERT INTO table_category (TableCategoryId,CategoryTitle,Image"
        . ") VALUES (@TableCategoryId,\"@CategoryTitle\",\"@Image\");");
class TableCategoryController extends ApiController{
    
   
    private $restaurantId = 123456;
    private function getTableObj() {
        
        return new Table\TableCategoryTable();
    }
    
    public function getTableCategories() {
        $result = $this->getTableObj()->getTableCategory();
        if($result){
            return $result;
        }
        return false;
    }
    
    public function prepareInsertStatements() {
        $allTableCategories = $this->getTableCategories();
        if (!$allTableCategories) {
            return false;
        }
        $preparedStatements = '';

        foreach ($allTableCategories as $category) {
            $preparedStatements .= TC_INS_QRY;
            $preparedStatements = str_replace('@TableCategoryId', $category->tableCategoryId, $preparedStatements);
            $preparedStatements = str_replace('@CategoryTitle', $category->categoryTitle, $preparedStatements);
            $preparedStatements = str_replace('@Image', $category->image, $preparedStatements);
        }
        return $preparedStatements;
    }
    
    public function addNewTableCategory() {
         if(!$this->isLogin()){
            $this->redirect('login');
        }
        if($this->request->is('post') and isset($this->request->data['save'])){
            $data = $this->request->data;
            $fileName = $data['file-upload']['name'];
            if(!$this->isImage($fileName)){
                $this->set([MESSAGE => INCORRECT_FILE_MESSAGE.'"png, jpg, jpeg"',COLOR => ERROR_COLOR]);
                return;
            }
            $uploadedFile = $data['file-upload']['tmp_name'];
            $imgDir = new Folder(IMAGE_UPLOAD, true);
            $destination = $imgDir->path.$this->getGUID().$fileName;
            $uploadResult = move_uploaded_file($uploadedFile, $destination);
            if($uploadResult){
                $tableCategoryDto = new DownloadDTO\TableCategoryDownloadDto(
                        null, 
                        $data['categoryTitle'], 
                        $destination);
                $insertResult = $this->getTableObj()->insert($tableCategoryDto);
                $newTableCategory = $this->getTableObj()->getSingleCategory($insertResult);
                $syncController = new SyncController();
                $syncController->tableCategoryEntry(json_encode($newTableCategory), INSERT_OPERATION, $this->restaurantId);
                 if ($insertResult) {
                        $this->set(['message' => 'Table Category added successfully','color' => 'green']);
                    } else {
                        $this->set(['message' => 'ERROR occured...','color' => 'red']);
                    }
            }
        }
    }
    
    
    
}
