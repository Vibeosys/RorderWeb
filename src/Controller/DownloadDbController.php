<?php

namespace App\Controller;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
use App\DTO;
/**
 * Description of DownloadDbController
 *
 * @author niteen
 */
class DownloadDbController extends ApiController {

    public function index() {
        $this->autoRender = false;
        
        $restaurantId = $this->request->query('restaurantId');
        $restaurantController = new RestaurantController();
        \Cake\Log\Log::info('Request is in Download Controller');
        if($restaurantController->isValidate($restaurantId)){
            
        $sqliteController = new SqliteController();
        $sqliteController->getDB($restaurantId);
        }else{
            $this->response->body(DTO\ErrorDto::prepareError(100));
        }
    }
    
    

}
