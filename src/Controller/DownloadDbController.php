<?php

namespace App\Controller;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use App\DTO;
use App\DTO\UploadDTO;
use App\Controller\Component;

/**
 * Description of DownloadDbController
 *
 * @author niteen
 */
class DownloadDbController extends ApiController {

    public function index() {
        $this->autoRender = false;

        $restaurantId = $this->request->query('restaurantId');
        $imei = $this->request->query('imei');
        $info = base64_decode($this->request->query('info'));
        $ipAddress = "113.193.128.35"; // $this->request->clientIp();
         $restaurantIMEIController = new RestaurantImeiController();
        if(!$restaurantIMEIController->isPresent($restaurantId, $imei)){
            $this->response->body(DTO\ErrorDto::prepareError(116));
            \Cake\Log\Log::error("request with incorrect restaurantId :- ".$restaurantId);
            return;
        }
        $restaurantController = new RestaurantController();
        \Cake\Log\Log::info('Request is in Download Controller');
        if ($restaurantController->isValidate($restaurantId) and ! empty($info)) {
            $networkDeviceDto = UploadDTO\NetworkDeviceInfoDto::Deserialize($info);
            $ipInfo = new Component\Ipinfo();
            $ipDetails = $ipInfo->getFullIpDetails($imei, $networkDeviceDto, $ipAddress);
            $networkDeviceController = new NetworkDeviceController();
            $addNetworkDeviceInfo = $networkDeviceController->addNetworkDeviceInfo($ipDetails, $restaurantId);
            $sqliteController = new SqliteController();
            $sqliteController->getDB($restaurantId);
        } else {
            $this->response->body(DTO\ErrorDto::prepareError(100));
        }
    }

}
