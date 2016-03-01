<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controller;
use App\Model\Table;
use App\DTO\DownloadDTO;
/**
 * Description of SalesHistoryController
 *
 * @author niteen
 */
class SalesHistoryController extends ApiController{
    
    private $month = ['01' => 'Jan',
                      '02' => 'Feb',
                      '03' => 'Mar'];
    private function getTableObj() {
        return new Table\SalesHistoryTable();
    }
    public function makeSalesReportEntry($salesHistoryDto) {
        $result = false;
        if(count($salesHistoryDto)){
            $present = $this->getTableObj()->isEntryPresent($salesHistoryDto);
            if($present){
                $result = $this->getTableObj()->update($salesHistoryDto);
            }  else {
                $result = $this->getTableObj()->insert($salesHistoryDto);
            }
        }
        return $result;
    }
    
    public function getReport() {
        $this->autoRender = false;
        $restaurantId = $this->request->query('id');
        
        $salesReportData = $this->getTableObj()->getdata($restaurantId);
        $data[] = null; $ind = 0;
        foreach ($salesReportData as $resport){
            $data[$ind++] = new DownloadDTO\SalesHistoryDataDto($this->month[$resport->month], $resport->billTotalAmt);
            
        }
        $result = json_encode($data);
        \Cake\Log\Log::debug($result);
        $data1 = '{"chart": {'.BAR_CHART_SETTING.'},            
                    "data": '.$result.'}';
        $this->response->type('text/plain');
        $this->response->body($data1);
    }
}
