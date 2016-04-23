<?php
    use Cake\Cache\Cache;
    use Cake\Core\Configure;
    use Cake\Datasource\ConnectionManager;
    use Cake\Error\Debugger;
    use Cake\Network\Exception\NotFoundException;
    use App\Controller;

    if(isset($limit)){
     $this->layout = 'rorder_layout';
     $this->assign('title', 'Restaurant Monthly Sales Report');
    
     //$this->start('content');
?>          
             <section class="content-header">
            <h1>
                  Restaurant Monthly Sales
            </h1>
            <ol class="breadcrumb">
                    <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active">Monthly Sales Report</li>
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
                                       <div class="graph-head">Monthly Sales<a  onclick="alert('Work In Progress')">Download</a></div> 
                                            <div id="sales-history-graph">   
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
                var error = '<div class="right_col" role="main">' +
                                '<section class="fil-not-found">' +
                                    '<div class="container">' +
                                        '<div class="row">' +
                                            '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">' +
                                            '<img src="../img/sad.png" >' +
                                            '<h1 class="e-msg">Sorry!  </h1>' +
                                            '<h3> Information </h3> <h1> not found.</h1>' +
                                            '</div></div></div></section></div>';
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
                                
                                    $('#sales-history-graph').html(error);      
                            }
                        },
                        error: function (jqXHR, textStatus, errorThrown) {
                                    $('#sales-history-graph').html(error);    
                        }});
            });
            </script>
           