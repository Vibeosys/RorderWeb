<?php

namespace App\Model\Table;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use Cake\Log\Log;
use Cake\ORM\Table;
use Cake\ORM\TableRegistry;
use App\DTO\DownloadDTO;
use App\DTO\UploadDTO;

/**
 * Description of UserTable
 *
 * @author niteen
 */
class UserTable extends Table {

    private function connect() {
        return TableRegistry::get('users');
    }

    public function getUser($restaurantId) {
        $conditions = ['RestaurantId =' => $restaurantId];
        $users = $this->connect()->find()->where($conditions);
        $count = $users->count();
        Log::debug('number of user present in database : ' . $count);
        if (!$count) {
            return 0;
        }
        $result[] = null;
        $i = 0;
        foreach ($users as $user) {
            $userDto = new DownloadDTO\UserDownloadDto(
                    $user->UserId, 
                    $user->UserName, 
                    $user->Password, 
                    $user->Active, 
                    $user->RoleId, 
                    $user->RestaurantId,
                    $user->Permissions);
            $result[$i] = $userDto;
            $i++;
        }
        return $result;
    }

    public function isValid($id, $restaurantId) {
        $conditions = ['UserId =' => $id, 'RestaurantId =' => $restaurantId];
        $users = $this->connect()->find()->where($conditions);
        $userCount = $users->count();
        return $userCount;
    }

    public function validateUserCredentials($userId, $password, $restaurantId) {
        $resultUser = $this->connect()->get($userId);
        if($resultUser->Password == $password && $resultUser->RestaurantId == $restaurantId && $resultUser->Active == ACTIVE)
        {
            return new UploadDTO\UserUploadDto(
                    $resultUser->UserId,
                    $resultUser->UserName,
                    NULL,
                    NULL,
                    $resultUser->RoleId,
                    $resultUser->RestaurantId
                    );
        }
        else {
            return NULL;
        }
    }
    public function insert(DownloadDTO\UserDownloadDto $user) {
        try{
            $tableObj = $this->connect();
            $newUser = $tableObj->newEntity();
            $newUser->UserId  = $user->userId;
            $newUser->UserName  = $user->userName;
            $newUser->Password = $user->password;
            $newUser->Active  = $user->active;
            $newUser->CreatedDate = date(VB_DATE_TIME_FORMAT);
            $newUser->UpdatedDate = date(VB_DATE_TIME_FORMAT);
            $newUser->RoleId = $user->roleId;
            $newUser->RestaurantId = $user->restaurantId;
            $newUser->Permissions = $user->permissions;
            if($tableObj->save($newUser)){
                return TRUE;
            }
            return false;
        } catch (Exception $ex) {
            return false;
        }
    }
     public function getUserId() {
        $conditions = array(
            'fields' => array('maxUserId' => 'MAX(users.UserId)'));
        $orderTableEntry = $this->connect()->find('all', $conditions)->toArray();
        $maxUserId = 0;
        if ($orderTableEntry) {
            $maxUserId = $orderTableEntry[0]['maxUserId'];
        }
        Log::debug('max UserId is :- ' . $maxUserId);
        if(!$maxUserId){
            $maxUserId = 100;
        }
        return $maxUserId;
    }
    
    public function getNewUser($userId) {
        $conditions = ['UserId =' => $userId];
         $users = $this->connect()->find()->where($conditions);
        $count = $users->count();
        if (!$count) {
            return 0;
        }
        foreach ($users as $user) {
            $userDto = new DownloadDTO\UserDownloadDto(
                    $user->UserId, 
                    $user->UserName, 
                    $user->Password, 
                    $user->Active, 
                    $user->RoleId, 
                    $user->RestaurantId);

        }
        return $userDto;
    }

}
