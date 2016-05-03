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
use App\DTO;
use Cake\Log\Log;
/**
 * Description of TransactionMasterController
 *
 * @author niteen
 */
class TransactionMasterController extends ApiController{
    
    private function getTableObj() {
        return new Table\TransactionMasterTable();
    }
    
    public function createTransactionReport($paymentModeId, $amount, $restaurantId) {
        $request = new UploadDTO\TransactionMasterInsertDto($restaurantId, date('d'), date('m'), date('Y'), $amount);
        $result = $this->saveReport($request);
        if($result){
            $detailsRequest = new UploadDTO\TransactionDetailsInsertDto($paymentModeId, $amount, $result);
            $transactionDetailsController = new TransactionDetailsController();
            return $transactionDetailsController->saveReport($detailsRequest);
        }
        return FALSE;
    }
    
    public function saveReport($request) {
        $result = $this->getTableObj()->getTransactionId($request);
        if($result){
         $response = $this->getTableObj()->update($request, $result);
        }  else {
        $response = $this->getTableObj()->insert($request);    
        }
        return $response;
    }
    
    public function getTransactionReport() {
        $this->autoRender = FALSE;
        $restaurantId = $this->request->query('id');
        if($this->request->is('post')){
            Log::debug('Thiis request is post');
        }
        $transactionDetailsController = new TransactionDetailsController();
        $reportData = $transactionDetailsController->generateReport($restaurantId);
        $chartData = json_encode($reportData);
        $this->response->body($chartData);
    }
    
    public function transactionReport() {
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
