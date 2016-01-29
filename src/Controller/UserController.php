<?php
namespace App\Controller;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
use App\Model\Table;
use Cake\Log\Log;
use App\DTO;
/**
 * Description of UserController
 *
 * @author niteen
 */
define('USER_INS_QRY', "INSERT INTO users (UserId,UserName,Password,Active,CreatedDate,"
        . "UpdatedDate,RoleId,RestaurantId) VALUES (@UserId,\"@UserName\",\"@Password\","
        . "@Active,\"@CreatedDate\",\"@UpdatedDate\",@RoleId,@RestaurantId);");
class UserController extends ApiController{
    
    
    public function getTbaleObj() {
        return new Table\UserTable();
    }
    public function getUsers($restaurantId) {
        $this->autoRender = false;
        $result  = $this->getTbaleObj()->getUser($restaurantId);
        return $result;
    }
    
    public function isUserValid($userId ,$restaurantId) {
        return $this->getTbaleObj()->isValid($userId ,$restaurantId);
    }
     public function prepareInsertStatement($restaurantId) {
        $allUsers = $this->getUsers($restaurantId);
        if (!$allUsers) {
            return false;
        }
        $preparedStatements = '';

        foreach ($allUsers as $user) {
            $preparedStatements .= USER_INS_QRY;
            $preparedStatements = str_replace('@UserId', $user->userId, $preparedStatements);
            $preparedStatements = str_replace('@UserName', $user->userName, $preparedStatements);
            $preparedStatements = str_replace('@Password', $user->password, $preparedStatements);
            $preparedStatements = str_replace('@Active', $user->active, $preparedStatements);
            $preparedStatements = str_replace('@CreatedDate', $user->createdDate, $preparedStatements);
            $preparedStatements = str_replace('@UpdatedDate', $user->updatedDate, $preparedStatements);
            $preparedStatements = str_replace('@RoleId', $user->roleId, $preparedStatements);
            $preparedStatements = str_replace('@RestaurantId', $user->restaurantId, $preparedStatements);
        }
        return $preparedStatements;
    }
}
