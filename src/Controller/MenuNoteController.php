<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controller;
use App\Model\Table;
use Cake\Log\Log;
/**
 * Description of MenuNoteController
 *
 * @author niteen
 */
define('MN_INS_QRY', "INSERT INTO menu_note_master (NoteId,"
        . "NoteTitle,Active) VALUES (@NoteId,\"@NoteTitle\",@Active);");
class MenuNoteController {
    
    private function getTableObj() {
        return new Table\MenuNoteTable();
    }
    
    public function prepareInsertStatements($restaurantId) {
        $allMenuNote = $this->getTableObj()->getMenuNote($restaurantId);
        if(!$allMenuNote){
            return false;
        }
         $preparedStatements = '';

        foreach ($allMenuNote as $menuNote) {
            $preparedStatements .= MN_INS_QRY;
            $preparedStatements = str_replace('@NoteId', $menuNote->noteId, $preparedStatements);
            $preparedStatements = str_replace('@NoteTitle', $menuNote->noteTitle, $preparedStatements);
            $preparedStatements = str_replace('@Active', $menuNote->active, $preparedStatements);
        }
        return $preparedStatements;
    }
    
}
