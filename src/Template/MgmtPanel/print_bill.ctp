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
    $this->assign('sec','10000');
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
                <div class="tab-container">
                    <ul class="nav nav-tabs">
                        <li></li>
                        <li class="active"><a id="dinein" data-toggle="tab" href="#home">Dine-In</a></li>
                        <li><a id="takeaway" data-toggle="tab" href="#menu2">Takeaway</a></li>
                    </ul>
                </div>
                <section class="content content-div show-add-section">
                    <div class="row">
                        <div class="table-list">    
                                    <?php if(isset($tables)){ ?>
                            <form action="printbill" method="post" target="_blank">
                                    <?php   foreach ($tables as $table){ ?>

                                    <?php if($table->isOccupied){ ?>   
                                <div class="print-table-button col-xs-2" onclick="popup(<?= $table->tableId ?>)" style="background-color: white;color: orangered;border:1px solid gainsboro;border-bottom: 8px solid red;">
                                    Table No.<br>
                                            <?= $table->tableNo ?>
                                </div>
                                    <?php }else { ?>
                                <div class="print-table-button col-xs-2" onclick="popup(<?= $table->tableId ?>)" style="background-color: white;color: orangered;border:1px solid gainsboro;border-bottom: 8px solid green;">
                                    Table No.<br>
                                            <?= $table->tableNo ?>
                                </div>
                                        <?php } } ?>
                            </form>
                                        <?php } else { ?>
                                        <?php if(isset($message)){?>
                            <div class="error-message"><div class="error-img"></div><span class="error-text"><?= $message?></span></div>
                                            <?php }?>
                                    <?php } ?>
                        </div>
                    </div>
                </section>
            </div><!-- /.box -->                       
        </div><!-- /.col -->
    </div><!-- /.row -->
</section><!-- /.content -->
