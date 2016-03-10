<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controller;
use App\Model\Table;
/**
 * Description of TakeawaySourceController
 *
 * @author niteen
 */

define('TAS_INS_QRY', "INSERT INTO takeaway_source (SourceId,SourceName,"
        . "SourceImg,Discount,Active) VALUES (@SourceId,\"@SourceName\","
        . "\"@SourceImg\",@Discount,@Active);");
class TakeawaySourceController extends ApiController{
    
    public function getTableObj() {
        return new Table\TakeawaySourceTable();
    }
    
    public function getTakeawaySource() {
        return $this->getTableObj()->getSource();
    }
    
    public function prepareInsertStatements() {
        $allSource = $this->getTakeawaySource();
        if (!$allSource) {
            return false;
        }
        $preparedStatements = '';

        foreach ($allSource as $source) {
            $preparedStatements .= TAS_INS_QRY;
            $preparedStatements = str_replace('@SourceId', $source->sourceId, $preparedStatements);
            $preparedStatements = str_replace('@SourceName', $source->sourceName, $preparedStatements);
            $preparedStatements = str_replace('@SourceImg', $source->sourceImg, $preparedStatements);
            $preparedStatements = str_replace('@Discount', $source->discount, $preparedStatements);
            $preparedStatements = str_replace('@Active', $source->active, $preparedStatements);
        }
        \Cake\Log\Log::debug('Takeaway Insert script :-'.$preparedStatements);
        return $preparedStatements;
    }
}
