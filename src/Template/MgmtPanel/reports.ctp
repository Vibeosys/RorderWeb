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

   <div class="row">
              
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
                <div class="x_content">
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
                        <h2> Solid Material Requisition <small>current</small></h2>
                       <ul class="nav navbar-right panel_toolbox">
                    <li><a href="#"><i class="fa fa-download"></i> Download</a>
                    </li>
                  </ul>
                        <div class="clearfix"></div>
                      </div>
                        <div class="x_content" id="chartContainer" style="height: 316px; width: 100%;">
                    

                      </div>
                    </div>
                  </div>
              
              
                            
       <div class="col-md-6 col-sm-6 col-xs-12" id="mbrr">
                    <div class="x_panel">
                      <div class="x_title">
                        <h2>Liquid Material Requisition<small>current</small></h2>
                       <ul class="nav navbar-right panel_toolbox">
                    <li><a href="#"><i class="fa fa-download"></i> Download</a>
                    </li>
                  </ul>
                        <div class="clearfix"></div>
                      </div>
                      <div class="x_content" id="lchartContainer" style="height: 316px; width: 100%;">
                      

                      </div>
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
                                
                                    $('#shr').hide();      
                            }
                        },
                        error: function (jqXHR, textStatus, errorThrown) {
                                     $('#shr').hide();   
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
                                    $('#tr').hide();      
                            }
                        },
                        error: function (jqXHR, textStatus, errorThrown) {
                                     $('#tr').hide();  
                        }});
    
      
     
    // Doughnut chart
    //canvas chart requisition report ajax/materialrequisitionreport
    
  
  $.ajax({
                        url: "/ajax/materialrequisitionreport?id=" + ' <?= $rest ?>',
                        type: "POST",
                        contentType: false,
                        cache: false,
                        processData: false,
                        success: function (result, jqXHR, textStatus) {
                            if (result) {
                                  var chart = new CanvasJS.Chart("chartContainer",
    {
      title:{
        text: ""    
      },
      axisY2: {
        title:"Recipe Items"
      },
      animationEnabled: true,
      axisY: {
        title: "Quanity"
      },
      axisX :{
        labelFontSize: 12
      },
      legend: {
        verticalAlign: "bottom"
      },
      data: result,
      legend: {
        cursor:"pointer",
        itemclick : function(e){
          if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
            e.dataSeries.visible = false;
          }
          else{
            e.dataSeries.visible = true;
          }
          chart.render();
        }
      }
    });

chart.render();
                              
                            } else {
                                
                                     $('#rhr').hide();  
                            }
                        },
                        error: function (jqXHR, textStatus, errorThrown) {
                                $('#rhr').hide();  
                        }});

// liquid
     var chart = new CanvasJS.Chart("lchartContainer",
    {
      title:{
        text: ""    
      },
      axisY2: {
        title:"Recipe Items"
      },
      animationEnabled: true,
      axisY: {
        title: "Quanity"
      },
      axisX :{
        labelFontSize: 10
      },
      legend: {
        verticalAlign: "bottom"
      },
      data: [

      {        
        type: "bar",  
        isYType: "primary",
        showInLegend: true, 
        legendText: "current stock",
        dataPoints: [      
        { x: 10, y:112, label: "Paneer" },
        { x: 20, y:102, label: "Onion"},
        { x: 30, y:302 , label: "Sugar"},
        { x: 40, y:423 , label: "Potato"},
        { x: 50, y:407 , label: "Tomato"},
        { x: 60, y:359, label: "Salt"},
        { x: 70, y:308, label:"Chicken"},
        { x: 80, y:245, label:"Garlic Powder "},
          { x: 90, y:112, label: "1Paneer" },
        { x: 100, y:102, label: "1Onion"},
        { x: 110, y:302 , label: "1Sugar"},
        { x: 120, y:423 , label: "1Potato"},
        { x: 130, y:407 , label: "1Tomato"},
        { x: 140, y:359, label: "1Salt"},
        { x: 150, y:308, label:"1Chicken"},
        { x: 160, y:245, label:"1Garlic Powder "},
          { x: 170, y:112, label: "2Paneer" }
        


        ]
      },
      {        
        type: "bar",  
        isYType: "primary",
        showInLegend: true,
        legendText: "reorder level",
        dataPoints: [      
        { x: 10, y:112, label: "Paneer" },
        { x: 20, y:102, label: "Onion"},
        { x: 30, y:302 , label: "Sugar"},
        { x: 40, y:423 , label: "Potato"},
        { x: 50, y:407 , label: "Tomato"},
        { x: 60, y:359, label: "Salt"},
        { x: 70, y:308, label:"Chicken"},
        { x: 80, y:245, label:"Garlic Powder "},
          { x: 90, y:112, label: "1Paneer" },
        { x: 100, y:102, label: "1Onion"},
        { x: 110, y:302 , label: "1Sugar"},
        { x: 120, y:423 , label: "1Potato"},
        { x: 130, y:407 , label: "1Tomato"},
        { x: 140, y:359, label: "1Salt"},
        { x: 150, y:308, label:"1Chicken"},
        { x: 160, y:245, label:"1Garlic Powder "},
          { x: 170, y:112, label: "2Paneer" }


        ]
      }

      ],
      legend: {
        cursor:"pointer",
        itemclick : function(e){
          if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
            e.dataSeries.visible = false;
          }
          else{
            e.dataSeries.visible = true;
          }
          chart.render();
        }
      }
    });

chart.render(); 

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
                                
                                     $('#rhr').hide();  
                            }
                        },
                        error: function (jqXHR, textStatus, errorThrown) {
                                $('#rhr').hide();  
                        }});
    </script>        
        <?php $this->end('script'); ?>