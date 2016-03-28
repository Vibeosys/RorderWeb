<?php
    use Cake\Cache\Cache;
    use Cake\Core\Configure;
    use Cake\Datasource\ConnectionManager;
    use Cake\Error\Debugger;
    use Cake\Network\Exception\NotFoundException;
    use App\Controller;

    $this->layout = false;
     $this->layout = 'rorder_layout';
     $this->assign('title', 'Restaurant Stock Upload');
     //$this->start('content');
?>
            <section class="content-header">
                <h1>
                    Restaurant Stock Upload 
                </h1>
                <ol class="breadcrumb">
                    <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active">Stock Upload</li>
                </ol>
            </section>
            <section class="content">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box">                           
                            <section class="content content-div show-add-section">
                                <div class="stock-upload-menu">
                                     <ul class="nav nav-tabs">
                                         <li></li>
                                        <li class="active">
                                            <a data-toggle="tab" href="#msu">Material Stock Upload</a>
                                        </li>
                                        <li>
                                            <a data-toggle="tab" href="#mbsu">Material Brand Stock Upload</a>
                                        </li>
                                        <li>
                                            <a data-toggle="tab" href="#msm">Material Stock Modification</a>
                                        </li>
                                        <li>
                                            <a data-toggle="tab" href="#mbsm">Material Brand Stock Modification</a>
                                        </li>

                                     </ul>
                                </div>  
                                <section class="stock-section" id="msu">
                                    <div class="form-horizontal">
                                        <form method="post" action="stockupload/material" enctype="multipart/form-data">
                                        <div class="box-body">
                                            <div class="form-group">
                                                <label for="Title" class="col-sm-2 control-label">File</label>
                                                <div class="col-sm-8">
                                                    <label for="file-upload" class="custom-file-upload">
                                                        <i> <?= $this->Html->image('upload.png', ['width' => '25','alt' => 'Upload File'])?></i> Upload Your .csv file here
                                                    </label>
                                                    <?= $this->Form->file('file-upload',array('multiple','class'=>'form-control'))?>
                                                </div>
                                            </div>
                                              <?php if(isset($message)){?>
                                            <div  style="margin-left: 20%;color: green" ><?=$message?></div>
                                        <?php }?>
                                        </div><!-- /.box-body -->
                                        <div class="box-footer col-xs-12" style="margin-left:0px">
                                              <div class="row">
                                                <div class="col-xs-4"></div>
                                                    <div class="col-xs-6">
                                                         <button name="add-m" type="submit" value="1" style="margin-bottom:10px" class="dark-orange add-save-btn">SUBMIT</button>
                                                         <input type="button" value="cancel" class="light-orange button add-save-btn"  onclick="window.history.back();">
                                                    </div>
                                                <div class="col-xs-2"></div>
                                            </div>
                                        </div><!-- /.box-footer -->
                                        </form>
                                    </div>
                                    
                                </section>
                                <section class="stock-section" id="mbsu" >
                                    <div class="form-horizontal">
                                        <form method="post" action="stockupload/materialbrand" enctype="multipart/form-data">
                                        <div class="box-body">
                                            <div class="form-group">
                                                <label for="Title" class="col-sm-2 control-label">File</label>
                                                <div class="col-sm-8">
                                                    <label for="file-upload" class="custom-file-upload">
                                                        <i> <?= $this->Html->image('upload.png', ['width' => '25','alt' => 'Upload File'])?></i> Upload Your .csv file here
                                                    </label>
                                                    <?= $this->Form->file('file-upload',array('multiple','class'=>'form-control'))?>
                                                </div>
                                            </div>
                                              <?php if(isset($message)){?>
                                            <div id="error-div" style="margin-left: 20%;color: green" ><?= $message ?></div>
                                        <?php }?>
                                        </div><!-- /.box-body -->
                                        <div class="box-footer col-xs-12" style="margin-left:0px">
                                              <div class="row">
                                                <div class="col-xs-4"></div>
                                                    <div class="col-xs-6">
                                                         <button name="add-mb" type="submit" value="1" style="margin-bottom:10px" class="dark-orange add-save-btn">SUBMIT</button>
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
                                <section class="stock-section" id="msm" >
                                      <div class="box-body show-grid-section">
                                <table id="destination" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Material Code</th>
                                            <th class="title-width">Description</th>
                                            <th class="lat-width">Stock</th>
                                            <th class="lat-width">Unit</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1001</td>
                                            <td class="title-width">
                                                Paneer
                                            </td>
                                            <td class="lat-width">18</td>
                                            <td class="lat-width">Kg</td>
                                            <td> <button class="dark-orange add-edit-btn"><span> Edit</span></button> <button class="light-orange"><span>Delete</span></button></td>
                                        </tr>
                                        <tr>
                                            <td>1002</td>
                                            <td class="title-width">
                                                Cottage Cheese
                                            </td>
                                            <td class="lat-width">8</td>
                                            <td class="lat-width">Kg</td>
                                            <td> <button class="dark-orange add-edit-btn"><span> Edit</span></button> <button class="light-orange"><span>Delete</span></button></td>
                                        </tr>
                                        <tr>
                                            <td>1003</td>
                                            <td class="title-width">
                                                Oil
                                            </td>
                                            <td class="lat-width">20</td>
                                            <td class="lat-width">Litre</td>
                                            <td> <button class="dark-orange add-edit-btn"><span> Edit</span></button> <button class="light-orange"><span>Delete</span></button></td>
                                        </tr>
                                        <tr>
                                            <td>1004</td>
                                            <td class="title-width">
                                                Cashew
                                            </td>
                                            <td class="lat-width">5</td>
                                            <td class="lat-width">Kg</td>
                                            <td> <button class="dark-orange add-edit-btn"><span> Edit</span></button> <button class="light-orange"><span>Delete</span></button></td>
                                        </tr>
                                        <tr>
                                            <td>1005</td>
                                            <td class="title-width">
                                                Tomato
                                            </td>
                                            <td class="lat-width">15</td>
                                            <td class="lat-width">Kg</td>
                                            <td> <button class="dark-orange add-edit-btn"><span> Edit</span></button> <button class="light-orange"><span>Delete</span></button></td>
                                        </tr>
                                        <tr>
                                            <td>1006</td>
                                            <td class="title-width">
                                                Onion
                                            </td>
                                            <td class="lat-width">20</td>
                                            <td class="lat-width">Kg</td>
                                            <td> <button class="dark-orange add-edit-btn"><span> Edit</span></button> <button class="light-orange"><span>Delete</span></button></td>
                                        </tr>
                                        <tr>
                                            <td>1007</td>
                                            <td class="title-width">
                                                eggs
                                            </td>
                                            <td class="lat-width">240</td>
                                            <td class="lat-width">Units</td>
                                            <td> <button class="dark-orange add-edit-btn"><span> Edit</span></button> <button class="light-orange"><span>Delete</span></button></td>
                                        </tr>
                                        <tr>
                                            <td>1008</td>
                                            <td class="title-width">
                                                Fish
                                            </td>
                                            <td class="lat-width">10</td>
                                            <td class="lat-width">Kg</td>
                                            <td> <button class="dark-orange add-edit-btn"><span> Edit</span></button> <button class="light-orange"><span>Delete</span></button></td>
                                        </tr>
                                        <tr>
                                            <td>1009</td>
                                            <td class="title-width">
                                                Chicken
                                            </td>
                                            <td class="lat-width">10</td>
                                            <td class="lat-width">Kg</td>
                                            <td> <button class="dark-orange add-edit-btn"><span> Edit</span></button> <button class="light-orange"><span>Delete</span></button></td>
                                        </tr>
                                        <tr>
                                            <td>1010</td>
                                            <td class="title-width">
                                                Ginger
                                            </td>
                                            <td class="lat-width">2</td>
                                            <td class="lat-width">Kg</td>
                                            <td> <button class="dark-orange add-edit-btn"><span> Edit</span></button> <button class="light-orange"><span>Delete</span></button></td>
                                        </tr>
                                        <tr>
                                            <td>1011</td>
                                            <td class="title-width">
                                                White Flower
                                            </td>
                                            <td class="lat-width">30</td>
                                            <td class="lat-width">Kg</td>
                                            <td> <button class="dark-orange add-edit-btn"><span> Edit</span></button> <button class="light-orange"><span>Delete</span></button></td>
                                        </tr>
                                        <tr>
                                            <td>1012</td>
                                            <td class="title-width">
                                                Mutton
                                            </td>
                                            <td class="lat-width">10</td>
                                            <td class="lat-width">Kg</td>
                                            <td> <button class="dark-orange add-edit-btn"><span> Edit</span></button> <button class="light-orange"><span>Delete</span></button></td>
                                        </tr>
                                        
                                    </tbody>
                                </table>
                            </div>                              

                                </section>
                                <section class="stock-section" id="mbsm" >
                                      <div class="box-body show-grid-section">
                                <table id="destination" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Material Code</th>
                                            <th>Description</th>
                                            <th>Brand Code</th>
                                            <th>Brand Description</th>
                                            <th>Stock</th>
                                            <th>Unit</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1003</td>
                                            <td>
                                                Oil
                                            </td>
                                            <td>1</td>
                                            <td>
                                                Saffola
                                            </td>
                                            <td>10</td>
                                            <td>Litre</td>
                                            <td> <button class="dark-orange add-edit-btn"><span> Edit</span></button> <button class="light-orange"><span>Delete</span></button></td>
                                        </tr>
                                        <tr>
                                            <td>1003</td>
                                            <td>
                                                Oil
                                            </td>
                                            <td>2</td>
                                            <td>
                                                Fortune
                                            </td>
                                            <td >10</td>
                                            <td >Litre</td>
                                            <td> <button class="dark-orange add-edit-btn"><span> Edit</span></button> <button class="light-orange"><span>Delete</span></button></td>
                                        </tr>
                                        <tr>
                                            <td>1004</td>
                                            <td class="title-width">
                                                Cashew
                                            </td>
                                             <td>3</td>
                                            <td class="title-width">
                                                Planters
                                            </td>
                                            <td class="lat-width">2</td>
                                            <td class="lat-width">Kg</td>
                                            <td> <button class="dark-orange add-edit-btn"><span> Edit</span></button> <button class="light-orange"><span>Delete</span></button></td>
                                        </tr>
                                        <tr>
                                            <td>1004</td>
                                            <td class="title-width">
                                                Cashew
                                            </td>
                                            <td>4</td>
                                            <td class="title-width">
                                               Terrasoul Superfoods
                                            </td>
                                            <td class="lat-width">3</td>
                                            <td class="lat-width">Kg</td>
                                            <td> <button class="dark-orange add-edit-btn"><span> Edit</span></button> <button class="light-orange"><span>Delete</span></button></td>
                                        </tr>
                                    <!--    <tr>
                                            <td>1005</td>
                                            <td class="title-width">
                                                Tomato
                                            </td>
                                            <td class="lat-width">15</td>
                                            <td class="lat-width">Kg</td>
                                            <td> <button class="dark-orange add-edit-btn"><span> Edit</span></button> <button class="light-orange"><span>Delete</span></button></td>
                                        </tr>
                                        <tr>
                                            <td>1006</td>
                                            <td class="title-width">
                                                Onion
                                            </td>
                                            <td class="lat-width">20</td>
                                            <td class="lat-width">Kg</td>
                                            <td> <button class="dark-orange add-edit-btn"><span> Edit</span></button> <button class="light-orange"><span>Delete</span></button></td>
                                        </tr>
                                        <tr>
                                            <td>1007</td>
                                            <td class="title-width">
                                                eggs
                                            </td>
                                            <td class="lat-width">240</td>
                                            <td class="lat-width">Units</td>
                                            <td> <button class="dark-orange add-edit-btn"><span> Edit</span></button> <button class="light-orange"><span>Delete</span></button></td>
                                        </tr>
                                        <tr>
                                            <td>1008</td>
                                            <td class="title-width">
                                                Fish
                                            </td>
                                            <td class="lat-width">10</td>
                                            <td class="lat-width">Kg</td>
                                            <td> <button class="dark-orange add-edit-btn"><span> Edit</span></button> <button class="light-orange"><span>Delete</span></button></td>
                                        </tr>
                                        <tr>
                                            <td>1009</td>
                                            <td class="title-width">
                                                Chicken
                                            </td>
                                            <td class="lat-width">10</td>
                                            <td class="lat-width">Kg</td>
                                            <td> <button class="dark-orange add-edit-btn"><span> Edit</span></button> <button class="light-orange"><span>Delete</span></button></td>
                                        </tr>
                                        <tr>
                                            <td>1010</td>
                                            <td class="title-width">
                                                Ginger
                                            </td>
                                            <td class="lat-width">2</td>
                                            <td class="lat-width">Kg</td>
                                            <td> <button class="dark-orange add-edit-btn"><span> Edit</span></button> <button class="light-orange"><span>Delete</span></button></td>
                                        </tr>
                                        <tr>
                                            <td>1011</td>
                                            <td class="title-width">
                                                White Flower
                                            </td>
                                            <td class="lat-width">30</td>
                                            <td class="lat-width">Kg</td>
                                            <td> <button class="dark-orange add-edit-btn"><span> Edit</span></button> <button class="light-orange"><span>Delete</span></button></td>
                                        </tr>
                                        <tr>
                                            <td>1012</td>
                                            <td class="title-width">
                                                Mutton
                                            </td>
                                            <td class="lat-width">10</td>
                                            <td class="lat-width">Kg</td>
                                            <td> <button class="dark-orange add-edit-btn"><span> Edit</span></button> <button class="light-orange"><span>Delete</span></button></td>
                                        </tr>-->
                                        
                                    </tbody>
                                </table>
                            </div>  
                                </section>
                            </section>
                        </div><!-- /.box -->                       
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </section><!-- /.content -->