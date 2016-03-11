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
use Cake\Utility\Security;

/**
 * Description of ApiController
 *
 * @author niteen
 */
class ApiController extends AppController {
     private $validExt = array('png','jpg','jpeg');

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
    
    public function encrypt($plain) {
         $data = mcrypt_encrypt(MCRYPT_RIJNDAEL_256, ENCRYPTION_KEY, trim($plain), MCRYPT_MODE_ECB);
        return base64_encode( $data );
    }
    
    public function decrypt($cipher) {
        $data = base64_decode($cipher);
        return trim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, ENCRYPTION_KEY, trim($data), MCRYPT_MODE_ECB));
    }
    
    public function isImage($fileName) {
        $ext  = strtolower($this->getExtension($fileName));
        \Cake\Log\Log::debug('extenstion od image is :- '.$ext);
        if(in_array($ext, $this->validExt)){
             return true;
        }
        return false;
    }
    
    public function getTimeSlot($time) {
        \Cake\Log\Log::debug('current hours :'.$time);
        if(5.3 < $time and $time < 7.3){
            return 'f11to2';
        }elseif (7.3 < $time and $time < 9.3) {
            return 'f2to3';
        }elseif (9.3 < $time and $time < 11.3) {
            return 'f4to6';
        }elseif (11.3 < $time and $time < 13.3) {
            return 'f6to8';
        }elseif (13.3 < $time and $time < 15.3) {
            return 'f8to10';
        }elseif (15.3 < $time and $time < 17.3) {
            return 'f10to12';
        }
        return false;
    }
    
    public function isZero($value) {
        if($value){
            return $value;
        }else{
            return null;
        }
    }
    
    public function isNull($value) {
        if(is_null($value)){
            return 0;
        }else{
            return $value;
        }
    }

}
