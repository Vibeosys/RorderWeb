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
                      '03' => 'Mar',
                      '04' => 'Apr',
                      '05' => 'May',
                      '06' => 'Jun',
                      '07' => 'Jul',
                      '08' => 'Aug',
                      '09' => 'Sep',
                      '10' => 'Oct',
                      '11' => 'Nov',
                      '12' => 'Dec'];
    
   private $bar_chart_default_values = ["caption" => "Monthly sales history for last year",
                    "subCaption" => "Restaurant Name",
                    "xAxisName" => "Month",
                    "yAxisName" => "sales (In Rupee)",
                    "numberPrefix" => "₹",
                    "paletteColors" => "#0075c2",
                    "bgColor" => "#ffffff",
                    "borderAlpha" => "20",
                    "canvasBorderAlpha" => "0",
                    "usePlotGradientColor" => "0",
                    "plotBorderAlpha" => "10",
                    "placevaluesInside" => "1",
                    "rotatevalues" => "1",
                    "valueFontColor" =>"#ffffff",                
                    "showXAxisLine" =>"1",
                    "xAxisLineColor" =>"#999999",
                    "divlineColor" => "#999999",               
                    "divLineIsDashed" => "1",
                    "showAlternateHGridColor" => "0",
                    "subcaptionFontBold" => "0",
                    "subcaptionFontSize" => "14"];
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
        $restaurantController = new RestaurantController();
        $restaurantDetails = $restaurantController->getRestaurant($restaurantId);
        $this->bar_chart_default_values['subCaption'] = $restaurantDetails->title;
        $stdObj = new \stdClass();
        foreach ($this->bar_chart_default_values as $key => $value){
        $stdObj->$key = $value;    
        }
        $salesMainDto = new DownloadDTO\SalesMainDto($stdObj, $data);
        $chartData = json_encode($salesMainDto);
        $this->response->type('text/plain');
        $this->response->body($chartData);
    }
}
