<?php
    use Cake\Cache\Cache;
    use Cake\Core\Configure;
    use Cake\Datasource\ConnectionManager;
    use Cake\Error\Debugger;
    use Cake\Network\Exception\NotFoundException;
    use App\Controller;

    if(isset($limit)){
     $this->layout = 'rorder_layout';
     $this->assign('title', 'Restaurant Customer Rush Hours');
    
     //$this->start('content');
?>          
             <section class="content-header">
            <h1>
                  Restaurant Customer Rush Hours
            </h1>
            <ol class="breadcrumb">
                    <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active">Customer Rush Hours</li>
                </ol>
            </section>
            <section class="content">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box">                           
                            <section class="content content-div show-add-section">
                                <section class="stock-section" id="msu" style="margin-top:50px">
                                   <div class="material-requisition" style="">
                                     <?php } ?>  
                                       <div class="graph-head">Customer Rush Hours<a  onclick="alert('Work In Progress')">Download</a></div> 
                                            <div id="customer-visit-graph">   
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
            });
            </script>
           