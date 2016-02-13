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

        $users = $this->connect()->find()->where(['RestaurantId =' => $restaurantId]);
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
                    $user->CreatedDate, 
                    $user->UpdatedDate, 
                    $user->RoleId, 
                    $user->RestaurantId);

            $result[$i] = $userDto;
            $i++;
        }
        return $result;
    }

    public function isValid($id, $restaurantId) {
        $users = $this->connect()->find()->where(['UserId =' => $id, 'RestaurantId =' => $restaurantId]);
        return $users->count();
    }

    public function validateUserCredentials($userId, $password, $restaurantId) {
        $resultUser = $this->connect()->get($userId);
        if($resultUser->Password == $password && $resultUser->RestaurantId == $restaurantId && $resultUser->Active == 1)
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

}
