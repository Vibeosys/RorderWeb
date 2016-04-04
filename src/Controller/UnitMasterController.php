<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controller;
use App\Model\Table;
/**
 * Description of UnitMasterController
 *
 * @author niteen
 */
class UnitMasterController extends ApiController{
    
    public function getTableObj() {
        return new Table\UnitMasterTable();
    }
    
    public function getUnits() {
        $this->autoRender = FALSE;
        if($this->request->is('get') and $this->isLogin()){
            $response = $this->getTableObj()->getUnits();
            $this->response->body(json_encode($response));
        }  else {
            $this->response->body(FALSE);
        }
    }
}
