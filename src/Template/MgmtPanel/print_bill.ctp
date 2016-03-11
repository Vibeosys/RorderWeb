<?php
    use Cake\Cache\Cache;
    use Cake\Core\Configure;
    use Cake\Datasource\ConnectionManager;
    use Cake\Error\Debugger;
    use Cake\Network\Exception\NotFoundException;
    use App\Controller;

    $this->layout = false;
    $this->layout = 'rorder_layout';
    $this->assign('title', 'Print Bill');
    $this->assign('page','printbill');
    $this->assign('sec','10');
?>
            <section class="content-header">
                <h1>
                    Restaurant Bill Print
                </h1>
                <ol class="breadcrumb">
                    <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active">Print Bill</li>
                </ol>
            </section>
            <section class="content">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box">                           
                            <section class="content content-div show-add-section">
                                <?php if(isset($tables)){ ?>
                                <form action="printbill" method="post" target="_blank">
                                 <?php   foreach ($tables as $table){ ?>
                                
                                 <?php if($table->isOccupied){ ?>   
                                    <button class="print-table-button" value="<?= $table->tableId ?>" onclick="popup()" name="bi" style="background-color: white;color: orangered;border:1px solid gainsboro;">
                                        Table No.<br>
                                        <?= $table->tableNo ?>
                                    </button>
                                 <?php }else { ?>
                                    <button class="print-table-button" value="<?= $table->tableId ?>" name="bi" style="background-color: white;color: orangered;border:1px solid gainsboro;">
                                        Table No.<br>
                                        <?= $table->tableNo ?>
                                    </button>
                                    <?php } } ?>
                                </form>
                                 <?php } else { ?>
                                <?php if(isset($message)){?>
                                            <div id="error-div" style="margin-left: 20%;color: <?= $color ?>" ><?=$message?></div>
                                        <?php }?>
                                 <?php } ?>
                            </section>
                        </div><!-- /.box -->                       
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </section><!-- /.content -->
        