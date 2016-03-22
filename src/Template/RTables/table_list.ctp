<?php
    use Cake\Cache\Cache;
    use Cake\Core\Configure;
    use Cake\Datasource\ConnectionManager;
    use Cake\Error\Debugger;
    use Cake\Network\Exception\NotFoundException;
    use App\Controller;

     $this->layout = 'rorder_layout';
     $this->assign('title', 'Table List');
     //$this->start('content');
?>
      
<section class="content-header">
                <h1>
                    Tables
                </h1>
                <ol class="breadcrumb">
                    <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>  
                    <li><a>Restaurant Tables</a></li>
                </ol>
            </section>
            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box">  
                            <div class="box-header">
                                <a href="rtables/addnewtables"><button class="dark-orange add-edit-btn"><span>Add New Tables</span></button></a>
                            </div>
                            <div class="box-body show-grid-section">
                               <?php if(isset($tables)){ ?>
                                <table id="destination" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            
                                            <th class="title-width">Table No</th>
                                            <th class="lat-width">Capacity</th>
                                            <th class="lat-width">Category</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                   <?php foreach($tables as $table){ ?>
                                    
                                        <tr>
                                        <form action="rtables/edittable" method="post">
                                            <input style="display:none" type="text" name="tid" value="<?= $table->tableId ?>">
                                            <td class="title-width">
                                                <?= $table->tableNo ?><input style="display:none" type="text" name="tno" value="<?= $table->tableNo ?>">
                                            </td>
                                            <td class="lat-width">
                                           <?= $table->capacity ?><input style="display:none" type="text" name="cpty" value="<?= $table->capacity ?>">
                                            </td>
                                            <td class="lat-width"><input class="roleId" style="display:none" type="text" name="tcid" value="<?= $table->tableCategoryId ?>">
                                                <?php $key = $table->tableCategoryId; echo $category->$key; ?>
                                            </td>
                                            <td>
                                              <?php 
                                              if($table->isOccupied){
                                                  echo 'Ocuupied';
                                                 }else{
                                                    echo 'Unocuupied';
                                                }
                                                ?>
                                                <input style="display:none" type="text" name="iopd" value="<?= $table->isOccupied ?>">
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
                                 <div id="error-div" style="margin-left: 20%;color: red" >Tables not found for current restaurant.<br><br>
                                     <a style="margin-left: 90px;padding: 5px;border:1px solid gainsboro" href="../managedata"> <- Back</a></div>
                               <?php } ?>
                            </div><!-- /.box-body -->
                        </div><!-- /.box -->                       
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </section><!-- /.content -->
             <?php $this->end();?>