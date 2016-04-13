<?php
    use Cake\Cache\Cache;
    use Cake\Core\Configure;
    use Cake\Datasource\ConnectionManager;
    use Cake\Error\Debugger;
    use Cake\Network\Exception\NotFoundException;
    use App\Controller;

    $this->layout = false;
     $this->layout = 'rorder_layout';
     $this->assign('title', 'Restaurant Reports');
     //$this->start('content');
?> 
<section class="content content-div show-rest-section">
                                    <div class="row">
                                        <!--Destination Form -->
                                        <div class="with-border box-header">
                                            <h3 class="box-title">Report Statistics &nbsp;&nbsp;<b id="restaurant-nm"> </b></h3>
                                            <h3 class="mgmt-date">As on date &nbsp;&nbsp; <b><?php echo date('d M Y');?></b></h3>
                                       
                                        </div><!-- /.box-header -->
                                    </div>
                                    <div class="view-statistics" style="">
                                        <div class="sales-history" style="padding-left:10% ">
                                            <h5><b>Monthly Sales Report</b> <span id="report-duration"> </span></h5>
                                            <div id="sales-history-graph">   
                                            </div>   
                                        </div>
                                        <hr>
                                        <div class="customer-visit" style="padding-left:10% ">
                                            <h5><b>Monthly Rush Hour Report</b> <span id="report-month"> </span></h5>
                                            <div id="customer-visit-graph">   
                                            </div>
                                        </div> 
                                        <hr>
                                        <div class="transaction-report" style="padding-left:10% ">
                                            <h5><b>Monthly Transaction  Report</b></h5>
                                            <div id="transaction-graph">   
                                            </div>   
                                        </div>
                                        <hr>
                                        <div class="inventry-report" style="padding-left:10% ">
                                            <h5><b>Inventory</b> <span id="report-month"> </span></h5>
                                            <div id="inventory-graph">   
                                            </div>
                                        </div>  
                                    </div>
                                </section>
        <?= $this->Html->script('fusioncharts.js') ?> 
        <?= $this->Html->script('fusioncharts.theme.fint.js') ?> 
        <script type="text/javascript">
                FusionCharts.ready(function () {
                    $.ajax({
                        url: "/salesreport?id=" + '<?= $rest ?>',
                        type: "POST",
                        // data: {id: restId},
                        contentType: false,
                        cache: false,
                        processData: false,
                        success: function (result, jqXHR, textStatus) {
                            if (result) {
                                var revenueChart = new FusionCharts({
                                    type: 'column2d',
                                    renderAt: 'sales-history-graph',
                                    width: '750',
                                    height: '350',
                                    dataFormat: 'json',
                                    dataSource: result}).render();
                            } else {
                                alert('Error..!Please contact on info@vibeosys.com');
                            }
                        },
                        error: function (jqXHR, textStatus, errorThrown) {
                            alert('An error occurred! ' + textStatus + jqXHR + errorThrown);
                        }});
                    //
                    $.ajax({
                        url: "/customervisitreport?id=" + '<?= $rest ?>',
                        type: "POST",
                        contentType: false,
                        cache: false,
                        processData: false,
                        success: function (result, jqXHR, textStatus) {
                            if (result) {
                                var revenueChart = new FusionCharts({
                                    type: 'Doughnut2d',
                                    renderAt: 'customer-visit-graph',
                                    width: '750',
                                    height: '350',
                                    dataFormat: 'json',
                                    dataSource: result}).render();
                            } else {
                                alert('Error..!Please contact on info@vibeosys.com');
                            }
                        },
                        error: function (jqXHR, textStatus, errorThrown) {
                            alert('An error occurred! ' + textStatus + jqXHR + errorThrown);
                        }});
                    //graph for transaction report
                     $.ajax({
                        url: "/transactionMaster/getTransactionReport?id=" + '<?= $rest ?>',
                        type: "POST",
                        // data: {id: restId},
                        contentType: false,
                        cache: false,
                        processData: false,
                        success: function (result, jqXHR, textStatus) {
                            if (result) {
                                var revenueChart = new FusionCharts({
                                    type: 'column2d',
                                    renderAt: 'transaction-graph',
                                    width: '750',
                                    height: '350',
                                    dataFormat: 'json',
                                    dataSource: result}).render();
                            } else {
                                alert('Error..!Please contact on info@vibeosys.com');
                            }
                        },
                        error: function (jqXHR, textStatus, errorThrown) {
                            alert('An error occurred! ' + textStatus + jqXHR + errorThrown);
                        }});
        /*graph for transaction report
        
         var revenueChart = new FusionCharts({
        type: 'column2d',
        renderAt: 'transaction-graph',
        width: '550',
        height: '350',
        dataFormat: 'json',
        dataSource: {
            "chart": {
               
                "xAxisName": "Payment Mode",
                "yAxisName": "Amount (In RUPEE)",
                "numberPrefix": "₹",
                "paletteColors": "#0075c2",
                "bgColor": "#ffffff",
                "borderAlpha": "20",
                "canvasBorderAlpha": "0",
                "usePlotGradientColor": "0",
                "plotBorderAlpha": "10",
                "placevaluesInside": "1",
                "rotatevalues": "1",
                "valueFontColor": "#ffffff",                
                "showXAxisLine": "1",
                "xAxisLineColor": "#999999",
                "divlineColor": "#999999",               
                "divLineIsDashed": "1",
                "showAlternateHGridColor": "0",
                "subcaptionFontBold": "0",
                "subcaptionFontSize": "14"
            },            
            "data": [
                {
                    "label": "Credit card",
                    "value": "20000",
                    "color":"#cc0066"
                }, 
                {
                    "label": "Debit card",
                    "value": "12000",
                    "color":"#ff9933"
                }, 
                {
                    "label": "Cash",
                    "value": "23000",
                    "color":"#9933ff"
                }, 
                {
                    "label": "Online payment",
                    "value": "6800",
                    "color":"#009999"
                }]
        }
    }).render();
        
       */ 
        //graph for inventory
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
        
   
