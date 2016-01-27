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
 * Description of Mysql2SqliteController
 *
 * @author niteen
 */






class SqliteController extends ApiController {

  

    public function getDB($restaurantId) {
        
        $tableObject = new Table\SqliteTable();
        if ($tableObject->create()) {
        
            
            //user table entry in sqlite file
            $userController = new UserController();
            $userPreparedStatement = $userController->prepareInsertStatement($restaurantId);
            //Log::info($userPreparedStatement);
            if($tableObject->excutePreparedStatement($userPreparedStatement)){
                Log::debug('Record is inserted into User SQLite table for restaurantId ' . $restaurantId);
            } else {
                Log::error('Record is not inserted into User SQLite table');
            }
            
            //Rtables Data entry in sqlite database file
             $rTablesController = new RTablesController();
            $rTablesPreparedStatement = $rTablesController->prepareInsertStatements();
            //Log::info($userPreparedStatement);
            if($tableObject->excutePreparedStatement($rTablesPreparedStatement)){
                Log::debug('Record is inserted into User SQLite table for restaurantId ' . $restaurantId);
            } else {
                Log::error('Record is not inserted into User SQLite table');
            }
            
            
            //menu category table enrty in sqlite database
            
              $menuCategoryController = new MenuCategoryController();
            $menuCategoryPreparedStatement = $menuCategoryController->prepareInsertStatements();
            //Log::info($userPreparedStatement);
            if($tableObject->excutePreparedStatement($menuCategoryPreparedStatement)){
                Log::debug('Record is inserted into User SQLite table for restaurantId ' . $restaurantId);
            } else {
                Log::error('Record is not inserted into User SQLite table');
            }
       
            
            
            
        $this->response->type('class');
        $this->response->file(SQLITE_DB_DIR.'RorderDb.sqlite',['download' => true]);
        // $this->response->file('Controller'.DS.'RorderDb.sqlite',['download' => true]);
        
        $this->response->send();
      
        unlink(SQLITE_DB_DIR.'RorderDb.sqlite');
        Log::debug('RorderDb.sqlite  File deleted successfully');
        }
    }

}
