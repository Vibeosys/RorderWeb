<?php

namespace App\Controller;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use App\Model\Table;
use Cake\Log\Log;
use App\DTO\DownloadDTO;
use App\DTO;

/**
 * Description of UserController
 *
 * @author niteen
 */
define('USER_INS_QRY', "INSERT INTO users (UserId,UserName,Password,Active,"
        . "RoleId,RestaurantId,Permissions) VALUES (@UserId,\"@UserName\",\"@Password\","
        . "@Active,@RoleId,@RestaurantId,@Permissions);");

class UserController extends ApiController {

    public function getTbaleObj() {
        return new Table\UserTable();
    }

    public function getUsers($restaurantId) {
        $userResult = $this->getTbaleObj()->getUser($restaurantId);
        return $userResult;
    }

    public function isUserValid($userId, $restaurantId) {
        return $this->getTbaleObj()->isValid($userId, $restaurantId);
    }
    
    public function validateUserForUpload($userId, $password, $restaurantId) {
        return $this->getTbaleObj()->validateUserCredentials($userId, $password, $restaurantId);
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
            $preparedStatements = str_replace('@RoleId', $user->roleId, $preparedStatements);
            $preparedStatements = str_replace('@RestaurantId', $user->restaurantId, $preparedStatements);
            $preparedStatements = str_replace('@Permissions', $this->isNull($user->permissions), $preparedStatements);
        }
        return $preparedStatements;
    }
    
    public function addNewUser() {
         if(!$this->isLogin()){
            $this->redirect('login');
        }
        $permissionSetController = new PermissionSetController();
        $permission = $permissionSetController->getPermissionSet();
        $userRoleController =  new UserRoleController();
        $userRoles = $userRoleController->getUserRole();
        $restaurantId = parent::readCookie('cri');
        if($this->request->is('post') and isset($this->request->data['save'])){
            $userData = $this->request->data;
            $userId = $this->getTbaleObj()->getUserId() + 1;
            $userUploadDto  = new DownloadDTO\UserDownloadDto(
                    $userId,
                    $userData['userName'], 
                    $userData['password'],
                    ACTIVE,
                    $userData['userRole'], 
                    $restaurantId,
                    $this->createUserPermision($userData));
            $insertResult = $this->getTbaleObj()->insert($userUploadDto);
            if ($insertResult) {
                $newUser = $this->getTbaleObj()->getNewUser($userId);
                $this->makeSyncEntry(
                        $userId, 
                        json_encode($newUser), 
                        INSERT_OPERATION, 
                        $restaurantId);
                $this->set([MESSAGE => DTO\ErrorDto::prepareMessage(130),COLOR => SUCCESS_COLOR,'permissions' => $permission,'roles' => $userRoles]);
            } else {
                $this->set([MESSAGE => DTO\ErrorDto::prepareMessage(132),COLOR => ERROR_COLOR,'permissions' => $permission,'roles' => $userRoles]);
            }
        }  else {
           $this->set(['roles' => $userRoles,'permissions' => $permission]);
        }
    }
    
    private function makeSyncEntry($userId, $json, $operation, $restaurantId) {
        $syncController = new SyncController();
        $result = $syncController->usersEntry($userId, $json, $operation, $restaurantId);
        return $result;
    }
    
    public function getUserName($userId) {
        $result = $this->getTbaleObj()->getNewUser($userId);
        if($result){
            return $result;
        }
        return null;
    }
    
    private function createUserPermision($data) {
         $permissionSetController = new PermissionSetController();
         $permissions = $permissionSetController->getPermissionSet();
         $userPermission = null;
         $saparator = '|';
         foreach ($permissions as $permission){
             if(in_array($permission->permissionId, $data)){
                 $userPermission = $userPermission.$permission->permissionId.$saparator;
             }
         }
         return substr($userPermission, 0, -1);
    }
    
    public function usersList() {
        if(!$this->isLogin()){
            $this->redirect('login');
        }
        $userRoleController = new UserRoleController();
        $roles = $userRoleController->getUserRoleStdObj();
        $permissionController = new PermissionSetController();
        $permissions = $permissionController->getPermissionsStdObj();
        $restaurantId = $this->readCookie('cri');
        $userList = $this->getUsers($restaurantId);
        $this->set(['users' => $userList, 'roles' => $roles, 'permissions' => $permissions]);
    }
    
    public function editUser() {
        $restaurantId = parent::readCookie('cri');;
        $requestData = $this->request->data;
        $userRoleController =  new UserRoleController();
            $userRoles = $userRoleController->getUserRole();
            $permissionSetController = new PermissionSetController();
            $permission = $permissionSetController->getPermissionSet();
        if($this->request->is('post') and isset($requestData['edit'])){
            $stdUser = new \stdClass();
            foreach ($requestData as $key => $value){
                $stdUser->$key = $value;
            }
            
            $this->set(['userInfo' => $stdUser, 'roles' => $userRoles,'permissions' => $permission]);
        }elseif ($this->request->is('post') and isset($requestData['save'])) {
             $userUploadDto  = new DownloadDTO\UserDownloadDto(
                    $requestData['uid'],
                    $requestData['userName'], 
                    $requestData['password'],
                    ACTIVE,
                    $requestData['userRole'], 
                    $restaurantId,
                    $this->createUserPermision($requestData));
            $insertResult = $this->getTbaleObj()->insert($userUploadDto);
            if ($insertResult) {
                $newUser = $this->getTbaleObj()->getNewUser($userUploadDto->userId);
                $this->makeSyncEntry(
                        $userUploadDto->userId, 
                        json_encode($newUser), 
                        UPDATE_OPERATION, 
                        $restaurantId);
                $this->set([MESSAGE => DTO\ErrorDto::prepareMessage(131),COLOR => SUCCESS_COLOR,'permissions' => $permission, 'roles' => $userRoles]);
            } else {
                $this->set([MESSAGE => DTO\ErrorDto::prepareMessage(133),COLOR => ERROR_COLOR,'permissions' => $permission, 'roles' => $userRoles]);
            }
        }
    }
    
    
}
