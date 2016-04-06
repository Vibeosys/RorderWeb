<?php

namespace App\Controller;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use App\Model\Table;
use Cake\Log\Log;
use Cake\Filesystem\File;
use App\DTO\DownloadDTO;
use App\DTO\UploadDTO;
use App\DTO;

/**
 * Description of MenuController
 *
 * @author niteen
 */
define('MENU_INS_QRY', "INSERT INTO menu (MenuId,MenuTitle,Image,Price,Ingredients,"
        . "Tags,AvailabilityStatus,Active,IsSpicy,CategoryId,RoomId,FbTypeId) "
        . "VALUES (@MenuId,\"@MenuTitle\",\"@Image\",@Price,\"@Ingredients\",\"@Tags\","
        . "@AvailabilityStatus,@Active,@IsSpicy,@CategoryId,@RoomId,@FbTypeId);");

class MenuController extends ApiController {

    private function getTableObj() {
        return new Table\MenuTable();
    }

    public function getMenus($restaurantId) {
        $result = $this->getTableObj()->getMenu($restaurantId);
        if ($result) {
            return $result;
        }
        return false;
    }
    
    public function getMenuItemList($restaurantId, $menuItemIdList) {
        $result = $this->getTableObj()->getMenuItemInfoList($menuItemIdList);
        if (is_array($result)) {
            return $result;
        }
        return NULL;
    }

    public function prepareInsertStatements($restaurantId) {

        $allMenus = $this->getMenus($restaurantId);
        if (!$allMenus) {
            return false;
        }
        $preparedStatements = '';

        foreach ($allMenus as $menu) {
            $preparedStatements .= MENU_INS_QRY;
            $preparedStatements = str_replace('@MenuId', $menu->menuId, $preparedStatements);
            $preparedStatements = str_replace('@MenuTitle', $menu->menuTitle, $preparedStatements);
            $preparedStatements = str_replace('@Image', $menu->image, $preparedStatements);
            $preparedStatements = str_replace('@Price', $menu->price, $preparedStatements);
            $preparedStatements = str_replace('@Ingredients', $menu->ingredients, $preparedStatements);
            $preparedStatements = str_replace('@Tags', $menu->tags, $preparedStatements);
            $preparedStatements = str_replace('@AvailabilityStatus', $menu->availabilityStatus, $preparedStatements);
            $preparedStatements = str_replace('@Active', $menu->active, $preparedStatements);
            //$preparedStatements = str_replace('@FoodType', $menu->foodType, $preparedStatements);
            $preparedStatements = str_replace('@IsSpicy', $menu->isSpicy, $preparedStatements);
            $preparedStatements = str_replace('@CategoryId', $menu->categoryId, $preparedStatements);
            $preparedStatements = str_replace('@RoomId', $this->isNull($menu->roomId), $preparedStatements);
            $preparedStatements = str_replace('@FbTypeId', $this->isNull($menu->fbTypeId), $preparedStatements);
        }
        return $preparedStatements;
    }
    
    public function addNewMenu() {
        if(!$this->isLogin()){
            $this->redirect('login');
        }
       if ($this->request->is('post') and isset($this->request->data['add-menu'])) {
            $restaurantId = parent::readCookie('cri');
            $data = $this->request->data();
            $file = $data['file-upload']['tmp_name'];
            $extenstion = $this->getExtension($data['file-upload']['name']);
            if (empty($file)) {
                $this->set(['message' => SELECT_FILE_MESSAGE,'color' => 'red']);
            } elseif ($extenstion != CSV_EXT) {
                $this->set([MESSAGE => INCORRECT_FILE_MESSAGE, 'color' => 'red']);
            } else {
                if (($handle = fopen($file, "r")) !== FALSE) {
                    $counter = 0;
                    $allMenus= null;
                    fgetcsv($handle);
                    while (($filesop = fgetcsv($handle, 1000, ",")) !== false) {
                            $menuDto = new UploadDTO\MenuInsertDto(
                                    $filesop[0], 
                                    null, 
                                    $filesop[1], 
                                    $filesop[2], 
                                    null, 
                                    ACTIVE, 
                                    ACTIVE, 
                                    Null, 
                                    $filesop[3], 
                                    $filesop[4], 
                                    $restaurantId,
                                    $filesop[5],
                                    null,
                                    $filesop[6]);
                           $allMenus[$counter] = $menuDto;
                           $counter++;
                    }
                    fclose($handle);
                    $result = $this->getTableObj()->insert($allMenus);
                    if ($result) {
                        $this->set(['message' => 'You database has imported successfully. You have inserted ' . $result . ' recoreds','color' => 'green']);
                    } else {
                        $this->set(['message' => DB_FILE_ERROR,'color' => 'red']);
                    }
                }
            }
        }
    }
    
    public function menuList(){
        $restaurantId = parent::readCookie('cri');
        if(!$this->isLogin()){
            $this->redirect('login');
        }
        $parameter = $this->request->param('page');
        $menuList = $this->paginatedMenu($restaurantId,$parameter);
        $menuCategoryController = new MenuCategoryController();
        $category = $menuCategoryController->getStdMenuCategory();
        $roomCategoryController = new RRoomsController();
        $rooms = $roomCategoryController->getStdRooms($restaurantId);
        $fbTypeController = new FbTypeController();
        $fbType = $fbTypeController->getStdFbTypes();
        $this->set([
                    'menus' => $menuList,
                    'categories' => $category,
                    'room' => $rooms,
                    'fbType' => $fbType
                ]);
    }
    
    public function editMenu() {
        $restaurantId = parent::readCookie('cri');
        $data = $this->request->data;
        if($this->request->is('post') and isset($data['edit'])){
            $stdMenu = new \stdClass();
            foreach ($data as $k => $v){
                $stdMenu->$k = $v;
            }
            $menuCategoryController = new MenuCategoryController();
            $category = json_decode(json_encode($menuCategoryController->getStdMenuCategory(),true));
            $roomCategoryController = new RRoomsController();
            $rooms = json_decode(json_encode($roomCategoryController->getStdRooms($restaurantId),true));
            $fbTypeController = new FbTypeController();
            $fbType = json_decode(json_encode($fbTypeController->getStdFbTypes()));
             $this->set([
                    'menuInfo' => $stdMenu,
                    'category' => $category,
                    'room' => $rooms,
                    'fbType' => $fbType
                ]);
        }elseif ($this->request->is('post') and isset($data['save'])) {
           $updateRequest = new UploadDTO\MenuInsertDto(
                   $data['ttl'], 
                   $data['img'], 
                   $data['prc'], 
                   $data['igt'], 
                   $data['tags'], 
                   $this->getValue('avl', $data), 
                   $this->getValue('act', $data), 
                   null, 
                   $this->getValue('spy', $data), 
                   $data['category'], 
                   $restaurantId, 
                   $data['room'], 
                   $data['mid'],
                   $data['fbType']);
           $updateResult = $this->getTableObj()->update($updateRequest);
          if ($updateResult) {
                $menuUpdate = $this->getTableObj()->getUpdateMenu($updateRequest->menuId);
                $this->makeSyncEntry(
                        json_encode($menuUpdate), 
                        UPDATE_OPERATION, 
                        $restaurantId);
                $this->set([MESSAGE => DTO\ErrorDto::prepareMessage(134),COLOR => SUCCESS_COLOR]);
            } else {
                $this->set([MESSAGE => DTO\ErrorDto::prepareMessage(136),COLOR => ERROR_COLOR]);
            }
        }elseif ($this->request->is('post') and isset($data['edit-recipe'])) {
            parent::writeCookie('current-mid',  $data['mid']);
           
            $this->redirect('menu/editrecipe');
        }
    }
    
    public function paginatedMenu($restaurantId,$page = 1) {
        $menuTable = $this->getTableObj();
        $count = $menuTable->connect()->find()->count(); 
        Log::debug('Number of menu available in list is :- '.$count);
        if(!$count){
            return Null;
        }
        $conditions = array('RestaurantId =' => $restaurantId);
        $limit = PAGE_LIMIT;
        $menus = $this->paginate($menuTable->connect()->find()->where($conditions),['limit' => $limit, 'page' => $page]);
         $allMenus = null;
        $i = 0;
        foreach ($menus as $menu) {
            $menuDto = new DownloadDTO\MenuDownloadDto(
                    $menu->MenuId, 
                    $menu->MenuTitle, 
                    $menu->Image, 
                    $menu->Price, 
                    $menu->Ingredients, 
                    $menu->Tags, 
                    $menu->AvailabilityStatus, 
                    $menu->Active, 
                    $menu->FoodType, 
                    $menu->IsSpicy, 
                    $menu->CategoryId,
                    $menu->RoomId,
                    $menu->FbTypeId);
            $allMenus[$i] = $menuDto;
            $i++;
        }
        return $allMenus;
    }

    private function makeSyncEntry($update, $operation, $restaurantId) {
        $synController = new SyncController();
        $synController->MenuEntry($update, $operation, $restaurantId);
    }
    
    public function editRecipe() {
        $menuId = parent::readCookie('current-mid');
         $menuRecipeController = new MenuRecipeController();
         $data = $this->request->data;
         $result = TRUE;
         
         if($this->request->is('post') and isset($data['save'])){
             //$this->autoRender = FALSE;
             $menurecipeDto = new UploadDTO\MenuRecipeInsertDto(
                     $menuId, 
                     $data['recipeItem'], 
                     $data['qty'], 
                     $data['itemUnit']);
             $result = $menuRecipeController->addNewRecipeItem($menurecipeDto);
         }
            $recipe = $menuRecipeController->getMenuRecipe($menuId);
            $menuInfo = $this->getMenuItemList(null, array($menuId));
            $menu = null;
            foreach ($menuInfo as $menui){
                if(is_null($menu)){
                    $menu = $menui;
                }
            }
            Log::debug($recipe);
            $this->set([
                'menurecipe' => $recipe,
                'menu' => $menu
            ]);
         
    }
    
    public function addNewItem() {
        
    }

}
