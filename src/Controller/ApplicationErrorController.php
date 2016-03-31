<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controller;
use App\Model\Table;
/**
 * Description of ApplicationErrorController
 *
 * @author niteen
 */
class ApplicationErrorController extends ApiController{
    
    public function getTableObj() {
        return new Table\ApplicationErrorTable();
    }
    
    public function AddError($errorRequest, $userInfo) {
        return $this->getTableObj()->insert($errorRequest, $userInfo);
    }
}
