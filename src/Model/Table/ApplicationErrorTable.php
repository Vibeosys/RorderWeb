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
use App\DTO\DownloadDTO;
/**
 * Description of ApplicationErrorTable
 *
 * @author niteen
 */
class ApplicationErrorTable extends Table{
    
    public function connect() {
        return TableRegistry::get('application_error');
    }
    
    public function insert(UploadDTO\ApplicationErrorUploadDto $request, $userInfo) {
        try{
            $tableObj  =  $this->connect();
            $newEntity = $tableObj->newEntity();
            $newEntity->Source = $request->source;
            $newEntity->Method = $request->method;
            $newEntity->Description = $request->description;
            $newEntity->UserId = $userInfo->userId;
            $newEntity->RestaurantId = $userInfo->restaurantId;
            $newEntity->ErrorDate = $request->errorDate;
            $newEntity->ErrorTime = $request->errorTime;
            $newEntity->CreatedDate = date(VB_DATE_TIME_FORMAT);
            if($tableObj->save($newEntity)){
                return true;
            }
            return FALSE;
        } catch (Exception $ex) {
           return FALSE;
        }
    }
}
