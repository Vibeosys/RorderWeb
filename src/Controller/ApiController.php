<?php
namespace App\Controller;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
use App\Model\Table;
use App\DTO;
use Cake\Datasource\ConnectionManager;
/**
 * Description of ApiController
 *
 * @author niteen
 */
class ApiController extends AppController{
    
    public function initialize() {
        parent::initialize();
        $this->response->type('json');
       
    }
    public function error() {
        $this->autoRender = false;
        $url = $this->request->url;
        \Cake\Log\Log::error('User hit with unknown api Endpoint : '.$url);
        $this->response->body(DTO\ErrorDto::prepareError(404));
    }
    public function transBegin() {
        $conn = ConnectionManager::get('default');
        $conn->begin();
    }
    
    public function transRollback() {
        $conn = ConnectionManager::get('default');
        $conn->rollback();
    }
    
    public function transCommit() {
        $conn = ConnectionManager::get('default');
        $conn->commit();
    }
    
  
}
