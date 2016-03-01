<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Model\Table;
use Cake\ORM\Table;
use Cake\ORM\TableRegistry;
use Cake\Log\Log;
use App\DTO\UploadDTO;
use App\DTO\DownloadDTO;
use Cake\Datasource\ConnectionManager;
/**
 * Description of SalesHistoryTable
 *
 * @author niteen
 */
class SalesHistoryTable extends Table{
    
    private function connect() {
        return TableRegistry::get('sales_history');
    }
    
    public function insert(DownloadDTO\SalesHistoryReportDto $salesHistoryReport) {
        $conn = ConnectionManager::get('default');
        $result = false;
        $tableObj = $this->connect();
        $newReport = $tableObj->newEntity();
        try{
            $newReport->RestaurantId = $salesHistoryReport->restaurantId;
            $newReport->Month = $salesHistoryReport->month;
            $newReport->Year = $salesHistoryReport->year;
            $newReport->BillNetAmount = $salesHistoryReport->billNetAmt;
            $newReport->BillTaxAmount = $salesHistoryReport->taxAmt;
            $newReport->BillTotalAmount = $salesHistoryReport->billTotalAmt;
            if($tableObj->save($newReport)){
               $conn->commit();
               return true;
            }
            $conn->rollback();
            return $result;
        } catch (Exception $ex) {
            return false;
        }
    }
    public function isEntryPresent(DownloadDTO\SalesHistoryReportDto $salesHistoryReport) {
        $conditions = [
            'RestaurantId =' => $salesHistoryReport->restaurantId, 
            'Month =' => $salesHistoryReport->month, 
            'Year =' => $salesHistoryReport->year];
        try{
            $results = $this->connect()->find()->where($conditions);
            return $results->count();
        } catch (Exception $ex) {
            return false;
        }
    }
    
    public function update(DownloadDTO\SalesHistoryReportDto $salesHistoryReport) {
         $conn = ConnectionManager::get('default');  
        $conditions = [
            'RestaurantId =' => $salesHistoryReport->restaurantId, 
            'Month =' => $salesHistoryReport->month, 
            'Year =' => $salesHistoryReport->year];
          $key = [
              'BillNetAmount ' => + $salesHistoryReport->billNetAmt, 
              'BilltaxAmount ' => + $salesHistoryReport->taxAmt, 
              'BillTotalAmount ' => + $salesHistoryReport->billTotalAmt];
        try{
            $updateObj = $this->connect()->query()->update();
            $updateObj->set($key);
            $updateObj->where($conditions);
            if($updateObj->execute()){
                $conn->commit();
                return true;
            }
            $conn->rollback();
            return false;
        } catch (Exception $ex) {
            $conn->rollback();
            return false;
        }
    }
    
    public function getdata($restaurantId) {
        $conditions = ['RestaurantId =' => $restaurantId];
        $resultSet[] = null;
        $dataCounter = 0;
        try{
         $rows = $this->connect()->find()->where($conditions);
         if($rows->count()){
            foreach ($rows as $row){
                 $resultSet[$dataCounter++] = new DownloadDTO\SalesReoprtViewDto(
                     $row->RestaurantId, 
                     $row->Month, 
                     $row->Year, 
                     $row->BillTotalAmount);
            }
         }
         return $resultSet;
        } catch (Exception $ex) {
            return false;
        }
    }
}
