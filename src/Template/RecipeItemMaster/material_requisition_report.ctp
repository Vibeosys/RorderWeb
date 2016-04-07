<?php
    use Cake\Cache\Cache;
    use Cake\Core\Configure;
    use Cake\Datasource\ConnectionManager;
    use Cake\Error\Debugger;
    use Cake\Network\Exception\NotFoundException;
    use App\Controller;

    $this->layout = false;
     $this->layout = 'rorder_inventory_layout';
     $this->assign('title', 'Restaurant Material Requisition Report');
     $this->assign('breadcrum', ' <ol class="breadcrumb">
                    <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active">Material Stock Upload</li>
                </ol>');
     //$this->start('content');
?>
            <section class="content">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box">                           
                            <section class="content content-div show-add-section">
                                <div class="back-btn" style="margin-top: 10px"> 
                                   <a href="../inventory/stockinventoryreport" > << Back </a>
                                </div>
                              
                                <section class="stock-section" id="msu" style="margin-top:50px">
                                   <div class="material-requisition" style="">
                                       <div class="graph-head">Material Requisition Report <a  onclick="alert('Work In Progress')">Download</a></div>   
                                    <div class="box-body show-grid-section">
                                <table id="destination" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Material Code</th>
                                            <th class="title-width">Material</th>
                                            <th class="lat-width">Stock</th>
                                            <th class="lat-width">Reorder Stock</th>
                                            <th class="lat-width">Unit</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr style="color: red">
                                            <td>1001</td>
                                            <td class="title-width">
                                                Paneer
                                            </td>
                                            <td class="lat-width">10</td>
                                            <td class="lat-width">12</td>
                                            <td class="lat-width">Kg</td>
                                        </tr>
                                        <tr style="color: red">
                                            <td>1002</td>
                                            <td class="title-width">
                                                Cottage Cheese
                                            </td>
                                            <td class="lat-width">4</td>
                                            <td class="lat-width">5</td>
                                            <td class="lat-width">Kg</td>
                                        </tr>
                                        <tr style="color: green">
                                            <td>1003</td>
                                            <td class="title-width">
                                                Oil
                                            </td>
                                            <td class="lat-width">10</td>
                                            <td class="lat-width">10</td>
                                            <td class="lat-width">Litre</td>
                                        </tr>
                                        <tr style="color: red">
                                            <td>1004</td>
                                            <td class="title-width">
                                                Cashew
                                            </td>
                                            <td class="lat-width">2</td>
                                            <td class="lat-width">3</td>
                                            <td class="lat-width">Kg</td>
                                        </tr>
                                        <tr style="color: red">
                                            <td>1005</td>
                                            <td class="title-width">
                                                Tomato
                                            </td>
                                            <td class="lat-width">10</td>
                                            <td class="lat-width">12</td>
                                            <td class="lat-width">Kg</td>
                                        </tr>
                                        <tr style="color: green">
                                            <td>1006</td>
                                            <td class="title-width">
                                                Onion
                                            </td>
                                            <td class="lat-width">10</td>
                                            <td class="lat-width">10</td>
                                            <td class="lat-width">Kg</td>
                                        </tr>
                                        <tr style="color: red">
                                            <td>1007</td>
                                            <td class="title-width">
                                                eggs
                                            </td>
                                            <td class="lat-width">50</td>
                                            <td class="lat-width">80</td>
                                            <td class="lat-width">Unit</td>
                                        </tr>
                                        <tr style="color: red">
                                            <td>1008</td>
                                            <td class="title-width">
                                                Fish
                                            </td>
                                            <td class="lat-width">20</td>
                                            <td class="lat-width">25</td>
                                            <td class="lat-width">Unit</td>
                                        </tr>
                                        <tr style="color: green">
                                            <td>1009</td>
                                            <td class="title-width">
                                                Chicken
                                            </td>
                                            <td class="lat-width">5</td>
                                            <td class="lat-width">5</td>
                                            <td class="lat-width">Kg</td>
                                        </tr>
                                        <tr style="color: red">
                                            <td>1010</td>
                                            <td class="title-width">
                                                Ginger
                                            </td>
                                            <td class="lat-width">1</td>
                                            <td class="lat-width">2</td>
                                            <td class="lat-width">Kg</td>
                                        </tr>
                                        <tr style="color: red">
                                            <td>1011</td>
                                            <td class="title-width">
                                                White Flower
                                            </td>
                                            <td class="lat-width">20</td>
                                            <td class="lat-width">25</td>
                                            <td class="lat-width">Kg</td>
                                        </tr>
                                        <tr style="color: green">
                                            <td>1012</td>
                                            <td class="title-width">
                                                Mutton
                                            </td>
                                            <td class="lat-width">5</td>
                                            <td class="lat-width">5</td>
                                            <td class="lat-width">Kg</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>          
                                    </div>  
                                </section>
                            </section>
                        </div><!-- /.box -->                       
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </section><!-- /.content -->
            
           