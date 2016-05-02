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
              
                <div class="col-md-6 col-sm-6 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Bar Graph <small>Sessions</small></h2>
                  <ul class="nav navbar-right panel_toolbox">
                    <li><a href="#"><i class="fa fa-download"></i> Download</a>
                    </li>
                  </ul>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <canvas id="mybarChart"></canvas>
                </div>
              </div>
            </div>

              
              
            <div class="col-md-6 col-sm-6 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Donut Chart Graph <small>Sessions</small></h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a href="#"><i class="fa fa-download"></i> Download</a>
                    </li>
                  </ul>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <canvas id="canvasDoughnut"></canvas>
                </div>
              </div>
            </div>
              
              
              
              
              
                <div class="col-md-6 col-sm-6 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Bar Graph <small>Sessions</small></h2>
                  <ul class="nav navbar-right panel_toolbox">
                    <li><a href="#"><i class="fa fa-download"></i> Download</a>
                    </li>
                  </ul>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <canvas id="mybarChart2"></canvas>
                </div>
              </div>
            </div>
              
              
                <div class="col-md-6 col-sm-6 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Bar Horizontal Graph <small>Sessions</small></h2>
                  <ul class="nav navbar-right panel_toolbox">
                    <li><a href="#"><i class="fa fa-download"></i> Download</a>
                    </li>
                  </ul>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <canvas id="mybarChart3"></canvas>
                </div>
              </div>
            </div>

              
              
                  <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                      <div class="x_title">
                        <h2>Responsive example <small>Users</small></h2>
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
                          <tbody>
                            <tr>
                              <td>Tiger</td>
                              <td>Nixon</td>
                              <td>System Architect</td>
                              <td>Edinburgh</td>
                              <td>61</td>
                             
                            </tr>
                            <tr>
                              <td>Garrett</td>
                              <td>Winters</td>
                              <td>Accountant</td>
                              <td>Tokyo</td>
                              <td>63</td>
                              
                            </tr>
                            <tr>
                              <td>Ashton</td>
                              <td>Cox</td>
                              <td>Junior Technical Author</td>
                              <td>San Francisco</td>
                              <td>66</td>
                             
                            </tr>
                          </tbody>
                        </table>

                      </div>
                    </div>
                  </div>
              
              
                            
                  <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                      <div class="x_title">
                        <h2>Responsive example <small>Users</small></h2>
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
                          <tbody>
                            <tr>
                              <td>Tiger</td>
                              <td>Nixon</td>
                              <td>System Architect</td>
                              <td>Edinburgh</td>
                              <td>61</td>
                              <td>2011/04/25</td>
                            
                            </tr>
                            <tr>
                              <td>Garrett</td>
                              <td>Winters</td>
                              <td>Accountant</td>
                              <td>Tokyo</td>
                              <td>63</td>
                              <td>2011/07/25</td>
                             
                            </tr>
                            <tr>
                              <td>Ashton</td>
                              <td>Cox</td>
                              <td>Junior Technical Author</td>
                              <td>San Francisco</td>
                              <td>66</td>
                              <td>2009/01/12</td>
                            </tr>
                            <tr>
                              <td>Cedric</td>
                              <td>Kelly</td>
                              <td>Senior Javascript Developer</td>
                              <td>Edinburgh</td>
                              <td>22</td>
                              <td>2012/03/29</td>
                             
                            </tr>
                            <tr>
                              <td>Airi</td>
                              <td>Satou</td>
                              <td>Accountant</td>
                              <td>Tokyo</td>
                              <td>33</td>
                              <td>2008/11/28</td>
                              
                            </tr>
                            <tr>
                              <td>Brielle</td>
                              <td>Williamson</td>
                              <td>Integration Specialist</td>
                              <td>New York</td>
                              <td>61</td>
                              <td>2012/12/02</td>
                             
                            </tr>
                            <tr>
                              <td>Herrod</td>
                              <td>Chandler</td>
                              <td>Sales Assistant</td>
                              <td>San Francisco</td>
                              <td>59</td>
                              <td>2012/08/06</td>
                              
                            </tr>
                            <tr>
                              <td>Rhona</td>
                              <td>Davidson</td>
                              <td>Integration Specialist</td>
                              <td>Tokyo</td>
                              <td>55</td>
                              <td>2010/10/14</td>
                              
                            </tr>
                            <tr>
                              <td>Colleen</td>
                              <td>Hurst</td>
                              <td>Javascript Developer</td>
                              <td>San Francisco</td>
                              <td>39</td>
                              <td>2009/09/15</td>
                             
                            </tr>
                            <tr>
                              <td>Sonya</td>
                              <td>Frost</td>
                              <td>Software Engineer</td>
                              <td>Edinburgh</td>
                              <td>23</td>
                              <td>2008/12/13</td>
                             
                            </tr>
                           <tr>
                              <td>Sonya</td>
                              <td>Frost</td>
                              <td>Software Engineer</td>
                              <td>Edinburgh</td>
                              <td>23</td>
                              <td>2008/12/13</td>
                             
                            </tr>
                          </tbody>
                        </table>

                      </div>
                    </div>
                  </div>
          </div>
   <!-- Chart script -->
<?php $this->start('script');?>    
  <script>
    Chart.defaults.global.legend = {
      enabled: false
    };

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
                               var ctx = document.getElementById("mybarChart");
                                var mybarChart = new Chart(ctx, {
                                 type: 'bar',
                            data: {
                                labels: labels,
                            datasets: [{
                            label: '# of Votes',
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
                                
                                    $('#sales-history-graph').html('error');      
                            }
                        },
                        error: function (jqXHR, textStatus, errorThrown) {
                                    $('#sales-history-graph').html('error');    
                        }});
   
      
       // Bar chart2
    var ctx = document.getElementById("mybarChart2");
    var mybarChart = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: ["January", "February", "March", "April", "May", "June", "July"],
        datasets: [{
          label: '# of Votes',
          backgroundColor: "#9B59B6",
          data: ['10', 62, 40, 55, 22, 89, 66]
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
      
         // Bar chart2
   
	  // Bar chart2
    var ctx = document.getElementById("mybarChart3");
    var mybarChart = new Chart(ctx, {
      type: 'bar',
      data: {
       labels: ["January", "February", "March", "April", "May", "June", "July"],
        datasets: [{
          label: '# of Votes',
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
                                var labels = new Array();
                                var value = new Array();
                                $.each(result,function(key, obj){
                                    labels.push(obj.label);
                                    value.push(obj.value);
                                });
                                 var ctx = document.getElementById("canvasDoughnut");
                                var data = {
                                    labels: labels,
                                    datasets: [{
                                    data: value,
                                     backgroundColor: [
                                     "#455C73",
                                         "#9B59B6",
                                     "#BDC3C7",
                                     "#26B99A",
                                     "#3498DB"
                                    ],
                                     hoverBackgroundColor: [
                                     "#34495E",
                                        "#B370CF",
                                    "#CFD4D8",
                                    "#36CAAB",
                                     "#49A9EA"
                                    ]

                                }]
                                    };
                                     var canvasDoughnut = new Chart(ctx, {
      type: 'doughnut',
      tooltipFillColor: "rgba(51, 51, 51, 0.55)",
      data: data
    });
                            } else {
                                alert('Error..!Please contact on info@vibeosys.com');
                            }
                        },
                        error: function (jqXHR, textStatus, errorThrown) {
                            alert('An error occurred! ' + textStatus + jqXHR + errorThrown);
                        }});
   

   
    </script>

<!-- Table script -->

        <script type="text/javascript">
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
         
        </script>

    
     <script type="text/javascript">
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
         
        </script>
        
        <?php $this->end('script'); ?>