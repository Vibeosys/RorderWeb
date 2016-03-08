<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Model\Table;
use Cake\ORM\TableRegistry;
use Cake\ORM\Table;
use App\DTO\DownloadDTO;
use App\DTO\UploadDTO;
use Cake\Log\Log;
/**
 * Description of CustomerVisitTable
 *
 * @author niteen
 */
class CustomerVisitTable extends Table{
    
    public function connect() {
        return TableRegistry::get('customer_visit');
    }
    
    public function getData($restaurantId) {
        $conditions = ['RestaurantId' => $restaurantId,
                        'Month' => date('m'),
                        'Year' => date('Y')];
        $rows = $this->connect()->find()->where($conditions);
        $customerVisitInfo = null;
        $indexCounter = 0;
        foreach ($rows as $row){
            $customerVisitDto = new DownloadDTO\CustomerVisitDwnldDto(
                    $row->RestaurantId, 
                    $row->Month, 
                    $row->Year, 
                    $row->Day, 
                    $row->f11to2, 
                    $row->f2to3, 
                    $row->f4to6, 
                    $row->f6to8, 
                    $row->f8to10, 
                    $row->f10to12);
        $customerVisitInfo[$indexCounter++] = $customerVisitDto;
        }
        return $customerVisitInfo;
    }
    
    public function isEntryPresent(UploadDTO\CustomerVisitUpldDto $customerVisitData) {
        $conditions = [
            'RestaurantId =' => $customerVisitData->restaurantId,
            'Month =' => $customerVisitData->month,
            'Year =' => $customerVisitData->year,
            'Day =' => $customerVisitData->day
            ];
        try{
            $result = $this->connect()->find()->where($conditions);
            return $result->count();
        } catch (Exception $ex) {
            return false;
        }
    }
    
    public function insert(UploadDTO\CustomerVisitUpldDto $customerVIsitData) {
        try{
            $tableObj = $this->connect();
            $newEntry = $tableObj->newEntity();
            $newEntry->RestaurantId = $customerVIsitData->restaurantId;
            $newEntry->Month = $customerVIsitData->month;
            $newEntry->Year = $customerVIsitData->year;
            $newEntry->Day = $customerVIsitData->day;
            $time = $customerVIsitData->timeSlot;
            $newEntry->$time = + 1;
            if($tableObj->save($newEntry)){
                Log::debug('customer visit added successfully');
                return true;
            }
            Log::error('customer visit error in insert');
            return false;
        } catch (Exception $ex) {
            return false;
        }
    }
    
    public function update(UploadDTO\CustomerVisitUpldDto $customerVIsitData) {
        $conditions = [
            'RestaurantId =' => $customerVIsitData->restaurantId,
            'Month =' => $customerVIsitData->month,
            'Year =' => $customerVIsitData->year,
            'Day =' => $customerVIsitData->day
            ];
        $timeSlot = $customerVIsitData->timeSlot;
        try{
            $tableObj = $this->connect();
            $entity = $tableObj->get($conditions);
            $entity->$timeSlot = $entity->$timeSlot + 1;
            if($tableObj->save($entity)){
                Log::debug('customer visit updated successfully');
                return TRUE;
            }
            Log::error('customer visit error in update');
            return false;
        } catch (Exception $ex) {
            return false;
        }
    }
}
