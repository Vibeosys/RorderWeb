<?php

namespace App\Model\Table;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use Cake\ORM\Table;
use Cake\Filesystem\Folder;

/**
 * Description of Mysql2SqliteTable
 *
 * @author niteen
 */
class SqliteTable extends Table {

    private $sqliteFile;

    public function create($prefix) {
        $returnValue = false;
        $dbDir = new Folder(SQLITE_DB_DIR, true);
        \Cake\Log\Log::debug('folder created');
        $fileName = $prefix.'RorderDb' . '.sqlite';
        $this->sqliteFile = $dbDir->path .$fileName ;
        if(file_exists($this->sqliteFile)){
            unlink($this->sqliteFile);
        }
        $db = new \SQLite3($this->sqliteFile);
        if ($db != NULL) {
            $fileContents = file_get_contents(__DIR__ . DS . 'CreateTableScripts.sql');
            $returnValue = $db->exec($fileContents);
            $db->close();
        }
        if($returnValue){
            return $this->sqliteFile;
        }
        return $returnValue;
    }

    public function excutePreparedStatement($Text) {
        $db = new \SQLite3($this->sqliteFile);
        if ($Text) {
            try {
                $success = $db->exec($Text);
                $db->close();
                return $success;
            } catch (Exception $ex) {
                throw "sqlite database error";
            }
        }
        return false;
    }

}
