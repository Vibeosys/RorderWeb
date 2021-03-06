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
    
    private $timeSlot = ['f11to2' => '11Am To 2Pm',
                      'f2to3' => '2Pm to 3Pm',
                      'f4to6' => '4Pm to 6Pm',
                      'f6to8' => '6Pm to 8Pm',
                      'f8to10' => '8Pm to 10Pm',
                      'f10to12' => '10Pm to 12Pm'];
    private $objKey = ['f11to2','f2to3','f4to6','f6to8','f8to10','f10to12'];
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
            $this->response->body(0);
            return ;
        }
        $intermediate = [];
        foreach ($this->objKey as $key => $value){
             $intermediate[$value] = 0;
        }
        foreach ($customerVisitReportData as $reportData){
            for($i = 0; $i < count($this->timeSlot); $i++){
                $index = $this->objKey[$i];
                $intermediate[$index] = $intermediate[$index] + $reportData->$index; 
            }
        }
        $data[] = null; $ind = 0;
        foreach ($intermediate as $key => $value){
            $data[$ind++] = new DownloadDTO\RushHourReportDto($value, $this->timeSlot[$key], $this->timeSlot[$key]);       
                   
        }
        $chartData = json_encode($data);
        $this->response->body($chartData);
    }
    
    public function rushHourReport() {
         if(!$this->isLogin()){
            $this->redirect('login');
        }
         if($this->request->is('get')){
            $this->set(['limit' => 1]);
        }
        $this->set([
            'rest' => parent::readCookie('cri')
            ]);
    }
}
