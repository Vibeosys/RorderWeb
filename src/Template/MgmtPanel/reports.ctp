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

              
              
       <div class="col-md-6 col-sm-6 col-xs-12" id="rhr">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Rush Hour <small>Dailey</small></h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a href="#"><i class="fa fa-download"></i> Download</a>
                    </li>
                  </ul>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                     <div id="graph_donut"></div>
                  
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
              
              
       <div class="col-md-6 col-sm-6 col-xs-12" id="sar">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Stock Availability <small>current</small></h2>
                  <ul class="nav navbar-right panel_toolbox">
                    <li><a href="#"><i class="fa fa-download"></i> Download</a>
                    </li>
                  </ul>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div id="error-sa" align="center"> </div>
                  <canvas id="mybarChart3"></canvas>
                </div>
              </div>
            </div>

              
              
       <div class="col-md-12 col-sm-12 col-xs-12" id="mrr">
                    <div class="x_panel">
                      <div class="x_title">
                        <h2>Material Requisition <small>current</small></h2>
                       <ul class="nav navbar-right panel_toolbox">
                    <li><a href="#"><i class="fa fa-download"></i> Download</a>
                    </li>
                  </ul>
                        <div class="clearfix"></div>
                      </div>
                        <div class="x_content">
                       <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                          <thead>
                            <tr>
                              <th>Material Code</th>
                              <th>Material</th>
                              <th>Stock</th>
                              <th>Reorder Stock</th>
                              <th>Unit</th>
                             
                            </tr>
                          </thead>
                          <tbody id="req">
                          
                          </tbody>
                        </table>

                      </div>
                    </div>
                  </div>
              
              
                            
       <div class="col-md-12 col-sm-12 col-xs-12" id="mbrr">
                    <div class="x_panel">
                      <div class="x_title">
                        <h2>Material Brand Wise Requisition<small>current</small></h2>
                       <ul class="nav navbar-right panel_toolbox">
                    <li><a href="#"><i class="fa fa-download"></i> Download</a>
                    </li>
                  </ul>
                        <div class="clearfix"></div>
                      </div>
                      <div class="x_content">
                       
                        <table id="datatable-responsive-second" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                          <thead>
                            <tr>
                              <th>Brand Code</th>
                              <th>Brand</th>
                              <th>Material</th>
                              <th>Stock</th>
                              <th>Reorder Stock</th>
                              <th>Unit</th>
                              
                            </tr>
                          </thead>
                          <tbody id="bw-req">
                           
                          </tbody>
                        </table>

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
    
      
         // Bar chart2
   
	  // Bar chart2
    var ctx = document.getElementById("mybarChart3");
    var mybarChart = new Chart(ctx, {
      type: 'bar',
      data: {
       labels: ["January", "February", "March", "April", "May", "June", "July"],
        datasets: [{
          label: 'Stock',
          backgroundColor: "#3498DB",
          data: [10, 62, 40, 55, 22, 89, 66]
        }]
      },

     options: {
        
        scales: {
          xAxes: [{
            ticks: {
              beginAtZero: true
            }
            
          }]
        }
      }
    });
    // Doughnut chart
    
    $.ajax({
                        url: "/customervisitreport?id=" + '<?= $rest ?>',
                        type: "POST",
                        contentType: false,
                        cache: false,
                        processData: false,
                        success: function (result, jqXHR, textStatus) {
                            if (result) {
                             Morris.Donut({
                                element: 'graph_donut',
                                data: result,
                                colors: ['#26B99A', '#34495E', '#ACADAC', '#3498DB'],
                                formatter: function (y) {
                                    return y 
                                }
                            });   
                                   
                            } else {
                                
                                     $('#rhr').hide();  
                            }
                        },
                        error: function (jqXHR, textStatus, errorThrown) {
                                $('#rhr').hide();  
                        }});
    </script>

<!-- Table script -->
 <script type="text/javascript">
     var htmlc = '';
$.post('/ajax/materialrequisitionreport',{},function(result){
            if(result){
                $.each(result,function(key,value){
                    if(value.qty <= value.rLevel){
                    htmlc += '<tr style="color: red">';
                    }else{ 
                        htmlc += '<tr style="color: green">';
                    }
                    htmlc += '<td>' + value.itemId + '</td>'
                    htmlc += '<td>' + value.itemName + '</td>';
                    htmlc += '<td>' + value.qty + '</td>';
                    htmlc += '<td>' + value.rLevel + '</td>';
                    htmlc +=     '<td>' + value.unit + '</td></tr>';
                });
                $('#req').html(htmlc);
                if(htmlc){
                     $(document).ready(function() {
            $('#datatable').dataTable();
            $('#datatable-keytable').DataTable({
              keys: true
            });
            $('#datatable-responsive').DataTable();
            $('#datatable-scroller').DataTable({
              ajax: "js/datatables/json/scroller-demo.json",
              deferRender: true,
              scrollY: 380,
              scrollCollapse: true,
              scroller: true
            });
            var table = $('#datatable-fixed-header').DataTable({
              fixedHeader: true
            });
          });
                    }
            }else{
                var error = '<div class="right_col" role="main">' +
                                '<section class="fil-not-found">' +
                                    '<div class="container">' +
                                        '<div class="row">' +
                                            '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">' +
                                            '<img src="../img/sad.png" >' +
                                            '<h1 class="e-msg">Sorry!  </h1>' +
                                            '<h3> Information </h3> <h1> not found.</h1>' +
                                            '</div></div></div></section></div>';
               $('#req').html(error);      
           }
        });
        </script>

    
     <script type="text/javascript">
          var htmlt = '';
         $.post('/ajax/materialbwrequisitionreport',{},function(result){
            if(result){
                $.each(result,function(key,value){
                    if(value.qty <= value.rLevel){
                        htmlt += '<tr style="color: red">';
                    }else{ 
                        htmlt += '<tr style="color: green">';
                    }
                    htmlt += '<td>' + value.brandCode + '</td>';
                    htmlt += '<td>' + value.brand + '</td>';
                    htmlt += '<td>' + value.item + '</td>';
                    htmlt += '<td>' + value.stock + '</td>';
                    htmlt += '<td>' + value.rstock + '</td>';
                    htmlt += '<td>' + value.unit + '</td></tr>';
                });
                $('#bw-req').html(htmlt);
                  $(document).ready(function() {
            $('#datatable').dataTable();
            $('#datatable-keytable').DataTable({
              keys: true
            });
            $('#datatable-responsive-second').DataTable();
            $('#datatable-scroller').DataTable({
              ajax: "js/datatables/json/scroller-demo.json",
              deferRender: true,
              scrollY: 380,
              scrollCollapse: true,
              scroller: true
            });
            var table = $('#datatable-fixed-header').DataTable({
              fixedHeader: true
            });
          });
         
            }else{
                 var error = '<div class="right_col" role="main">' +
                                '<section class="fil-not-found">' +
                                    '<div class="container">' +
                                        '<div class="row">' +
                                            '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">' +
                                            '<img src="../img/sad.png" >' +
                                            '<h1 class="e-msg">Sorry!  </h1>' +
                                            '<h3> Information </h3> <h1> not found.</h1>' +
                                            '</div></div></div></section></div>';
               $('#bw-req').html(error);                     
           }
        });
        
        </script>
        
        <?php $this->end('script'); ?>