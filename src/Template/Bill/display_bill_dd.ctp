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
                           <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">                    
                       <div class="error-msg1">
                           <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 border-bottom">
                               <div class="row">
                                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                                        <img src="../img/error-fix.png" class="img-responsive error-fix">
                                   </div>
                                    <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
                                        <span class="error-heading">Bills not Found! </span>
                                   </div>
                               </div> 
                            </div>
                           <div class="msg-text">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col-lg-offset-2 col-md-offset-3 ">                  
                                            <p class="error-p1">The content not found</p>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12  col-lg-offset-2 col-md-offset-3">
                                           <p class="error-msg2">Here are some suggestions:</p>
                                                    <ul class="error-list1">
                                                                <li> <a href="../tableview/printbill">Back</a> </li>
                                                                <li> <a href="../reports">Home</a></li>
                                                    </ul>
                                    </div>
                            </div>
                    </div>
                </div>       
                          <?php }} ?>
                        </div>
                    </div>
                </section>
            </div><!-- /.box -->                       
        </div><!-- /.col -->
    </div><!-- /.row -->
</section><!-- /.content -->
