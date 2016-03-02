<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controller;
use App\Model\Table;
use App\DTO\UploadDTO;
use App\DTO\DownloadDTO;
/**
 * Description of CustomerVisitController
 *
 * @author niteen
 */
class CustomerVisitController extends ApiController{
    
    private $timeSlot = ['f11to2' => '11-2',
                      'f2to3' => '2-3',
                      'f4to6' => '4-6',
                      'f6to8' => '6-8',
                      'f8to10' => '8-10',
                      'f10to12' => '10-12'];
    private $objKey = ['f11to2','f2to3','f4to6','f6to8','f8to10','f10to12'];
    private $paicahrt_default_data = ["formatnumberscale" => "0",
                              "showborder" => "0",
                              "caption" => "Daily Customer Visit",
                              "subCaption" => "Restaurant Name"];

    private function getTableObj() {
        return new Table\CustomerVisitTable();
    }
    
    public function makeCustomerVisitReport($customerVisitData) {
        $check = $this->getTableObj()->isEntryPresent($customerVisitData);
        if(!$check){
        return $this->getTableObj()->insert($customerVisitData);
        }  else {
            return $this->getTableObj()->update($customerVisitData);
        }
    }
    
    public function customerVisitReport() {
         $this->autoRender = false;
         
        $restaurantId = $this->request->query('id');
        \Cake\Log\Log::debug('Ajax request visited with RestaurantId :-'.$restaurantId);
        $customerVisitReportData = $this->getTableObj()->getdata($restaurantId);
        if(is_null($customerVisitReportData)){
             $this->response->type('text/plain');
            $this->response->body('Invalid Data');
            return ;
        }
        $intermediate = [];
        for($i = 0; $i < count($this->timeSlot); $i++){
            $index = $this->objKey[$i];
            $intermediate[$index] = $customerVisitReportData->$index; 
        }
        $data[] = null; $ind = 0;
        foreach ($intermediate as $key => $value){
            $data[$ind++] = new DownloadDTO\SalesHistoryDataDto($this->timeSlot[$key], $value);
        }
        $restaurantController = new RestaurantController();
        $restaurantDetails = $restaurantController->getRestaurant($restaurantId);
        $this->paicahrt_default_data['subCaption'] = $restaurantDetails->title;
        $stdObj = new \stdClass();
        foreach ($this->paicahrt_default_data as $key => $value){
        $stdObj->$key = $value;    
        }
        $salesMainDto = new DownloadDTO\SalesMainDto($stdObj, $data);
        $chartData = json_encode($salesMainDto);
        \Cake\Log\Log::debug('Customer Visit Report : - '.$chartData);
        $this->response->type('text/plain');
        $this->response->body($chartData);
    }
}