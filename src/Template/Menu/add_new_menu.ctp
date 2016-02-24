<?php
    use Cake\Cache\Cache;
    use Cake\Core\Configure;
    use Cake\Datasource\ConnectionManager;
    use Cake\Error\Debugger;
    use Cake\Network\Exception\NotFoundException;
    use App\Controller;

    $this->layout = false;
     $this->layout = 'rorder_layout';
     $this->assign('title', 'ADD NEW MENU');
     //$this->start('content');
?>
            <section class="content-header">
                <h1>
                    Restaurant Menu
                </h1>
                <ol class="breadcrumb">
                    <li><a href="Login.html"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li><a href="../menu-category">Menu</a></li>
                    <li class="active">Add New Menu</li>
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
                                              <?php if(isset($message)){?>
                                            <div id="error-div" style="margin-left: 20%;color: <?= $color ?>" ><?=$message?></div>
                                        <?php }?>
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
       <?php $this->end();?>