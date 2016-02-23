<?php

use Cake\Cache\Cache;
use Cake\Core\Configure;
use Cake\Datasource\ConnectionManager;
use Cake\Error\Debugger;
use Cake\Network\Exception\NotFoundException;
use App\Controller;

$this->layout = false;

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?= $this->fetch('title')?></title>
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
            <a href="Login.html" class="logo">
                <!-- mini logo for sidebar mini 50x50 pixels -->
                <span class="logo-mini"><b>A</b>N</span>
                <!-- logo for regular state and mobile devices -->
                <span class="logo-lg"><b>Application</b></span>
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
                            <a href="Login.html">
                                <?= $this->Html->image('user.png', ['class' => 'user-image','alt' => 'User Image'])?>
                                <span class="hidden-xs">Sign Off</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <!-- Left side column. contains the logo and sidebar -->
        <aside class="main-sidebar">
            <!-- sidebar -->
            <section class="sidebar">
                <!-- sidebar menu:  -->
                <ul class="sidebar-menu">
                    <li>
                        <a href="../menu/addnewmenu">
                            <i class="icon dashboard"></i> <span>Menu</span>
                        </a>
                    </li>
                    <li>
                        <a href="../menu-category/addnewmenucategory">
                            <i class="icon regions"></i> <span>Menu category</span>
                        </a>
                    </li>
                    <li class="active">
                        <a href="../rtables/addnewtables">
                            <i class="icon channels"></i>  <span>Restaurant Tables</span>
                        </a>
                    </li>
                    <li>
                        <a href="../table-category/addnewtablecategory">
                            <i class="icon products"></i>  <span>Tables Category</span>
                        </a>
                    </li>
                </ul>
            </section>
            <!-- /.sidebar -->
        </aside>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
           <?php if($this->fetch('content')){
                         echo $this->fetch('content');
                      }else{
                         echo 'content block not set';
                      }
           ?>
        </div><!-- /.content-wrapper -->
        <footer class="main-footer">
            <div class="pull-right hidden-xs">
                <b>Version</b> 1.0.0
            </div>
            <strong>Copyright &copy; 2015-2016 <a href="#">Application Name</a>.</strong> All rights reserved.
        </footer>
    </div><!-- ./wrapper -->
        <?= $this->Html->script('jQuery-2.1.4.min.js') ?> 
        <?= $this->Html->script('bootstrap.min.js') ?> 
        <?= $this->Html->script('bootstrap-tagsinput.js') ?>
        <?= $this->Html->script('jquery.dataTables.js') ?> 
        <?= $this->Html->script('dataTables.bootstrap.min.js') ?> 
        <?= $this->Html->script('jquery.slimscroll.min.js') ?> 
        <?= $this->Html->script('Script.js') ?> 
</body>
</html>
