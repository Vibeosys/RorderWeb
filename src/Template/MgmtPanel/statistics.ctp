<?php
    use Cake\Cache\Cache;
    use Cake\Core\Configure;
    use Cake\Datasource\ConnectionManager;
    use Cake\Error\Debugger;
    use Cake\Network\Exception\NotFoundException;
    use App\Controller;

    $this->layout = false;
     $this->layout = 'rorder_layout';
     $this->assign('title', 'ADD NEW TABLE CATEGORY');
     //$this->start('content');
?>
            <section class="content-header">
                <h1>
                    Restaurant Statistics
                </h1>
                <ol class="breadcrumb">
                    <li><a href="Login.html"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li><a href="../mgmtpanel">MgmtPanel</a></li>
                    <li class="active">Statistics</li>
                </ol>
            </section>
            <section class="content">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box">                           
                            <section class="content content-div show-add-section">
                                <div class="row">
                                    <!--Destination Form -->
                                  <!--  <div class="with-border box-header">
                                        <h3 class="box-title">Add New Category</h3>
                                    </div> /.box-header -->
                                    <!-- form start -->
                                   
                                </div>
                            </section>
                        </div><!-- /.box -->                       
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </section><!-- /.content -->