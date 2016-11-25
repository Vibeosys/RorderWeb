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
                            <?php if($tableId){?>
                            <div class="order-show col-xs-5" onclick="tablepopup(<?= $tableId ?>)">
                               <?php }else if($takeawayNo){ ?>
                                <div class="order-show col-xs-5" onclick="takeawaypopup(<?= $takeawayNo ?>)">
                               <?php }else{ ?>
                                <div class="order-show col-xs-5" onclick="deliverypopup(<?= $deliveryNo ?>)">      
                               <?php } ?>
                                <div class="row">
                                    <div class="order-no col-xs-5"><label>Bill #</label> <?= $bill->billNo ?></div>
                               <?php if($tableId){?>
                                      <div class="table-no col-xs-5"><label>Table #</label> <?= $bill->tableNo ?></div>
                               <?php }else if($takeawayNo){ ?>
                                      <div class="table-no col-xs-5"><label>Takeaway #</label> <?= $takeawayNo ?></div>
                                 <?php }else{ ?>
                                      <div class="table-no col-xs-5"><label>Delivery#</label> <?= $deliveryNo ?></div>       
                               <?php } ?>
                                    
                                </div>
                                <div class="row">
                                    <div class="user-name col-xs-5"><label>Served By </label> <?= $bill->user ?></div>
                                    <div class="order-time col-xs-5"><label>Date </label> <?= $bill->date ?></div>
                                </div>
                            </div>
                          <?php }}else{ ?>
                             <?php if(isset($message)){ ?>
                            <div class="right_col" role="main">
                                <section class="fil-not-found">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">    
                                            <img src="../img/sad.png" >
                                            <h1 class="e-msg">Sorry!  </h1>
                                            <h3> Information </h3> <h1> not found.</h1>
                                            </div>   
                                        </div>
                                    </div>
                                </section>
            
            
                            </div>
                          <?php }} ?>
                        </div>
                    </div>
                                   
                </section>
            </div><!-- /.box -->                       
        </div><!-- /.col -->
    </div><!-- /.row -->
</section><!-- /.content -->
