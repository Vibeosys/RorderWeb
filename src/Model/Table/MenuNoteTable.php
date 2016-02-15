<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\ORM\TableRegistry;
use Cake\Log\Log;
use App\DTO\UploadDTO;
use \App\DTO\DownloadDTO;

/**
 * Description of MenuNoteTable
 *
 * @author niteen
 */
class MenuNoteTable extends Table {

    private function connect() {
        return TableRegistry::get('menu_note_master');
    }

    public function getMenuNote($restaurantId) {
        $menuNoteList = null;
        $menuNoteCounter = 0;
        $conditions = ['RestaurantId =' => $restaurantId, 'Active =' => ACTIVE];
        try {
            $menuNotes = $this->connect()->find()->where($conditions);
            if ($menuNotes->count()) {
                    $menuNoteList = array();
                foreach ($menuNotes as $note) {
                    $menuNoteDto = new DownloadDTO\MenuNoteDownloadDto(
                            $note->NoteId, 
                            $note->NoteTitle, 
                            $note->Active);
                    $menuNoteList[$menuNoteCounter++] = $menuNoteDto;
                }
            }
            return $menuNoteList;
        } catch (Exception $ex) {
            return false;
        }
    }

}
