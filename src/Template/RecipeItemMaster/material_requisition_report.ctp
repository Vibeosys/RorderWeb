<?php
    use Cake\Cache\Cache;
    use Cake\Core\Configure;
    use Cake\Datasource\ConnectionManager;
    use Cake\Error\Debugger;
    use Cake\Network\Exception\NotFoundException;
    use App\Controller;

    $this->layout = false;
    if(isset($limit)){
     $this->layout = 'rorder_layout';
     $this->assign('title', 'Restaurant Material Requisition Report');
     }
     //$this->start('content');
?>          <?php if(isset($limit)) {?>
            <section class="content-header">
            <h1>
                  Restaurant Material Requisition Report
            </h1>
            <ol class="breadcrumb">
                <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Material Requisition Report</li>
            </ol>
            </section>
            <section class="content">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box">                           
                            <section class="content content-div show-add-section">
                                <div class="back-btn" style="margin-top: 10px"> 
                                 
                                </div>
                                <?php }?>
                                    <section class="stock-section" id="msu" style="margin-top:50px">  
                                   <div class="material-requisition" style="">
                                       <div class="graph-head">Material Requisition Report <a  onclick="alert('Work In Progress')">Download</a></div>   
                                    <div class="box-body show-grid-section">
                               
                                    </div>          
                                    </div> 
 
                                </section>
                                   <?php if(isset($limit)) {?>
                            </section>
                        </div><!-- /.box -->                       
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </section><!-- /.content -->
    
 <?php $this->start('script'); ?>  
            <?php }?> 
   <script>
      
    $(document).ready(function(){
     
         var htmlc = '';
         var loading = '<div id="loading-image"><img src="../img/quickserve-big-loading.gif" alt="Loading..." /></div>';
         $('.show-grid-section').html(loading);
         $.post('/ajax/materialrequisitionreport',{},function(result){
             htmlc += '<table id="destination" class="table table-bordered table-hover">';
             htmlc += '<thead><tr>';
             htmlc += '<th>Material Code</th>';
             htmlc += '<th class="title-width">Material</th>';
             htmlc += '<th class="lat-width">Stock</th>';
             htmlc += '<th class="lat-width">Reorder Stock</th>';
             htmlc += '<th class="lat-width">Unit</th>';
             htmlc += '</tr></thead><tbody>';
            if(result){
                $.each(result,function(key,value){
                    if(value.qty <= value.rLevel){
                    htmlc += '<tr style="color: red">';
                }else{ htmlc += '<tr style="color: green">';
                }
                    htmlc += '<td>' + value.itemId + '</td>'
                    htmlc += '<td class="title-width">' + value.itemName + '</td>';
                    htmlc += '<td class="lat-width">' + value.qty + '</td>';
                    htmlc += '<td class="lat-width">' + value.rLevel + '</td>';
                    htmlc +=     '<td class="lat-width">' + value.unit + '</td></tr>';
                });
                htmlc += '</tbody></table>'; 
                $('.show-grid-section').html(htmlc);
            }else{
                alert('Error..! Not Upload');
           }
        });
 });
  </script> 
  <?php if(isset($limit)) {?>
  <?php $this->end('script'); ?>
      <?php }?>       