<?php
namespace App\Controller;

use App\Model\Table;
use Cake\Log\Log;
use App\DTO\UploadDTO;
use App\DTO\DownloadDTO;
use App\DTO;
/**
 * Description of RTablesController
 *
 * @author niteen
 */
define('RT_INS_QRY', "INSERT INTO r_tables (TableId,TableNo,TableCategoryId,Capacity,IsOccupied"
        . ") VALUES (@TableId,@TableNo,@TableCategoryId,@Capacity,@IsOccupied);");
class RTablesController extends ApiController {
    
    
    private function getTableObj() {
        return new Table\RTablesTable();
    }
    public function getRtables($restaurantId) {
        $result = $this->getTableObj()->getRtable($restaurantId);
        if($result){
            return $result;
        }
        return false;
    }
    public function occupyTable($tableOccupyRequest, $restaurantId) {
        if($this->getTableObj()->tableOccupancyCheck(
                $tableOccupyRequest->tableId, 
                $tableOccupyRequest->isOccupied)){
                return false;
        }
        $occupyResult = $this->getTableObj()->occupy(
                $tableOccupyRequest->tableId, 
                $tableOccupyRequest->isOccupied);
        if($occupyResult){
            $this->makeSyncEntry(json_encode($tableOccupyRequest),UPDATE_OPERATION, $restaurantId);
        }
        return $occupyResult;
    }
    
    public function getBillTableNo($tableId) {
        return $this->getTableObj()->getTableNo($tableId);
    }
    
     public function prepareInsertStatements($restaurantId) {
        $allRtables = $this->getRtables($restaurantId);
        if (!$allRtables) {
            return false;
        }
        $preparedStatements = '';

        foreach ($allRtables as $rTables) {
            $preparedStatements .= RT_INS_QRY;
            $preparedStatements = str_replace('@TableId', $rTables->tableId, 
                    $preparedStatements);
            $preparedStatements = str_replace('@TableNo', $rTables->tableNo, 
                    $preparedStatements);
            $preparedStatements = str_replace('@TableCategoryId', 
                    $rTables->tableCategoryId, $preparedStatements);
            $preparedStatements = str_replace('@Capacity', $rTables->capacity, 
                    $preparedStatements);
            $preparedStatements = str_replace('@IsOccupied', $rTables->isOccupied, 
                    $preparedStatements);
        }
        return $preparedStatements;
    }
    
    private function makeSyncEntry($json ,$operation, $restaurantId) {
        $syncController = new SyncController();
        $syncController->rtableEntry($json, $operation, $restaurantId);
    }
    
    
    public function addNewTables() {
         if(!$this->isLogin()){
            $this->redirect('login');
        }
        $tableCategoryController = new TableCategoryController();
        $tCategory = $tableCategoryController->getStdTableCategory();
        $this->set([
            'category' => $tCategory
        ]);
        $restaurantId = parent::readCookie('cri');
        $data = $this->request->data();
          if ($this->request->is('post') and isset($data['add_bulk'])) {
            
            $file = $data['file-upload']['tmp_name'];
            $extenstion = $this->getExtension($data['file-upload']['name']);
            if (empty($file)) {
                $this->set([MESSAGE => SELECT_FILE_MESSAGE, 'color' => 'red']);
            } elseif ($extenstion != CSV_EXT) {
                $this->set([MESSAGE => INCORRECT_FILE_MESSAGE, 'color' => 'red']);
            } else {
                if (($handle = fopen($file, "r")) !== FALSE) {
                    $counter = 0;
                    $allTables = null;
                    fgetcsv($handle);
                    while (($filesop = fgetcsv($handle, 1000, ",")) !== false) {
                        $allTables[$counter] = new UploadDTO\RTablesInsertDto(
                                $filesop[0], 
                                $filesop[1], 
                                $filesop[2], 
                                INACTIVE, 
                                12345);
                        $counter++;
                    }
                    fclose($handle);
                    $result = $this->getTableObj()->insert($allTables);
                }
                if ($result) {
                    $this->set([MESSAGE => 'You database has imported successfully. '
                        . 'You have inserted ' . $result . ' recoreds', 'color' => 'green']);
                } else {
                    $this->set([MESSAGE => DB_FILE_ERROR, 'color' => 'red']);
                }
            }
        }elseif ($this->request->is('post') and isset($data['add_single'])) {
              $allTables[0] = new UploadDTO\RTablesInsertDto(
                                $data['tno'], 
                                $data['category'], 
                                $data['cpty'], 
                                $data['topd'], 
                                $restaurantId);
              $result = $this->getTableObj()->insert($allTables);
             if ($result) {
                    $this->redirect('rtables');
                } else {
                    $this->set([MESSAGE => DB_FILE_ERROR, 'color' => 'red']);
                }
        }
    }
    
    public function tableList() {
        if(!$this->isLogin()){
            $this->redirect('login');
        }
        $parameter = $this->request->param('page');
        $page = 1;
        if($parameter){
            $page = $parameter;
        }
        $tableCategoryController = new TableCategoryController();
        $tCategory = $tableCategoryController->getStdTableCategory();
        $tables = $this->tablePaginator($page);
        $this->set([
            'tables' => $tables,
            'category' => $tCategory
        ]);
    }
    
    private function tablePaginator($page = 1) {
        $limit = PAGE_LIMIT;
        $restaurantId = parent::readCookie('cri');
        $conditions = array('RestaurantId =' => $restaurantId);
         $rTable = new Table\RTablesTable();
        $rResult = $rTable->connect()->find()->where($conditions); 
        $count = $rResult->count();
        Log::debug('Number of Tables available in list is :- '.$count);
        if(!$count){
            return Null;
        }
        
        $paginatedRecord = $rResult;//$this->paginate(,['limit' => $limit,'page' => $page]);
        
        $allRTables = null;
        $i = 0;
        foreach ($paginatedRecord as $record){
            
            $rTablesDto = new DownloadDTO\RTableDownloadDto($record->TableId, 
                    $record->TableNo, 
                    $record->TableCategoryId, 
                    $record->Capacity, 
                    $record->IsOccupied);
            
            $allRTables[$i] = $rTablesDto;
            $i++;
        }
        return $allRTables;
        
    }
    
    public function editTable() {
        if(!$this->isLogin()){
            $this->redirect('login');
        }
        $restaurantId = parent::readCookie('cri');
        $data = $this->request->data;
        if($this->request->is('post') and isset($data['edit'])){
            $tableInfo = new \stdClass();
            foreach ($data as $k => $v){
                $tableInfo->$k = $v;
            }
           $tableCategoryController = new TableCategoryController();
           $category = json_decode(json_encode($tableCategoryController->getStdTableCategory()));
           $this->set([
            'tableInfo' => $tableInfo,
            'category' => $category
        ]);
        }elseif ($this->request->is('post') and isset($data['save'])) {
            Log::debug('table status:'.$data['iopd']);
          $updateRequest = new UploadDTO\RTablesInsertDto(
                  $data['tno'], 
                  $data['category'], 
                  $data['cpty'], 
                  $data['iopd'], 
                  $restaurantId, 
                  $data['tid']);
          $updateResult = $this->getTableObj()->update($updateRequest);
           if ($updateResult) {
                $tableUpdate = $this->getTableObj()->getUpdatedTable($updateRequest->tableId);
                $this->makeSyncEntry(
                        json_encode($tableUpdate), 
                        UPDATE_OPERATION, 
                        $restaurantId);
                $this->redirect('rtables');
            } else {
                $this->set([MESSAGE => DTO\ErrorDto::prepareMessage(137),COLOR => ERROR_COLOR]);
            }
        }
    }
    
    public function tableView() {
        $data = explode('/', $this->request->url);
        $this->set([
            'option' => $data[1]
        ]);
    }
    
    public function tableNoValidation() {
        $this->autoRender = FALSE;
        $data = $this->request->data;
        $restaurantId = parent::readCookie('cri');
        $response = $this->getTableObj()->tableNoValidator($data['tableNo'], $restaurantId);
        $this->response->body($response);
    }
    
    public function isOccupied($tableId) {
        return $this->getTableObj()->tableOccupancyCheck($tableId, 1);
    }
    
}
