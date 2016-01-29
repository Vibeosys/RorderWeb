<?php

namespace App\Controller;


use App\DTO;
use App\Model\Table;


/**
 * Description of DownloadController
 *
 * @author niteen
 */
class DownloadController extends ApiController {

    public function index() {
        $this->autoRender = false;

        $userId = $this->request->query("userId");
        $restaurantId = $this->request->query("restaurantId");
          \Cake\Log\Log::debug("Download request come with userId  :- ".$userId.' restaurantId :- '.$restaurantId);
        if (empty($userId) or empty($restaurantId)) {
            $this->response->body(DTO\ErrorDto::prepareError(101));
            \Cake\Log\Log::error("userId or restaurantID is blank ");
            return;
        }
        
        $restaurantController = new RestaurantController();
        if(!$restaurantController->isValidate($restaurantId)){
            $this->response->body(DTO\ErrorDto::prepareError(100));
            \Cake\Log\Log::error("request with incorrect restaurantId :- ".$restaurantId);
            return;
        }
        
        $userController = new UserController();
        if (!$userController->isUserValid($userId, $restaurantId)) {
            $this->response->body(DTO\ErrorDto::prepareError(102));
            \Cake\Log\Log::error("request with incorrect  userId :- ".$userId);
            return;
        } 
        \Cake\Log\Log::debug('Download request is validate successfully ');
        $syncController = new SyncController();
        $syncController->download($userId, $restaurantId);
    }

}
