<?php

use Cake\Cache\Cache;
use Cake\Core\Configure;
use Cake\Datasource\ConnectionManager;
use Cake\Error\Debugger;
use Cake\Network\Exception\NotFoundException;
use App\Controller;
use Cake\Network\Request;

$this->layout = false;

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>QuickServe | Management panel</title>
     <?= $this->Html->meta ( 'favicon.ico', '/favicon.ico', array ('type' => 'icon' ) )?>
    <?= $this->Html->meta(
    'viewport',
    'width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no')?>
    <?= $this->Html->css('vb-menu-style.css') ?> 
    <?= $this->Html->css('bootstrap.min.css') ?> 
    <?= $this->Html->css('https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css') ?>
    <?= $this->Html->css('https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css') ?>
    <?= $this->Html->css('dataTables.bootstrap.css') ?>
    <?= $this->Html->css('bootstrap-tagsinput.css') ?>
    <?= $this->Html->css('Style.css') ?>
    <?= $this->Html->css('All-skins.css') ?>
</head>
<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        <header class="main-header">
            <!-- Logo -->
            <a href="mgmtpanel" class="logo">
                <i class="qs-logo"><?= $this->Html->image('quickserve-logo.png', ['class' => 'qs-image','alt' => 'QUICK SERVE'])?></i>
            </a>
            <!-- Header Navbar -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <!--<a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>-->
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <!-- User Account -->
                        <li class="dropdown user user-menu">
                            <a href="logout">
                                <?= $this->Html->image('user.png', ['class' => 'user-image','alt' => 'User Image'])?>
                                <span class="hidden-xs">Sign Off</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <div class="restaurant-Show col-xs-4">
        <?php if(isset($data)){
                                        foreach ($data as $rest){?>
            <div class="row">
                                        <div class="mgmt-box-body">
                                            <div class="row">
                                            <div class="restaurant-logo col-lg-4">
                                                  <?= $this->Html->image($rest->logoUrl, ['class' => 'user-image','alt' => 'User Image'])?>
                                            </div>
                                            <div class="restaurant-info col-lg-4">
                                            <div class="restaurant-name">
                                                <b><?= $rest->title ?></b>
                                            </div>
                                            <div class="restaurant-name">
                                            <?= $rest->area ?>,<?= $rest->city ?><br>
                                                <?= $rest->country ?>
                                            </div>
                                            </div>
                                            </div>
                                            <div class="row">
                                            <div class="restaurant-edit">
                                                <?php if($rest->active){?>
                                                <form action="mgmtpanel" method="post">
                                                    <input style="display:none" type="text" value="<?=$rest->restaurantId?>" name="restaurantId">
                                                 <button name="edit" value="true" type="submit" class="dark-orange view-edit-btn">Edit</button>
                                                 <button name="mgmt" value="true" type="submit" class="dark-orange add-save-btn">Manage Menu and Others</button>
                                                 <input type="button" value="view stats" name="<?= $rest->restaurantId ?>" class="dark-orange view-stat-btn">
                                                </form>
<!--                                                  <button name="view-stat" value="<?=$rest->restaurantId?>" class="dark-orange view-stat-btn">View Stat</button>-->
                                                <?php }else{ ?>
                                                <b>Your Subscription Ended. Please contact on <a href="mailto:info@vibeosys.com">info@vibeosys.com</a>.</b>
                                                <?php } ?>
                                            </div>
                                            </div>
                                        </div><!-- /.box-body --></div>
                                    <?php }}?>
        </div>
        <div class="content-wrapper col-xs-8 col-lg-8">
           <section class="content">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box">
                            <section class="content content-div show-rest-section">
                                <div class="row">
                                    <!--Destination Form -->
                                    <div class="with-border box-header">
                                        <h3 class="box-title">Your Subscribed Restaurant</h3>
                                        <span class="mgmt-date"> As on date : <b><?php echo date('D,d-M-Y');?></b></span>
                                         <?php $session =  $this->request->session();
                                        $message = $session->read('rest-edit-message');
                                        $session->delete('rest-edit-message');
                                    if(isset($message)){?>
                                        <b style="color:green;padding-left: 20px"><?= $message ?></b>
                                    <?php } ?>
                                    </div><!-- /.box-header -->
                                </div>
                                <div class="view-statistics">
                                    <div class="sales-history">
                                    <div id="sales-history-graph">   
                                        FusionCharts XT will load here!
                                    </div>   
                                    </div>
                                    <div class="customer-visit">
                                     <div id="customer-visit-graph">   
                                        FusionCharts XT will load here!
                                    </div>
                                    </div>                                    
                                </div>
                            </section>
                        </div><!-- /.box -->
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </section>
        </div><!-- /.content-wrapper -->
    </div><!-- ./wrapper -->
        <footer class="main-footer">
            <div class="pull-right hidden-xs">
                <b>Version</b> 1.0.0
            </div>
            <strong>Copyright &copy; 2015-2016 <a href="mgmtpanel">QuickServe</a>.</strong> All rights reserved.
        </footer>
        <?= $this->Html->script('jQuery-2.1.4.min.js') ?> 
        <?= $this->Html->script('bootstrap.min.js') ?> 
        <?= $this->Html->script('fusioncharts.js') ?> 
        <?= $this->Html->script('fusioncharts.theme.fint.js') ?> 
    <script type="text/javascript">
        $('.view-stat-btn').on('click', function(){
            var restId =  $(this).attr('name');
            FusionCharts.ready(function () {
                $.ajax({
                    url: "/salesreport?id=" + restId, 
                    type:"POST",
                   // data: {id: restId},
                    contentType: false,
                    cache: false,
                    processData:false, 
                    success: function(result, jqXHR, textStatus){
                    if(result){
                        var revenueChart = new FusionCharts({
                        type: 'column2d',
                        renderAt: 'sales-history-graph',
                        width: '550',
                        height: '350',
                        dataFormat: 'json',
                        dataSource: result}).render();
                    }else{
                        alert('Error..!image Not Upload');
                    }
                    },
                    error : function(jqXHR, textStatus, errorThrown) {
                        alert('An error occurred! ' + textStatus + jqXHR + errorThrown);
                }});
             $.ajax({
                    url: "/customervisitreport?id=" + restId, 
                    type:"POST",
                    contentType: false,
                    cache: false,
                    processData:false, 
                    success: function(result, jqXHR, textStatus){
                    if(result){
                        var revenueChart = new FusionCharts({
                        type: 'Doughnut2d',
                        renderAt: 'customer-visit-graph',
                        width: '550',
                        height: '350',
                        dataFormat: 'json',
                        dataSource: result}).render();
                    }else{
                        alert('Error..!data Not found');
                    }
                    },
                    error : function(jqXHR, textStatus, errorThrown) {
                        alert('An error occurred! ' + textStatus + jqXHR + errorThrown);
                }});
              
            });
        });   
    </script>
        <?= $this->Html->script('vb-script-1.js') ?>
        <?= $this->Html->script('bootstrap-tagsinput.js') ?>
        <?= $this->Html->script('jquery.dataTables.js') ?> 
        <?= $this->Html->script('dataTables.bootstrap.min.js') ?> 
        <?= $this->Html->script('jquery.slimscroll.min.js') ?> 
        <?= $this->Html->script('Script.js') ?> 
</body>
</html>

