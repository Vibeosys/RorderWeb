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
 * Description of MenuTagController
 *
 * @author niteen
 */
define('MT_INS_QRY', "INSERT INTO menu_tags (TagId,TagTitle) VALUES (@TagId,\"@TagTitle\");");
class MenuTagController extends ApiController{
   
    private function gettableObj() {
        return new Table\MenuTagTable();
    }
    public function getMenuTags() {
        $result = $this->gettableObj()->getMenuTag();
        if($result){
            return $result;
        }
        return false;
    }
    
    public function prepareInsertStatements() {
        $allMenuTags = $this->getMenuTags();
        if (!$allMenuTags) {
            return false;
        }
        $preparedStatements = '';

        foreach ($allMenuTags as $tags) {
            $preparedStatements .= MT_INS_QRY;
            $preparedStatements = str_replace('@TagId', $tags->tagId, $preparedStatements);
            $preparedStatements = str_replace('@TagTitle', $tags->tagTitle, $preparedStatements);
        }
        return $preparedStatements;
        
        
        
    }
    
}
