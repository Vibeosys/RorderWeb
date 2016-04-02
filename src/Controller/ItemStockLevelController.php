<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controller;
use App\Model\Table;
use App\DTO\UploadDTO;
/**
 * Description of ItemStockLevelController
 *
 * @author niteen
 */
class ItemStockLevelController extends ApiController{
    
    private function getTableObj() {
        return new Table\ItemStockLevelTable();
        
    }
    
    public function stockOpenCheck() {
        $this->autoRender = FALSE;
        $restaurantId = $this->readCookie('cri');
        $result = $this->getTableObj()->isStockOpen(date('d'), date('m'), date('Y'), $restaurantId);
        if($result){
            $this->response->body(1);
        }  else {
            $this->response->body(0);
        }
    }
    
    public function stockCloseCheck() {
         $this->autoRender = FALSE;
        $restaurantId = $this->readCookie('cri');
        $result = $this->getTableObj()->isStockClose(date('d'), date('m'), date('Y'), $restaurantId);
        if($result){
            $this->response->body(1);
        }  else {
            $this->response->body(0);
        }
    }
    
    public function saveOpenStock() {
        \Cake\Log\Log::debug('Request hitted');
       $this->autoRender = FALSE;
       $restaurantId = $this->readCookie('cri');
        if($this->request->is('post')){
            $itemId = $this->request->data('item');
            $stock = $this->request->data('stock');
            $unit = $this->request->data('unit');
            for($i = 0; $i < count($itemId); $i++){
                $openStockDto = new UploadDTO\OpenStockUploadDto(
                        $itemId[$i], $stock[$i], date('d'), date('m'), 
                        date('Y'), $unit[$i],$restaurantId);
                $this->getTableObj()->openStock($openStockDto);
            }
            if($i){
            $this->response->body(1);
        }}
    }
    
    public function saveCloseStock() {
        \Cake\Log\Log::debug('Request hitted');
       $this->autoRender = FALSE;
       $restaurantId = $this->readCookie('cri');
        if($this->request->is('post')){
            $itemId = $this->request->data('item');
            $stock = $this->request->data('stock');
            $unit = $this->request->data('unit');
            for($i = 0; $i < count($itemId); $i++){
                $openStockDto = new UploadDTO\OpenStockUploadDto(
                        $itemId[$i], $stock[$i], date('d'), date('m'), 
                        date('Y'), $unit[$i],$restaurantId);
                $this->getTableObj()->closeStock($openStockDto);
            }
            if($i){
            $this->response->body(1);
        }}
    }
    
}
