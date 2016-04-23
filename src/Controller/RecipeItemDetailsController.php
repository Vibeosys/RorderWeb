<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace App\Controller;
use App\Model\Table;
use App\DTO\UploadDTO;
use Cake\Log\Log;
/**
 * Description of RecipeItemDetailsController
 *
 * @author niteen
 */
class RecipeItemDetailsController extends ApiController{
  
    public function getTableObj() {
        return new Table\RecipeItemDetailsTable();
    }
    
    public function getBrandWiserequisitionReport() {
        $this->autoRender = FALSE;
        if($this->request->is('ajax') and $this->isLogin()){
            $restaurantId = parent::readCookie('cri');
            $response = $this->getTableObj()->getItems($restaurantId);
            if($response){
                $this->response->body(json_encode($response));
            }else{
                $this->response->body(0);
            }
        }  else {
            $this->response->body(0);
        }
    }
    
}
