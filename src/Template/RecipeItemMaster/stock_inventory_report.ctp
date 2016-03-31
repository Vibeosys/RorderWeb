<?php
    use Cake\Cache\Cache;
    use Cake\Core\Configure;
    use Cake\Datasource\ConnectionManager;
    use Cake\Error\Debugger;
    use Cake\Network\Exception\NotFoundException;
    use App\Controller;

    $this->layout = false;
     $this->layout = 'rorder_inventory_layout';
     $this->assign('title', 'Restaurant Stock Upload');
     $this->assign('breadcrum', ' <ol class="breadcrumb">
                    <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active">Material Stock Upload</li>
                </ol>');
     //$this->start('content');
?>
            <section class="content">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box">                           
                            <section class="content content-div show-add-section">
                                <div class="back-btn" style="margin-top: 10px"> 
                                   <a href="../inventory" > << Back </a>
                                </div>
                              
                                <section class="stock-section" id="msu" style="margin-top:50px">
                                   <div class="view-stock-inventory" style="">
                                       <div class="row">
                                        <div class="material-in-kg col-lg-6 graph-outer" style="padding-left:10% ">
                                            <div class="graph-head"><b>Material In Kg or Grams</b><a  onclick="alert('Work In Progress')"  >Download</a></div>
                                            <div class="graph-inner" id="kg-graph">   
                                            </div>   
                                        </div>
                                        
                                        <div class="material-in-litre col-lg-6 graph-outer" style="padding-left:10% ">
                                            <div class="graph-head"><b>Material In Litre or Mili Litre</b><a  onclick="alert('Work In Progress')"  >Download</a></div>
                                            <div class="graph-inner" id="litre-graph">   
                                            </div>
                                        </div>
                                       </div>    
                                        <hr>
                                          <div class="row">
                                        <div class="material-in-unit col-lg-6 graph-outer" style="padding-left:10% ">
                                            <div class="graph-head"><b>Material In Units</b><a  onclick="alert('Work In Progress')"  >Download</a></div>
                                            <div class="graph-inner" id="unit-graph">   
                                            </div>   
                                        </div>
                                          </div>
                                    </div>  
                                </section>
                            </section>
                        </div><!-- /.box -->                       
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </section><!-- /.content -->
            
             <script type="text/javascript">
             
                 //material in kg
             FusionCharts.ready(function () {     
                  var topStores = new FusionCharts({
                     type: 'bar2d',
                     renderAt: 'kg-graph',
                     width: '400',
                     height: '300',
                     dataFormat: 'json',
                     dataSource: {
                       "chart": {
                "yAxisName": "Availability (In KG)",
                "numberPrefix": "",
                "paletteColors": "#0075c2",
                "bgColor": "#ffffff",
                "showBorder": "0",
                "showCanvasBorder": "0",
                "usePlotGradientColor": "0",
                "plotBorderAlpha": "10",
                "placeValuesInside": "1",
                "valueFontColor": "#ffffff",
                "showAxisLines": "1",
                "axisLineAlpha": "25",
                "divLineAlpha": "10",
                "alignCaptionWithCanvas": "0",
                "showAlternateVGridColor": "0",
                "captionFontSize": "14",
                "subcaptionFontSize": "14",
                "subcaptionFontBold": "0",
                "toolTipColor": "#ffffff",
                "toolTipBorderThickness": "0",
                "toolTipBgColor": "#000000",
                "toolTipBgAlpha": "80",
                "toolTipBorderRadius": "2",
                "toolTipPadding": "5"
            },
            
            "data": [
                {
                    "label": "Paneer",
                    "value": "50KG",
                    "color":"#009999"
                }, 
                {
                    "label": "Dalchini",
                    "value": "5",
                    "color":"#9933ff"
                }, 
                {
                    "label": "WheatFlower",
                    "value": "150",
                    "color":"#990033"
                }
            ]
        }
    })
    .render();
             //material in Litre
                 
                  var topStores = new FusionCharts({
                     type: 'bar2d',
                     renderAt: 'litre-graph',
                     width: '400',
                     height: '300',
                     dataFormat: 'json',
                     dataSource: {
                       "chart": {
                "yAxisName": "Availability (In Litre)",
                "numberPrefix": "",
                "paletteColors": "#0075c2",
                "bgColor": "#ffffff",
                "showBorder": "0",
                "showCanvasBorder": "0",
                "usePlotGradientColor": "0",
                "plotBorderAlpha": "10",
                "placeValuesInside": "1",
                "valueFontColor": "#ffffff",
                "showAxisLines": "1",
                "axisLineAlpha": "25",
                "divLineAlpha": "10",
                "alignCaptionWithCanvas": "0",
                "showAlternateVGridColor": "0",
                "captionFontSize": "14",
                "subcaptionFontSize": "14",
                "subcaptionFontBold": "0",
                "toolTipColor": "#ffffff",
                "toolTipBorderThickness": "0",
                "toolTipBgColor": "#000000",
                "toolTipBgAlpha": "80",
                "toolTipBorderRadius": "2",
                "toolTipPadding": "5"
            },
            
            "data": [
                {
                    "label": "Milk",
                    "value": "73",
                    "color":"#cc0066"
                }, 
                {
                    "label": "Oil",
                    "value": "100",
                     "color":"#ff9933"
                },
                {
                    "label": "Sauce",
                    "value": "10",
                     "color":"#cc0066"
                }
            ]
        }
    })
    .render();
                 //material in units
                 
                  var topStores = new FusionCharts({
                     type: 'bar2d',
                     renderAt: 'unit-graph',
                     width: '400',
                     height: '300',
                     dataFormat: 'json',
                     dataSource: {
                       "chart": {
                "yAxisName": "Availability (In Unit)",
                "numberPrefix": "",
                "paletteColors": "#0075c2",
                "bgColor": "#ffffff",
                "showBorder": "0",
                "showCanvasBorder": "0",
                "usePlotGradientColor": "0",
                "plotBorderAlpha": "10",
                "placeValuesInside": "1",
                "valueFontColor": "#ffffff",
                "showAxisLines": "1",
                "axisLineAlpha": "25",
                "divLineAlpha": "10",
                "alignCaptionWithCanvas": "0",
                "showAlternateVGridColor": "0",
                "captionFontSize": "14",
                "subcaptionFontSize": "14",
                "subcaptionFontBold": "0",
                "toolTipColor": "#ffffff",
                "toolTipBorderThickness": "0",
                "toolTipBgColor": "#000000",
                "toolTipBgAlpha": "80",
                "toolTipBorderRadius": "2",
                "toolTipPadding": "5"
            },
            
            "data": [
                {
                    "label": "Tomato",
                    "value": "100",
                    "color":"#009999"
                }, 
                {
                    "label": "Chicken",
                    "value": "30",
                    "color":"#cc0066"
                }, 
                {
                    "label": "Fish",
                    "value": "20",
                    "color":"#9933ff"
                },
                {
                    "label": "Cashew",
                    "value": "200",
                    "color":"#990033"
                }
            ]
        }
    })
    .render();    
    
             });
             </script>