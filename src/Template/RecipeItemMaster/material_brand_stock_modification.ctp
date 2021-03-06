<?php
    use Cake\Cache\Cache;
    use Cake\Core\Configure;
    use Cake\Datasource\ConnectionManager;
    use Cake\Error\Debugger;
    use Cake\Network\Exception\NotFoundException;
    use App\Controller;

    $this->layout = false;
     $this->layout = 'rorder_layout';
     $this->assign('title', 'Restaurant Brand Stock Modification');
     $this->assign('breadcrum', ' ');
     //$this->start('content');
?>          <section class="content-header">
            <h1>
                  Restaurant Brand Stock Modification
            </h1>
           <ol class="breadcrumb">
                    <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active">Brand Stock Modification</li>
                </ol>
            </section>
            <section class="content">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box">                           
                            <section class="content content-div show-add-section">
                                <div class="back-btn" style="margin-top: 1%"> 
                                    <a href="../inventory/stockinventoryreport"> << Back </a>
                                </div>
                                <section class="stock-section" id="mbsm" style="margin-top:1%">
                                      <div class="box-body show-grid-section">
                                <table id="destination" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th style="width:8%">Material Code</th>
                                            <th >Description</th>
                                            <th >Brand Code</th>
                                            <th >Brand Description</th>
                                            <th >Stock</th>
                                            <th >Unit</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td style="width:8%">1003</td>
                                            <td >
                                                Oil
                                            </td>
                                            <td >1</td>
                                            <td >
                                                Saffola
                                            </td>
                                            <td >10</td>
                                            <td >Litre</td>
                                            <td><button class="dark-orange add-edit-btn"><span> Edit</span></button> <button class="light-orange"><span>Delete</span></button></td>
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
                                    </tbody>
                                </table>
                            </div>  
                                </section>
                            </section>
                        </div><!-- /.box -->                       
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </section><!-- /.content -->