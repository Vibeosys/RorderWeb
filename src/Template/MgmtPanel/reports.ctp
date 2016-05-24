<?php

use Cake\Cache\Cache;
    use Cake\Core\Configure;
    use Cake\Datasource\ConnectionManager;
    use Cake\Error\Debugger;
    use Cake\Network\Exception\NotFoundException;
    use App\Controller;

     $this->layout = 'rorder_layout';
     $this->assign('title', 'Restaurant Reports');
     //$this->start('content');
?>
<?php $this->start('b_yes');?>    
<?php $this->end('b_yes');?>    
 <?php $this->start('layout_change');?> 
 <?php $this->end('layout_change'); ?>
  
              
       <div class="col-md-6 col-sm-6 col-xs-12" id="shr">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Sales History <small>monthly</small></h2>
                  <ul class="nav navbar-right panel_toolbox">
                    <li><a href="#"><i class="fa fa-download"></i> Download</a>
                    </li>
                  </ul>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                      <div id="error-sh" align="center"> </div>
                  <canvas id="sales-history-graph"></canvas>
                </div>
              </div>
            </div>

           <div class="col-md-6 col-sm-6 col-xs-12" id="tr">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Transaction<small>Daily</small></h2>
                  <ul class="nav navbar-right panel_toolbox">
                    <li><a href="#"><i class="fa fa-download"></i> Download</a>
                    </li>
                  </ul>
                  <div class="clearfix"></div>
                </div>
                  <div class="x_content" style="height: 318px">
                    <div id="error-t" align="center"> </div>
                  <canvas id="transaction_graph"></canvas>
                  
                </div>
              </div>
            </div>     
              
       <div class="col-md-6 col-sm-6 col-xs-12" id="rhr">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Rush Hour <small>Daily</small></h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a href="#"><i class="fa fa-download"></i> Download</a>
                    </li>
                  </ul>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                     <div id="graph_donut" style="height: 316px; width: 100%;"></div>
                  
                </div>
              </div>
            </div>
     
                
              
     
              
              
      
       <div class="col-md-6 col-sm-6 col-xs-12" id="mrr">
                    <div class="x_panel">
                      <div class="x_title">
                        <h2>Material Requisition In Gm and Kg <small>current</small></h2>
                       <ul class="nav navbar-right panel_toolbox">
                    <li><a href="#"><i class="fa fa-download"></i> Download</a>
                    </li>
                  </ul>
                        <div class="clearfix"></div>
                      </div>
                        <div  class="x_content ct-chart" id="chartContainer" style="height: 316px;" >
                    

                      </div>
                    </div>
                  </div>
              
              
                            
       <div class="col-md-6 col-sm-6 col-xs-12" id="mbrr">
                    <div class="x_panel">
                      <div class="x_title">
                        <h2>Material Requisition In Ml and Ltr<small>current</small></h2>
                       <ul class="nav navbar-right panel_toolbox">
                    <li><a href="#"><i class="fa fa-download"></i> Download</a>
                    </li>
                  </ul>
                        <div class="clearfix"></div>
                      </div>
                      <div class="x_content ct-chart" id="lchartContainer" style="height: 316px;">
                      

                      </div>
                    </div>
                  </div>
        
   <!-- Chart script -->
<?php $this->start('script');?>    
  <script>
   

    // sales history
     $.ajax({
                        url: "/salesreport?id=" + '<?= $rest ?>',
                        type: "POST",
                        // data: {id: restId},
                        contentType: false,
                        cache: false,
                        processData: false,
                        success: function (result, jqXHR, textStatus) {
                            if (result) {
                                var labels = new Array();
                                var value = new Array();
                                $.each(result,function(key, obj){
                                    labels.push(obj.label);
                                    value.push(obj.value);
                                });
                               var ctx = document.getElementById("sales-history-graph");
                                var mybarChart = new Chart(ctx, {
                                 type: 'bar',
                                 xAxisID:'Month',
                                 yAxisID:'Amount',

                            data: {
                                labels: labels,
                            datasets: [{
                            label: 'Amount',
                            backgroundColor: "#26B99A",
                            data: value
                            }]
                            },

                            options: {
                                scales: {
                            yAxes: [{
                             ticks: {
                                 beginAtZero: true
                                 
                                     }
                                    }]
                                }
                                }
                                });
                              
                            } else {
                                 $.post('/chartnotfound',{},function(result){
                                    $('#error-sh').html(result);
                                });     
                            }
                        },
                        error: function (jqXHR, textStatus, errorThrown) {
                                     $.post('/chartnotfound',{},function(result){
                                    $('#error-sh').html(result);
                                }); 
                        }});
   
      
       // transaction reports
         $.ajax({
                        url: "/transactionMaster/getTransactionReport?id=" + '<?= $rest ?>',
                        type: "POST",
                        // data: {id: restId},
                        contentType: false,
                        cache: false,
                        processData: false,
                        success: function (result, jqXHR, textStatus) {
                            if (result) {
                                 var labels = new Array();
                                var value = new Array();
                                $.each(result,function(key, obj){
                                    labels.push(obj.label);
                                    value.push(obj.value);
                                });
                                
                             var ctx = document.getElementById("transaction_graph");
                                    var mybarChart = new Chart(ctx, {
                                      type: 'bar',
                                      data: {
                                        labels: labels,
                                        datasets: [{
                                          label: 'Amount',
                                          backgroundColor: "#9B59B6",
                                          data: value
                                        }]
                                      },

                                      options: {
                                        scales: {
                                          yAxes: [{
                                            ticks: {
                                              beginAtZero: true
                                            }
                                          }]
                                        }
                                      }
                                    });
                            } else {
                                    $.post('/chartnotfound',{},function(result){
                                    $('#error-t').html(result);
                                });       
                            }
                        },
                        error: function (jqXHR, textStatus, errorThrown) {
                                     $.post('/chartnotfound',{},function(result){
                                    $('#error-t').html(result);
                                });  
                        }});
    
      
     
    // Doughnut chart
    //canvas chart requisition report ajax/materialrequisitionreport
    
  
            $.ajax({
                        url: "/ajax/materialrequisitionreport?type=1",
                        type: "POST",
                        contentType: false,
                        cache: false,
                        processData: false,
                        success: function (result, jqXHR, textStatus) {
                            
                            if (result) {
                                var label = new Array();
                                var series1 = new Array();
                                var series2 = new Array();
                                var items = 1;
                                $.each(result, function(key, obj){
                                    label.push(obj.itemName);
                                    var l = parseInt(obj.rLevel);
                                    series1.push(l);
                                    var s = parseInt(obj.qty);
                                    series2.push(s);
                                    items++;
                                });
                                var num = items*20;
                                var ht = Math.max(num, 400); 
                                $('#chartContainer').css('height',ht +'px');
                                 $('#chartContainer').highcharts({
                                        chart: {type: 'bar'},
                                        title: {text: ''},
                                        subtitle: {text: ''},
                                       xAxis: {categories: label,
                                       title: {text: null}},
                                       yAxis: { min: 0,
                                       title: {
                                       text: 'Available Stock (millions)',
                                       align: 'high'
                                    },
                                    labels: {
                                        overflow: 'justify'
                                    }
                                },
                                tooltip: {
                                    valueSuffix: ' '
                                },
                                plotOptions: {
                                    bar: {
                                        dataLabels: {
                                            enabled: true
                                        }
                                    }
                                },
                                legend: {
                                    layout: 'vertical',
                                    align: 'right',
                                    verticalAlign: 'top',
                                    x: -40,
                                    y: 80,
                                    floating: true,
                                    borderWidth: 1,
                                    backgroundColor: ((Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'),
                                    shadow: true
                                },
                                credits: {
                                    enabled: false
                                },
                                series: [{
                                    name: 'Reorder Level',
                                    data: series1
                                }, {
                                    name: 'Stock',
                                    data: series2
                                }]
                            });
                            } else {
                                  $.post('/chartnotfound',{},function(result){
                                    $('#chartContainer').html(result);
                                });  
                            }
                        },
                        error: function (jqXHR, textStatus, errorThrown) {
                                  $.post('/chartnotfound',{},function(result){
                                    $('#chartContainer').html(result);
                                }); 
                        }});
                    
                    // liquid
                    $.ajax({
                        url: "/ajax/materialrequisitionreport?type=2",
                        type: "POST",
                        contentType: false,
                        cache: false,
                        processData: false,
                        success: function (result, jqXHR, textStatus) {
                            
                            if (result) {
                                var label = new Array();
                                var series1 = new Array();
                                var series2 = new Array();
                                var items = 1;
                                $.each(result, function(key, obj){
                                    label.push(obj.itemName);
                                    var l = parseInt(obj.rLevel);
                                    series1.push(l);
                                    var s = parseInt(obj.qty);
                                    series2.push(s);
                                    items++;
                                });
                                var num = items*20;
                                var ht = Math.max(num, 400); 
                                $('#lchartContainer').css('height',ht +'px');
                                 $('#lchartContainer').highcharts({
                                        chart: {type: 'bar'},
                                        title: {text: ''},
                                        subtitle: {text: ''},
                                       xAxis: {categories: label,
                                       title: {text: null}},
                                       yAxis: { min: 0,
                                       title: {
                                       text: 'Available Stock (millions)',
                                       align: 'high'
                                    },
                                    labels: {
                                        overflow: 'justify'
                                    }
                                },
                                tooltip: {
                                    valueSuffix: ' '
                                },
                                plotOptions: {
                                    bar: {
                                        dataLabels: {
                                            enabled: true
                                        }
                                    }
                                },
                                legend: {
                                    layout: 'vertical',
                                    align: 'right',
                                    verticalAlign: 'top',
                                    x: -40,
                                    y: 80,
                                    floating: true,
                                    borderWidth: 1,
                                    backgroundColor: ((Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'),
                                    shadow: true
                                },
                                credits: {
                                    enabled: false
                                },
                                series: [{
                                    name: 'Reorder Level',
                                    data: series1
                                }, {
                                    name: 'Stock',
                                    data: series2
                                }]
                            });
                            } else {
                                $.post('/chartnotfound',{},function(result){
                                    $('#lchartContainer').html(result);
                                });
                                    // $('#rhr').hide();  
                            }
                        },
                        error: function (jqXHR, textStatus, errorThrown) {
                            $.post('/chartnotfound',{},function(result){
                                    $('#lchartContainer').html(result);
                                });                
                        }});
                    
                    
//customer visit
    $.ajax({
                        url: "/customervisitreport?id=" + ' <?= $rest ?>',
                        type: "POST",
                        contentType: false,
                        cache: false,
                        processData: false,
                        success: function (result, jqXHR, textStatus) {
                            if (result) {
                                var chart = new CanvasJS.Chart("graph_donut",
                                {
                                        title:{
                                                text: ""
                                        },
                                        exportFileName: "Pie Chart",
                                        exportEnabled: true,
                                        animationEnabled: true,
                                        legend:{
                                                verticalAlign: "bottom",
                                                horizontalAlign: "center"
                                        },
                                        data: [
                                        {       
                                                type: "pie",
                                                showInLegend: true,
                                                toolTipContent: "{legendText}: <strong>{y}%</strong>",
                                                indexLabel: "{label} {y}%",
                                                dataPoints: result
                                }
                                ]
                                });
                                chart.render();
                            } else {
                                $.post('/chartnotfound',{},function(result){
                                    $('#graph_donut').html(result);
                                });
                            }
                        },
                        error: function (jqXHR, textStatus, errorThrown) {
                                 $.post('/chartnotfound',{},function(result){
                                    $('#graph_donut').html(result);
                                }); 
                        }});
                        
                                      
    </script>        
        <?php $this->end('script'); ?>

