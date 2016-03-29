<?php
    use Cake\Cache\Cache;
    use Cake\Core\Configure;
    use Cake\Datasource\ConnectionManager;
    use Cake\Error\Debugger;
    use Cake\Network\Exception\NotFoundException;
    use App\Controller;

     $this->layout = 'rorder_inventory_layout';
     $this->assign('title', 'Inventory');
     $this->assign('breadcrum', '<ol class="breadcrumb">
                    <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>  
                    <li><a>Inventory</a></li>
                </ol>');
     //$this->start('content');
?>
            <section class="content">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box">  
                            <div class="box-header" style="border: 0px solid blue">
                                <div class="row">
                                    <div class="col-xs-4"> <a href="#" onclick="window.history.back();"> << Back </a></div>
                                <div class="col-xs-4 inven-header"></div>
                                <div class="col-xs-4 inven-date"><span class="date-title">Date :<?php date_default_timezone_set(CURRENT_TIME_ZONE);?><?php echo date('d M Y h:ia');?></span></div>
                                </div>
                                <div class="row">
                                <div class="col-xs-6"><button name="os" value="true" class="dark-orange open-stock-btn">Open Stock</button>
                                    <button name="os" value="true" class="dark-orange open-stock-btn">Close Stock</button>
                                </div>
                                <div class="col-xs-2 inven-btn-div">
                                  
                                </div>
                                <div class="col-xs-4">
                                    <form action="inventory" method="post" style="float: right;padding-top: 10px;padding-right: 10px">  
                                    <button name="os" value="true" class="dark-orange "> Save</button>
                                    <a href="">Cancel</a>
                                   </form>
                                    
                                </div>
                                </div>
                                
                            </div>
                            <div class="box-body show-grid-section">
                               <?php if($items){ ?>
                                <table id="destination" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Item Code</th>
                                            <th class="title-width">Material</th>
                                            <th>Stock In Hand</th>
                                            <th>Unit</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                   <?php foreach($items as $item){ ?>
                                    
                                        <tr>
                                        <form action="recipeitems/editrecipeitem" method="post">
                                           
                                            <td class="title-width">
                                                <?= $item->itemId ?><input style="display:none" type="text" name="ItemId" value="<?= $item->itemId ?>">
                                            </td>
                                 
                                            <td class="lat-width"><input class="roleId" style="display:none" type="text" name="itemName" value="<?= $item->itemName ?>">
                                                <?= $item->itemName ?>
                                            </td>
                                            <td class="lat-width">
                                                <input class="stock hidden" type="text" name="srock" value="<?= $item->qty ?>">
                                                <i class="stock-value"><?= $item->qty ?></i>
                                            </td>
                                            <td>
                                                <?= $item->unit ?><input style="display:none" type="text" name="unit" value="<?= $item->unitId ?>">
                                            </td>
                                           </form>
                                        </tr>
                                   
                                   <?php } ?>   
                                    </tbody>
                                </table>
                                <div class="col-xs-3"></div>
                                <div class="col-xs-3"></div>
                                                                <div class="col-xs-3"></div>
                                 <div class="col-xs-3" id="pagination">
                                     
                                    <span id="prev-btn" ><button class="previous dark-orange" ><?=  $this->Paginator->prev(' << ' . __('previous')) ?></button></span>
                                    <span id="next-btn" ><button class="next dark-orange" ><?= $this->Paginator->next('next »') ?></button></span>
                                </div>
                                <textarea id="next-page" style="display: none"><?= $this->Paginator->hasNext()?></textarea>
                                <textarea id="prev-page" style="display: none"><?= $this->Paginator->hasPrev()?></textarea>
                               <?php }else{ ?>
                                 <div id="error-div" style="margin-left: 20%;color: red" >Items not found for current restaurant.<br><br><br>
                                     <a style="margin-left: 90px;padding: 5px;border:1px solid gainsboro" href="../managedata"> << Back</a>
                                 </div>
                               <?php } ?>
                            </div><!-- /.box-body -->
                        </div><!-- /.box -->                       
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </section><!-- /.content -->
             <?php $this->end();?>