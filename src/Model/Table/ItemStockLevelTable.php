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
/**
 * Description of ItemStockLevelTable
 *
 * @author niteen
 */
class ItemStockLevelTable extends Table{
    
    private function connect() {
        return TableRegistry::get('item_stock_level');
    }
    
    public function isStockOpen($day, $month, $year, $restaurantId) {
        $condtions = [
            'Day =' => $day,
            'Month' => $month,
            'Year' => $year,
            'RestaurantId =' => $restaurantId
        ];
        try{
            $result = $this->connect()->find()->where($condtions);
            if($result->count()){
                return TRUE;
            }
            return FALSE;
        } catch (Exception $ex) {
            return false;
        }
    }
    
    public function isStockClose($day, $month, $year, $restaurantId) {
        $condtions = [
            'Day =' => $day,
            'Month' => $month,
            'Year' => $year,
            'RestaurantId =' => $restaurantId
        ];
        $fields = ['Closing'];
        try{
            $result = $this->connect()->find('all',array('fields' => $fields, 'conditions' => $condtions))->orderAsc('StockLevelId')->first()->toArray();
            Log::debug($result);
            if(!is_null($result['Closing'])){
                return True;
            }
            return FALSE;
        } catch (Exception $ex) {
            return false;
        }
    }
    
    public function openStock(UploadDTO\OpenStockUploadDto $request) {
        try{
            $tableObj = $this->connect();
            $newEntity = $tableObj->newEntity();
            $newEntity->ItemId = $request->itemId;
            $newEntity->Opening = $request->stock;
            $newEntity->Day = $request->day;
            $newEntity->Month = $request->month;
            $newEntity->Year = $request->year;
            $newEntity->UnitId = $request->unitId;
            $newEntity->RestaurantId = $request->restaurantId;
            if($tableObj->save($newEntity)){
                return true;
            }
            return FALSE;
        } catch (Exception $ex) {
            return FALSE;
        }
    }
    
    public function closeStock(UploadDTO\OpenStockUploadDto $request) {
        $conditions = [
            'ItemId =' => $request->itemId,
            'Day =' => $request->day,
            'Month =' => $request->month,
            'Year ='  => $request->year,
            'RestaurantId' => $request->restaurantId
        ];
        $key = [
            'Closing' => $request->stock
        ];
        try{
            $update = $this->connect()->query()->update();
            $update->set($key);
            $update->where($conditions);
            if($update->execute()){
                return true;
            }
            return FALSE;
        } catch (Exception $ex) {
            return FALSE;
        }
    }
}
