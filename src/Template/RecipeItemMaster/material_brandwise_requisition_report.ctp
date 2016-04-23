<?php
    use Cake\Cache\Cache;
    use Cake\Core\Configure;
    use Cake\Datasource\ConnectionManager;
    use Cake\Error\Debugger;
    use Cake\Network\Exception\NotFoundException;
    use App\Controller;

       if(isset($limit)){
     $this->layout = 'rorder_layout';
     $this->assign('title', 'Restaurant Material BrandWise Requisition Report');
?>          
             <section class="content-header">
            <h1>
                  Restaurant Material BrandWise Requisition Report
            </h1>
            <ol class="breadcrumb">
                    <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active">Material BrandWise Requisition Report</li>
                </ol>
            </section>
            <section class="content">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box">                           
                            <section class="content content-div show-add-section">
                                <?php } ?>
                                <section class="stock-section" id="msu" style="margin-top:50px">
                                   <div class="material-requisition" style="">
                                       <div class="graph-head">Material BrandWise Requisition Report <a  onclick="alert('Work In Progress')">Download</a></div>   
                                       <div id="bw-req" class="box-body show-grid-section">
                                
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
         $('#bw-req').html(loading);
         $.post('/ajax/materialbwrequisitionreport',{},function(result){
             htmlc += '<table id="destination" class="table table-bordered table-hover">';
             htmlc += '<thead><tr>';
             htmlc += '<th>Brand Code</th>';
             htmlc += '<th class="title-width">Brand</th>';
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
                    htmlc += '<td>' + value.brandCode + '</td>';
                    htmlc += '<td>' + value.brand + '</td>';
                    htmlc += '<td class="title-width">' + value.item + '</td>';
                    htmlc += '<td class="lat-width">' + value.stock + '</td>';
                    htmlc += '<td class="lat-width">' + value.rstock + '</td>';
                    htmlc +=     '<td class="lat-width">' + value.unit + '</td></tr>';
                });
                htmlc += '</tbody></table>'; 
                $('#bw-req').html(htmlc);
            }else{
                 var error = '<div class="right_col" role="main">' +
                                '<section class="fil-not-found">' +
                                    '<div class="container">' +
                                        '<div class="row">' +
                                            '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">' +
                                            '<img src="../img/sad.png" >' +
                                            '<h1 class="e-msg">Sorry!  </h1>' +
                                            '<h3> Information </h3> <h1> not found.</h1>' +
                                            '</div></div></div></section></div>';
               $('#bw-req').html(error);                     
           }
        });
 });
  </script> 
  <?php if(isset($limit)) {?>
  <?php $this->end('script'); ?>
      <?php }?>   
           