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
/**
 * Description of TransactionMasterController
 *
 * @author niteen
 */
class TransactionMasterController extends ApiController{
    
     private $bar_chart_default_values = [
                    "xAxisName" => "Payment Mode",
                    "yAxisName" => "Amount (In Rupee)",
                    "numberPrefix" => "₹",
                    "paletteColors" => "#0075c2",
                    "bgColor" => "#ffffff",
                    "borderAlpha" => "20",
                    "canvasBorderAlpha" => "0",
                    "usePlotGradientColor" => "1",
                    "plotBorderAlpha" => "10",
                    "placevaluesInside" => "1",
                    "rotatevalues" => "1",
                    "valueFontColor" =>"#ffffff",                
                    "showXAxisLine" =>"1",
                    "xAxisLineColor" =>"#999999",
                    "divlineColor" => "#999999",               
                    "divLineIsDashed" => "1",
                    "showAlternateHGridColor" => "1",
                    "subcaptionFontBold" => "0",
                    "subcaptionFontSize" => "14"];
   
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
        $transactionDetailsController = new TransactionDetailsController();
        $reportData = $transactionDetailsController->generateReport($restaurantId);
        $stdObj = new \stdClass();
        foreach ($this->bar_chart_default_values as $key => $value){
        $stdObj->$key = $value;    
        }
        $salesMainDto = new DownloadDTO\SalesMainDto($stdObj, $reportData);
        $chartData = json_encode($salesMainDto);
        \Cake\Log\Log::debug('Transaction data :-'.$chartData);
        $this->response->type('text/plain');
        $this->response->body($chartData);
    }
    
}
