<?php

namespace App\Controller;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DownloadDbController
 *
 * @author niteen
 */
class DownloadDbController extends ApiController {

    public function index() {
        $this->autoRender = false;
        $sqliteController = new SqliteController();
        $sqliteController->getDB();
    }

}
