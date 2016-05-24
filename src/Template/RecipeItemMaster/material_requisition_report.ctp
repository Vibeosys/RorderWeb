<?php
    use Cake\Cache\Cache;
    use Cake\Core\Configure;
    use Cake\Datasource\ConnectionManager;
    use Cake\Error\Debugger;
    use Cake\Network\Exception\NotFoundException;
    use App\Controller;

     $this->layout = 'rorder_layout';
     $this->assign('title', 'Restaurant Material Requisition Report');
     
?>    
     
<?php $this->start('breadcrum');?>

                            <li class="active">Material Requisition</li>
<?php $this->end('breadcrum'); ?>
  <?php $this->start('layout_change');?> 
 <?php $this->end('layout_change'); ?>
<div class="row">
              
                  <div class="col-md-6 col-sm-6 col-xs-12" id="mrr">
                    <div class="x_panel">
                      <div class="x_title">
                        <h2>Material Requisition In Gm and Kg<small></small></h2>
                       <ul class="nav navbar-right panel_toolbox">
                    <li><a href="#"><i class="fa fa-download"></i> Download</a>
                    </li>
                  </ul>
                        <div class="clearfix"></div>
                      </div>
                        <div  class="x_content ct-chart" id="chartContainer" >
                    

                      </div>
                    </div>
                  </div>
              
              
                            
       <div class="col-md-6 col-sm-6 col-xs-12" id="mbrr">
                    <div class="x_panel">
                      <div class="x_title">
                        <h2>Material Requisition In Ml and Ltr<small></small></h2>
                       <ul class="nav navbar-right panel_toolbox">
                    <li><a href="#"><i class="fa fa-download"></i> Download</a>
                    </li>
                  </ul>
                        <div class="clearfix"></div>
                      </div>
                      <div class="x_content ct-chart" id="lchartContainer">
                      

                      </div>
                    </div>
                  </div>
          </div>
 <?php $this->start('script'); ?>  
 <script type="text/javascript">
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
        </script>
  <?php $this->end('script'); ?>