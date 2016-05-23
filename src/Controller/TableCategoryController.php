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
define('CATE_IMG_PATH',TMP.'menu_category_img'.DS);
class TableCategoryController extends ApiController{
    
   
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
        $data = $this->request->data;
        $restaurantId = parent::readCookie('cri');
        if($this->request->is('post') and isset($this->request->data['bulk'])){
            
            
            
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
                $syncController->tableCategoryEntry(json_encode($newTableCategory), INSERT_OPERATION, $restaurantId);
                 if ($insertResult) {
                        $this->set(['message' => 'Table Category added successfully','color' => 'green','bulk' => 1]);
                    } else {
                        $this->set(['message' => 'ERROR occured...','color' => 'red','bulk' => 1]);
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
            } else if(move_uploaded_file($file, $destination)) {
               $tableCategoryDto = new DownloadDTO\TableCategoryDownloadDto(
                        null, 
                        $data['title'], 
                        $destination);
                $result = $this->getTableObj()->insert($tableCategoryDto);
                $newTableCategory = $this->getTableObj()->getSingleCategory($result);
                $syncController = new SyncController();
                $syncController->tableCategoryEntry(json_encode($newTableCategory), INSERT_OPERATION, $restaurantId);
                if($result) {
                    $this->redirect('tablecategory');
                } else {
                    $this->set([MESSAGE => 'Error ! please try again.', 'color' => 'red','single' => 1]);
                }
            }else{
                $this->set([MESSAGE => 'Error in image upload ! please try again.', 'color' => 'red','single' => 1]);
            }
        }
    }
    
    public function getStdTableCategory() {
        $tableCategories = $this->getTableCategories();
        if($tableCategories){
            $tcategory = new \stdClass();
            foreach ($tableCategories as $category){
                $k = $category->tableCategoryId;
                $tcategory->$k = $category->categoryTitle;
            }
            return $tcategory;
        }
        return null;
    }
    
    public function tableCategoryList() {
        $tableCategories = $this->getTableCategories();
        if(!is_null($tableCategories)){
            $this->set([
                'rows' => $tableCategories
            ]);
        }
    }
    
    
    
}
