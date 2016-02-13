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

    private $RestaurantId;

    public function getDB($restaurantId) {

        $this->RestaurantId = $restaurantId;
        $tableObject = new Table\SqliteTable();
        if ($tableObject->create()) {

            $this->addUsers($tableObject);
            $this->addRTables($tableObject);
            $this->addCustomers($tableObject);
            $this->addTableTransactions($tableObject);
            $this->addMenuCategories($tableObject);
            $this->addTableCategories($tableObject);
            $this->addMenuTags($tableObject);
            $this->addMenuItems($tableObject);
            $this->addPaymentMode($tableObject);
            $this->addFeedback($tableObject);

            $this->response->type('class');
            $this->response->file(SQLITE_DB_DIR . 'RorderDb.sqlite', ['download' => true]);
            $this->response->send();
            unlink(SQLITE_DB_DIR . 'RorderDb.sqlite');
            Log::debug('RorderDb.sqlite  File deleted successfully');
        }
    }

    private function addUsers($tableObject) {
        //user table entry in sqlite file
        $userController = new UserController();
        $userPreparedStatement = $userController->prepareInsertStatement($this->RestaurantId);
        //Log::info($userPreparedStatement);
        if ($tableObject->excutePreparedStatement($userPreparedStatement)) {
            Log::debug('Record is inserted into User SQLite table for restaurantId ' . $this->RestaurantId);
        } else {
            Log::error('Record is not inserted into User SQLite table');
        }
    }

    private function addRTables($tableObject) {
        //Rtables Data entry in sqlite database file
        $rTablesController = new RTablesController();
        $rTablesPreparedStatement = $rTablesController->prepareInsertStatements($this->RestaurantId);
        //Log::info($userPreparedStatement);
        if ($tableObject->excutePreparedStatement($rTablesPreparedStatement)) {
            Log::debug('Record is inserted into Rtable SQLite table for restaurantId ' . $this->RestaurantId);
        } else {
            Log::error('Record is not inserted into Rtable SQLite table');
        }
    }

    private function addMenuCategories($tableObject) {
        //menu category table enrty in sqlite database
        $menuCategoryController = new MenuCategoryController();
        $menuCategoryPreparedStatement = $menuCategoryController->prepareInsertStatements();
        //Log::info($userPreparedStatement);
        if ($tableObject->excutePreparedStatement($menuCategoryPreparedStatement)) {
            Log::debug('Record is inserted into Menu category SQLite table for restaurantId ' . $this->RestaurantId);
        } else {
            Log::error('Record is not inserted into Menu category SQLite table');
        }
    }

    private function addTableCategories($tableObject) {
        //table category table enrty in sqlite database
        $tableCategoryController = new TableCategoryController();
        $tableCategoryPreparedStatement = $tableCategoryController->prepareInsertStatements();
        //Log::info($userPreparedStatement);
        if ($tableObject->excutePreparedStatement($tableCategoryPreparedStatement)) {
            Log::debug('Record is inserted into Table category SQLite table for restaurantId ' . $this->RestaurantId);
        } else {
            Log::error('Record is not inserted into Table category SQLite table');
        }
    }

    private function addMenuTags($tableObject) {
        //menuTags table enrty in sqlite database
        $menuTagController = new MenuTagController();
        $menuTagPreparedStatement = $menuTagController->prepareInsertStatements();
        //Log::info($userPreparedStatement);
        if ($tableObject->excutePreparedStatement($menuTagPreparedStatement)) {
            Log::debug('Record is inserted into Menu Tags SQLite table for restaurantId ' . $this->RestaurantId);
        } else {
            Log::error('Record is not inserted into Menu Tags SQLite table');
        }
    }

    private function addMenuItems($tableObject) {
        //Menu table enrty in sqlite database
        $menuController = new MenuController();
        $menuPreparedStatement = $menuController->prepareInsertStatements($this->RestaurantId);
        //Log::info($userPreparedStatement);
        if ($tableObject->excutePreparedStatement($menuPreparedStatement)) {
            Log::debug('Record is inserted into Menu SQLite table for restaurantId ' . $this->RestaurantId);
        } else {
            Log::error('Record is not inserted into Menu SQLite table');
        }
    }

    private function addCustomers($tableObject) {
        $customerController = new CustomerController();
        $customerPreparedStatement = $customerController->prepareInsertStatements($this->RestaurantId);
        //Log::info($userPreparedStatement);
        if ($tableObject->excutePreparedStatement($customerPreparedStatement)) {
            Log::debug('Record is inserted into Customer SQLite table for restaurantId ' . $this->RestaurantId);
        } else {
            Log::error('Record is not inserted into Customer SQLite table');
        }
    }

    private function addTableTransactions($tableObject) {
        $tableController = new TableTransactionController();
        $tableTransactionPreparedStatement = $tableController->prepareInsertStatements($this->RestaurantId);
        //Log::info($userPreparedStatement);
        if ($tableObject->excutePreparedStatement($tableTransactionPreparedStatement)) {
            Log::debug('Record is inserted into Table_Transaction SQLite table for restaurantId ' . $this->RestaurantId);
        } else {
            Log::error('Record is not inserted into Table_Transactions SQLite table');
        }
    }
    
    private function addPaymentMode($tableObject) {
        $paymentModeController = new PaymentModeMasterController();
        $paymentModePreparedStatement = $paymentModeController->prepareInsertStatements($this->RestaurantId);
        if ($tableObject->excutePreparedStatement($paymentModePreparedStatement)) {
            Log::debug('Record is inserted into payment_mode_master SQLite table for restaurantId ' . $this->RestaurantId);
        } else {
            Log::error('Record is not inserted into payment_mode_master SQLite table');
        }
    }
    
     private function addFeedback($tableObject) {
        $feedbackController = new FeedbackController();
        $feedbackPreparedStatement = $feedbackController->prepareInsertStatements($this->RestaurantId);
        if ($tableObject->excutePreparedStatement($feedbackPreparedStatement)) {
            Log::debug('Record is inserted into feedback_master SQLite table for restaurantId ' . $this->RestaurantId);
        } else {
            Log::error('Record is not inserted into feedback_master SQLite table');
        }
    }
    
    

}
