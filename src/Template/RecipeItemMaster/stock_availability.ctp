<?php
    use Cake\Cache\Cache;
    use Cake\Core\Configure;
    use Cake\Datasource\ConnectionManager;
    use Cake\Error\Debugger;
    use Cake\Network\Exception\NotFoundException;
    use App\Controller;

    if(isset($limit)){
     $this->layout = 'rorder_layout';
     $this->assign('title', 'Restaurant Stock Availability');
    
     //$this->start('content');
?>          
             <section class="content-header">
            <h1>
                  Restaurant Stock Availability
            </h1>
            <ol class="breadcrumb">
                    <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active">Stock Availability</li>
                </ol>
            </section>
            <section class="content">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box">                           
                            <section class="content content-div show-add-section">
                                <div class="back-btn" style="margin-top: 10px"> 
                                </div>
                              
                                <section class="stock-section" id="msu" style="margin-top:50px">
                                   <div class="material-requisition" style="">
                                     <?php } ?>  
                                       <div class="graph-head">Stock Availability <a  onclick="alert('Work In Progress')">Download</a></div> 
                                        <div class="inventry-report" style="padding-left:10% ">
                                            <div id="inventory-graph">   
                                            </div>
                                        </div>
                                       <?php if(isset($limit)){ ?>
                                    </div>  
                                </section>
                            </section>
                        </div>       
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </section><!-- /.content -->
                                       
   <?= $this->Html->script('fusioncharts.js') ?> 
        <?= $this->Html->script('fusioncharts.theme.fint.js') ?> 
                                       <?php }  ?>
            <script>
            FusionCharts.ready(function () {
                var topStores = new FusionCharts({
        type: 'bar2d',
        renderAt: 'inventory-graph',
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
                    "label": "Milk",
                    "value": "73",
                    "color":"#cc0066"
                }, 
                {
                    "label": "Dalchini",
                    "value": "5",
                    "color":"#9933ff"
                }, 
                {
                    "label": "Oil",
                    "value": "100",
                     "color":"#ff9933"
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
            });
            </script>
           