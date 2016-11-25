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
 <?= $this->Html->script('fusioncharts.js') ?> 
        <?= $this->Html->script('fusioncharts.theme.fint.js') ?> 
<section class="content content-div show-rest-section">
                                    <div class="row">
                                        <!--Destination Form -->
                                        <div class="with-border box-header">
                                            <h3 class="box-title">Report Statistics &nbsp;&nbsp;<b id="restaurant-nm"> </b></h3>
                                            <h3 class="mgmt-date">As on date &nbsp;&nbsp; <b><?php echo date('d M Y');?></b></h3>
                                       
                                        </div><!-- /.box-header -->
                                    </div>
                                    <div class="view-statistics" style="">
                                        <div class="sales-history" style="margin-left:10%;width: 70%;background-color: #FFF">
                                           
                                        </div>
                                        <hr>
                                        <div class="customer-visit" style="margin-left:10%;width: 70%;background-color: #FFF ">
                                          
                                        </div> 
                                        <hr>
                                        <div class="transaction-report" style="margin-left:10%;width: 70%;background-color: #FFF ">
                                          
                                        </div>
                                        <hr>
                                        <div class="inventry-report" style="margin-left:10%;width: 70%;background-color: #FFF ">
                                            
                                        </div>
                                        <hr>
                                        <div class="material-req-report" style="margin-left:10%;width: 70%;background-color: #FFF ">
                                        </div>
                                        <hr>
                                        <div class="material-bw-req-report" style="margin-left:10%;width: 70%;background-color: #FFF ">
                                        </div>
                                    </div>
                                </section>
       <?php $this->start('script'); ?>
        <script>
        $(document).ready(function(){
            $.post('/inventory/materialrequisitionreport',{},function(result){
                $('.material-req-report').html(result);
                $.post('/reports/stockavailability',{},function(result){
                    $('.inventry-report').html(result);
                    $.post('/reports/transactionreport',{},function(result){
                        $('.transaction-report').html(result);
                        $.post('/reports/customerrushhour',{},function(result){
                            $('.customer-visit').html(result);
                            $.post('/reports/salesreport',{},function(result){
                                $('.sales-history').html(result);
                                $.post('/inventory/materialbrandwiserequisitionreport',{},function(result){
                                    $('.material-bw-req-report').html(result);
                                });
                            });
                        });
                    });
                });
            });
        });
        </script>
        
        <?php $this->end('script'); ?>
