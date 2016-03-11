<?php
    use Cake\Cache\Cache;
    use Cake\Core\Configure;
    use Cake\Datasource\ConnectionManager;
    use Cake\Error\Debugger;
    use Cake\Network\Exception\NotFoundException;
    use App\Controller;

    $this->layout = false;
     $this->layout = 'rorder_layout';
     $this->assign('title', 'Add New Table');
     //$this->start('content');
?>
            <section class="content-header">
                <h1>
                    Restaurant Tables
                </h1>
                <ol class="breadcrumb">
                    <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li><a href="../tables">Tables</a></li>
                    <li class="active">Restaurant Tables</li>
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
                                        <form method="post" action="addnewtables" enctype="multipart/form-data">
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
                                        <div class="box-footer col-xs-12" style="margin-left:0px">
                                            <div class="row">
                                                <div class="col-xs-4"></div>
                                                    <div class="col-xs-6">
                                                        <button name="add-table" type="submit" style="margin-bottom:10px" value="1" class="dark-orange add-save-btn">SUBMIT</button>
                                                        <input type="button" value="cancel" class="light-orange button add-save-btn"  onclick="window.history.back();">
                                                    </div>
                                                <div class="col-xs-2"></div>
                                            </div>
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
      