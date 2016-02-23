<?php

namespace App\Controller;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use App\Model\Table;
use App\DTO;
use Cake\Datasource\ConnectionManager;

/**
 * Description of ApiController
 *
 * @author niteen
 */
class ApiController extends AppController {

    public function initialize() {
        parent::initialize();
        $this->response->type('json');
    }

    public function error() {
        $this->autoRender = false;
        $url = $this->request->url;
        \Cake\Log\Log::error('User hit with unknown api Endpoint : ' . $url);
        $this->response->body(DTO\ErrorDto::prepareError(404));
    }

    public function transBegin() {
        $conn = ConnectionManager::get('default');
        $conn->begin();
    }

    public function transRollback() {
        $conn = ConnectionManager::get('default');
        $conn->rollback();
    }

    public function transCommit() {
        $conn = ConnectionManager::get('default');
        $conn->commit();
    }

    public function getExtension($fileName) {
        return end((explode('.', $fileName)));
    }

    public function getGUID() {
        if (function_exists('com_create_guid')) {
            return com_create_guid();
        } else {
            mt_srand((double) microtime() * 10000); //optional for php 4.2.0 and up.
            $charid = strtoupper(md5(uniqid(rand(), true)));
            $hyphen = chr(45); // "-"
            $uuid = substr($charid, 0, 8) . $hyphen
                    . substr($charid, 8, 4) . $hyphen
                    . substr($charid, 12, 4) . $hyphen
                    . substr($charid, 16, 4) . $hyphen
                    . substr($charid, 20, 12); // "}"
            return $uuid;
        }
    }

}
