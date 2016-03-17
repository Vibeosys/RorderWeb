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
                          <?php if(isset($orders)){
                          foreach ($orders as $order){ ?>
                            <div class="order-show col-xs-5" onclick="kotprint('<?= $order->orderId ?>',<?= $order->orderNo ?>,<?= $order->tableId ?>,<?= $order->takeawayNo ?>,'<?= $order->user ?>','<?= $order->orderTime ?>')">
                                <div class="row">
                                    <div class="order-no col-xs-5"><label>Order #</label> <?= $order->orderNo ?></div>
                                 <?php if($order->tableId){ ?>
                                    <div class="table-no col-xs-5"><label>Table #</label> <?= $order->tableId ?></div>
                                 <?php }else{ ?>
                                    <div class="table-no col-xs-5"><label>Takeaway #</label> <?= $order->takeawayNo ?></div>
                                 <?php } ?>
                                </div>
                                <div class="row">
                                    <div class="user-name col-xs-5"><label>Served By </label> <?= $order->user ?></div>
                                    <div class="order-time col-xs-5"><label>Time </label> <?= $order->orderTime ?></div>
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
