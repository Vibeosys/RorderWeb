<?php
    use Cake\Cache\Cache;
    use Cake\Core\Configure;
    use Cake\Datasource\ConnectionManager;
    use Cake\Error\Debugger;
    use Cake\Network\Exception\NotFoundException;
    use App\Controller;

     $this->layout = 'rorder_layout';
     $this->assign('title', 'Inventory');
     //$this->start('content');
?>
      
<section class="content-header">
                <h1>
                  Restaurant Inventory
                </h1>
                <ol class="breadcrumb">
                    <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>  
                    <li><a>Inventory</a></li>
                </ol>
            </section>
            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box">  
                            <div class="box-header" style="border: 0px solid blue">
                                <div class="row">
                                <div class="col-xs-4"></div>
                                <div class="col-xs-4 inven-header"><h2>Stock Taking</h2></div>
                                <div class="col-xs-4 inven-date"><span class="date-title">Date :<?php date_default_timezone_set(CURRENT_TIME_ZONE);?><?php echo date('d M Y h:ia');?></span></div>
                                </div>
                                <div class="row">
                                <div class="col-xs-4"></div>
                                <div class="col-xs-4 inven-btn-div">
                                    <form action="inventory" method="post">  
                                    <button name="os" value="true" class="dark-orange open-stock-btn"> Open Stock</button>
                                    <button name="cs" value="true" class="dark-orange close-stock-btn"> Close Stock</button>
                                    <button name="su" value="true" class="dark-orange stock-upload-btn"> Stock Upload</button>
                                    </form>
                                </div>
                                <div class="col-xs-4"></div>
                                </div>
                                
                            </div>
                            <div class="box-body show-grid-section">
                               <?php if($items){ ?>
                                <table id="destination" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Item Code</th>
                                            <th class="title-width">Title</th>
                                            <th>Stock</th>
                                            <th>Unit</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                   <?php foreach($items as $item){ ?>
                                    
                                        <tr>
                                        <form action="recipeitems/editrecipeitem" method="post">
                                           
                                            <td class="title-width">
                                                <?= $item->itemId ?><input style="display:none" type="text" name="ttl" value="<?= $item->itemId ?>">
                                            </td>
                                 
                                            <td class="lat-width"><input class="roleId" style="display:none" type="text" name="prc" value="<?= $item->itemName ?>">
                                                <?= $item->itemName ?>
                                            </td>
                                            <td class="lat-width">
                                                <input class="roleId" style="display:none" type="text" name="rm" value="<?= $item->qty ?>">
                                                <?= $item->qty ?>
                                            </td>
                                            <td>
                                                <?= $item->unit ?><input style="display:none" type="text" name="igt" value="<?= $item->unitId ?>">
                                            </td>
                                             
                                            <td> <button name="edit" type="submit" class="dark-orange user-edit-btn"><span> Edit</span></button></td>
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