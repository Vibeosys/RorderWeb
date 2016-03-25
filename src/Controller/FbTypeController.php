<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controller;
use App\Model\Table;
/**
 * Description of FbTypeController
 *
 * @author niteen
 */

define('FBT_INS_QRY', 'INSERT INTO fb_types (FbTypeId,FbTypeName) VALUES (@FbTypeId,"@FbTypeName");');
class FbTypeController extends ApiController{
    
    private function getTableObj() {
        return new Table\FbTypeTable();
    }
    
    public function getAllFbType() {
        return $this->getTableObj()->getFbTypes();
    }
    
    public function prepareInsertStatements() {
        $allFbType = $this->getAllFbType();
        if (!$allFbType) {
            return false;
        }
        $preparedStatements = '';

        foreach ($allFbType as $type) {
            $preparedStatements .= FBT_INS_QRY;
            $preparedStatements = str_replace('@FbTypeId', $type->fbTypeId, $preparedStatements);
            $preparedStatements = str_replace('@FbTypeName', $type->fbTypeName, $preparedStatements);
        }
        return $preparedStatements;
    }
    
    public function getStdFbTypes() {
        $fbType = $this->getAllFbType();
        if($fbType){
            $fType = new \stdClass();
            foreach ($fbType as $type){
                $key = $type->fbTypeId;
                $fType->$key = $type->fbTypeName;
            }
            return $fType;  
        }
        return FALSE;
    }
}
