<?php
    use Cake\Cache\Cache;
    use Cake\Core\Configure;
    use Cake\Datasource\ConnectionManager;
    use Cake\Error\Debugger;
    use Cake\Network\Exception\NotFoundException;
    use App\Controller;

     $this->layout = 'rorder_layout';
     $this->assign('title', 'Restaurant Transaction Report');
?>          
<?php $this->start('breadcrum');?>

                            <li class="active">Monthly Transaction Report</li>
<?php $this->end('breadcrum'); ?> 
                              <?php $this->start('layout_change');?> 
 <?php $this->end('layout_change'); ?>

              
                <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Monthly Transaction Report</h2>
                  <ul class="nav navbar-right panel_toolbox">
                    <li><a href="#"><i class="fa fa-download"></i> Download</a>
                    </li>
                  </ul>
                  <div class="clearfix"></div>
                </div>
                  <div class="x_content" id="error_tr">
                  <canvas id="transaction_graph"></canvas>
                </div>
              </div>
              </div>           
         
   <?php $this->start('script');?>                                    
<script type="text/javascript">
    
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
                                $.get('/notfound',{},function(result){
                                    $('#error_tr').html(result);
                                });
                            }
                        },
                        error: function (jqXHR, textStatus, errorThrown) {
                                $.get('/notfound',{},function(result){
                                    $('#error_tr').html(result);
                                });
                        }});
    
            </script>
           
<?php $this->end('script'); ?>   
