<?php

namespace App\Controller;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Mysql2SqliteController
 *
 * @author niteen
 */
use App\Model\Table;





class SqliteController extends ApiController {

  

    public function getDB($userId) {
        $this->autoRender = false;
        $tableObject = new Table\SqliteTable();
        if ($tableObject->Create()) {

       
            
            
            
        $this->response->type('class');
        $this->response->file(SQLITE_DB_DIR.'RestaueantDb.sqlite',['download' => true]);
        $this->response->send();
      
        unlink(SQLITE_DB_DIR.'RestaueantDb.sqlite');
        Log::debug('TravelDb.'.$userId.'.sqlite  File deleted successfully');
        }
    }

}
