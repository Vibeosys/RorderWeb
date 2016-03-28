<?php
    use Cake\Cache\Cache;
    use Cake\Core\Configure;
    use Cake\Datasource\ConnectionManager;
    use Cake\Error\Debugger;
    use Cake\Network\Exception\NotFoundException;
    use App\Controller;
    use Cake\View\Helper;
  

    $this->layout = false;
    $this->layout = 'rorder_layout';
    $this->assign('title', 'Add New Recipe Item');
     //$this->start('content');
?>
            <section class="content-header">
                <h1>
                    Restaurant Inventory
                </h1>
                <ol class="breadcrumb">
                    <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li><a href="../menu">Recipe Item</a></li>
                    <li class="active">Add New Recipe Item</li>
                </ol>
            </section>
            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box">
                            <section class="content content-div show-add-section">
                                    <div class="with-border box-header">
                                        <h3 class="box-title">Add New Recipe Item</h3>
                                    </div><!-- /.box-header -->
                                    <div class="form-horizontal">
                                        <form method="post" action="addnewrecipeitem" enctype="multipart/form-data">
                                        <div class="box-body">
                                            <div class="form-group">
                                                <label for="Title" class="col-sm-2 control-label">File</label>
                                                <div class="col-sm-8">
                                                    <label for="file-upload" class="custom-file-upload">
                                                        <i> <?= $this->Html->image('upload.png', ['width' => '25','alt' => 'Upload File'])?></i> Upload Your .csv file here
                                                    </label>
                                                   <!-- <input type="file" name="file-upload" class="form-control" id="Title" placeholder="Title">-->
                                                    <?= $this->Form->file('file-upload',array('multiple','class'=>'form-control'))?>
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
                                                         <button name="add-item" type="submit" value="1" style="margin-bottom:10px" class="dark-orange add-save-btn">SUBMIT</button>
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
       <?php $this->end();?>