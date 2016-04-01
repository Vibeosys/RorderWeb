<?php

use Cake\Cache\Cache;
use Cake\Core\Configure;
use Cake\Datasource\ConnectionManager;
use Cake\Error\Debugger;
use Cake\Network\Exception\NotFoundException;
use App\Controller;

$this->layout = false;
$page = $this->fetch('page');
$sec = $this->fetch('sec');
?>

<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>QuickServe | <?= $this->fetch('title')?></title>
     <?= $this->Html->meta ( 'favicon.ico', '/favicon.ico', array ('type' => 'icon' ) )?>
    <?= $this->Html->meta(
    'viewport',
    'width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no')?>
 <?= $this->Html->meta(
    'keyword',
    'Popular Restaurant Billing Software,Popular Wireless Restaurant Ordering Software,Popular Pos for Restaurant, Popular Hotel Management System')?>
    
    <?= $this->Html->css('vb-menu-style.css') ?> 
    <?= $this->Html->css('bootstrap.min.css') ?> 
    <?= $this->Html->css('https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css') ?>
    <?= $this->Html->css('https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css') ?>
    <?= $this->Html->css('dataTables.bootstrap.css') ?>
    <?= $this->Html->css('bootstrap-tagsinput.css') ?>
    <?= $this->Html->css('Style.css') ?>
    <?= $this->Html->css('menu-styles.css') ?>
    <?= $this->Html->css('All-skins.css') ?>
      <?= $this->Html->script('fusioncharts.js') ?> 
        <?= $this->Html->script('fusioncharts.theme.fint.js') ?> 
</head>
<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        <header class="main-header">
            <!-- Logo -->
          <a href="/" class="logo">
                    <i class="qs-logo"><?= $this->Html->image('quickserve-logo.PNG', ['class' => 'qs-image','alt' => 'QUICK SERVE'])?></i>
                </a>
            <nav class="navbar navbar-static-top" role="navigation">
                
                <div class="navbar-custom-menu">
                 
                    <ul class="nav navbar-nav">
                        <li></li>
                        <!-- User Account -->
                        <li class="dropdown user user-menu">
                            <a href="../logout">
                                <?= $this->Html->image('user.png', ['class' => 'user-image','alt' => 'User Image'])?>
                                
                                <span class="hidden-xs">Sign Off</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <div class="content-wrapper">
            <section class="content-header">
               <div id='cssmenu'>
                <ul>
                    
                    <li class='has-sub'><a href='#'><span>Reports</span></a>
                    <ul>
                        <li><a  href='../inventory/stockinventoryreport'><span>Stock Inventory</span></a></li>
                    <li><a  href='../inventory/materialrequisitionreport'><span>Material Requisition</span></a></li>
                    <li><a  href='../inventory/materialbrandwiserequisitionreport'><span>Material Brandwise Requisition</span></a></li>
                    </ul>
                 </li>
                    <li class='has-sub'><a href=''><span>Stock Upload</span></a>
                    <ul>
                    <li><a href='../inventory/materialstockupload'><span>Material Stock Upload</span></a></li>
                    <li><a href='../inventory/materialbrandstockupload'><span>Material Brand Stock Upload</span></a></li>
                    <li><a href='../inventory/materialstockmodification'><span>Material Stock Modification</span></a></li>
                    <li><a href='../inventory/materialbrandstockmodification'><span>Material Brand Stock Modification</span></a></li>
                    </ul>
                    </li>
                 <li class='active'><a href='../inventory'><span>Stock Taking</span></a></li>
                </ul>
                </div>
                 <?= $this->fetch('breadcrum')?>
            </section>
          
           <?php if($this->fetch('content')){
                         echo $this->fetch('content');
                      }else{
                         echo 'content block not set';
                      }
           ?>
        </div><!-- /.content-wrapper -->
    </div><!-- ./wrapper -->
     <footer class="main-footer" >
            <div class="pull-right hidden-xs">
                <b>Version</b> 1.0.0
            </div>
         <span>Copyright &copy; 2015-2016 <a href="mgmtpanel">QuickServe</a>.</span> All rights reserved.
        </footer>
        <?= $this->Html->script('jQuery-2.1.4.min.js') ?>
        <?= $this->Html->script('bootstrap.min.js') ?> 
        <?= $this->Html->script('jQuery-cookie.js') ?>
    <?= $this->Html->script('menu-script.js') ?>
        <?= $this->Html->script('vb-script-1.js') ?>
        <?= $this->Html->script('bootstrap-tagsinput.js') ?>
        <?= $this->Html->script('jquery.dataTables.js') ?> 
        <?= $this->Html->script('dataTables.bootstrap.min.js') ?> 
        <?= $this->Html->script('jquery.slimscroll.min.js') ?> 
        <?= $this->Html->script('Script.js') ?> 
</body>
</html>
