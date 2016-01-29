<?php
namespace App\Controller;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
use App\Model\Table;
use Cake\Log\Log;
use App\DTO;
use App\DTO\UploadDTO;
/**
 * Description of UploadController
 *
 * @author niteen
 */
class UploadController extends ApiController{
    
    public function index() {
        $this->autoRender = false;
        
        $jsonData = $this->request->input();
        
        if(empty($jsonData)){
            $this->response->body(DTO\ErrorDto::prepareError(104));
            Log::error('Uploaded data is empty ');
            return ;
        }
        $result = UploadDTO\MainUploadDto::Deserialize($jsonData);
        $userData = UploadDTO\UserUploadDto::Deserialize($result->user);
        $userController = new UserController();
        if (!$userController->isUserValid($userData->userId, $userData->restaurantId)) {
            $this->response->body(DTO\ErrorDto::prepareError(102));
            \Cake\Log\Log::error("request with incorrect  userId :- ".$userData->userId);
            return;
        } 
      
        foreach ($result->data as $index => $record){
            echo 'index :- '.$index;
            echo 'tableName :- '.$record->tableName;
            //echo 'tableData :- '.  print_r($record->tableData);
            
        }
        
        
        
        
        
        
    }
    
}
