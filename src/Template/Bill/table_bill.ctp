<?php

use Cake\Cache\Cache;
    use Cake\Core\Configure;
    use Cake\Datasource\ConnectionManager;
    use Cake\Error\Debugger;
    use Cake\Network\Exception\NotFoundException;
    use App\Controller;

    $this->layout = false;
    $this->layout = 'rorder_layout';
    $this->assign('title', 'Table Current Orders');
?>
<section class="content-header">
    <h1>
        Restaurant Table Orders 
    </h1>
    <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Table Orders</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box"> 
                <section class="content content-div show-add-section">
                    <div class="row">
                        <div class="table-order-list"> 
                          <?php if(isset($bills)){
                          foreach ($bills as $bill){ ?>
                            <div class="order-show col-xs-5" onclick="tablepopup(<?= $tableId ?>)">
                                <div class="row">
                                    <div class="order-no col-xs-5"><label>Bill #</label> <?= $bill->billNo ?></div>
                                    <div class="table-no col-xs-5"><label>Table #</label> <?= $bill->tableNo ?></div>
                                </div>
                                <div class="row">
                                    <div class="user-name col-xs-5"><label>Served By </label> <?= $bill->user ?></div>
                                    <div class="order-time col-xs-5"><label>Date </label> <?= $bill->date ?></div>
                                </div>
                            </div>
                          <?php }}else{ ?>
                             <?php if(isset($message)){ ?>
                                <div class="error-message"><div class="error-img"></div><span class="error-text"><?= $message?></span></div>
                          <?php }} ?>
                        </div>
                    </div>
                                   
                </section>
            </div><!-- /.box -->                       
        </div><!-- /.col -->
    </div><!-- /.row -->
</section><!-- /.content -->
