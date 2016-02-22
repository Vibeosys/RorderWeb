<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Add New Menu</title>
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
                        <a href="#">
                            <i class="icon dashboard"></i> <span>Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="Destination.html">
                            <i class="icon regions"></i> <span>Destinations</span>
                        </a>
                    </li>
                    <li class="active">
                        <a href="Questions.html">
                            <i class="icon channels"></i>  <span>Restaurant Menu</span>
                        </a>
                    </li>
                    <li>
                        <a href="Configuration.html">
                            <i class="icon products"></i>  <span>Configurations</span>
                        </a>
                    </li>
                </ul>
            </section>
            <!-- /.sidebar -->
        </aside>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    Restaurant Menu
                </h1>
                <ol class="breadcrumb">
                    <li><a href="Login.html"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active">Restaurant Menu</li>
                </ol>
            </section>
            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box">
                            <section class="content content-div show-add-section">
                                <div class="row">
                                    <!--Destination Form -->
                                    <div class="with-border box-header">
                                        <h3 class="box-title">Add New Menu</h3>
                                    </div><!-- /.box-header -->
                                    <!-- form start -->
                                    <div class="form-horizontal">
                                        <form method="post" action="addnewmenu" enctype="multipart/form-data">
                                        <div class="box-body">
                                            <div class="form-group">
                                                <label for="Title" class="col-sm-2 control-label">File</label>
                                                <div class="col-sm-8">
                                                    <label for="file-upload" class="custom-file-upload">
                                                        <i> <?= $this->Html->image('upload.png', ['width' => '25','alt' => 'Upload File'])?></i> Upload Your .csv file here
                                                    </label>
                                                   <!-- <input type="file" name="file-upload" class="form-control" id="Title" placeholder="Title">-->
                                                    <?= $this->form->file('file-upload',array('multiple','class'=>'form-control'))?>
                                                </div>
                                            </div>
                                        </div><!-- /.box-body -->
                                        <div class="box-footer" style="margin-left:170px">
                                            <button name="add-menu" type="submit" value="1" class="dark-orange add-save-btn">SUBMIT</button>
                                            <button class="light-orange add-save-btn">Cancel</button>
                                        </div><!-- /.box-footer -->
                                        </form>
                                        <!-- /.box -->
                                        <!-- Destination form elements disabled -->
                                    </div>
                            </section>
                          
                        </div><!-- /.box -->
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </section><!-- /.content -->
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
