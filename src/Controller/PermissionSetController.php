<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controller;
use App\Model\Table;
/**
 * Description of PermissionSetController
 *
 * @author niteen
 */
define('PERS_INS_QRY', "INSERT INTO permission_set (PermissionId,PermissionKey,Description,Active"
        . ") VALUES (@PermissionId,\"@PermissionKey\",\"@Description\","
        . "@Active);");

class PermissionSetController extends ApiController{
    
    public function getTableObj() {
        return new Table\PermissionSetTable();
    }
    
    public function prepareInsertStatement() {
        $allPermissionSets = $this->getTableObj()->getSets();
        if (!$allPermissionSets) {
            return false;
        }
        $preparedStatements = '';

        foreach ($allPermissionSets as $set) {
            $preparedStatements .= PERS_INS_QRY;
            $preparedStatements = str_replace('@PermissionId', $set->permissionId, $preparedStatements);
            $preparedStatements = str_replace('@PermissionKey', $set->permissionKey, $preparedStatements);
            $preparedStatements = str_replace('@Description', $set->description, $preparedStatements);
            $preparedStatements = str_replace('@Active', $set->active, $preparedStatements);
        }
        return $preparedStatements;
    }
    
    public function getPermissionSet() {
        return $this->getTableObj()->getSets();
    }
}
