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
/**
 * Description of UserTable
 *
 * @author niteen
 */
class UserTable extends Table{
    
    
    private function connect() {
        return TableRegistry::get('users');
    }
    
    public function getUser($restaurantId) {
        
        $users = $this->connect()->find()->where(['restaurantId =' => $restaurantId]);
        $count = $users->count();
        Log::debug('number of user present in database : '.$count);
        if(!$count){
            return 0;
        }
        $result[] = null; 
        $i = 0;
        foreach ($users as $user){
           $userDto = new DownloadDTO\UserDownloadDto($user->UserId, $user->UserName,
                   $user->Password, $user->Active, $user->CreatedDate, $user->UpdatedDate, 
                   $user->RoleId, $user->RestaurantId);
        
           $result[$i] = $userDto;
           Log::info('updated date of user'.$userDto->active);
           $i++;
        }
        return $result;
    }
    public function isValid($id, $restaurantId) {
        $users = $this->connect()->find()->where(['UserId =' => $id, 'RestaurantId =' =>$restaurantId]);
        return $users->count();
        
    }
    
}
