<?php

use Cake\Cache\Cache;
    use Cake\Core\Configure;
    use Cake\Datasource\ConnectionManager;
    use Cake\Error\Debugger;
    use Cake\Network\Exception\NotFoundException;
    use App\Controller;

    $this->layout = false;
    $this->layout = 'rorder_layout';
    $this->assign('title', 'Table View');
    //$this->assign('script','var loading=\'<div id="loading-image"><img src="../img/quickserve-big-loading.gif" alt="Loading..." /></div>\';$(".table-list").html(loading),$.ajax({url:"/gettables",type:"POST",contentType:!1,cache:!1,processData:!1,success:function(e,t,a){if(e){var s="";$.each(e,function(e,t){s=t.isOccupied?s+\'<div class="print-table-button col-xs-2" onclick="perform(\'+t.tableId+\')" style="border-bottom: 8px solid rgba(247, 0, 0, 0.48);">\'+t.tableNo+" </div>":s+\'<div class="print-table-button col-xs-2" onclick="perform(\'+t.tableId+\')" style="border-bottom: 8px solid rgba(0, 128, 0, 0.55);">\'+t.tableNo+" </div>",$(".table-list").html(s)})}else{var s=\'<div class="error-message"><div class="error-img"></div><span class="error-text">Requested data not found</span></div>\';$(".table-list").html(s)}},error:function(e,t,a){var s=\'<div class="error-message"><div class="error-img"></div><span class="error-text">Requested data not found</span></div>\';$(".table-list").html(s)}});');
?>

<section class="content-header">
    <h1>
        Restaurant Table View
    </h1>
    <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Table View</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box"> 
               
                <section class="content content-div show-add-section">
                    <div class="row">
                        <div class="table-list">    
                                   
                        </div>
                    </div>
                </section>
            </div><!-- /.box -->                       
        </div><!-- /.col -->
    </div><!-- /.row -->
</section><!-- /.content -->
<div id="popup" class="modal animated zoomin"> 
    <div class="modal-dialog mail" >
        <div class="modal-content" id="show">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <div class="heading" id="head">
            </div>
            <div class="message" id="msg">
            </div>
        </div>
        </div>
</div>
<input type="text" class="hidden" id="option" value="<?= $option ?>">
<?php $this->start('script');?>
<script>
var loading = '<div id="loading-image"><img src="../img/quickserve-big-loading.gif" alt="Loading..." /></div>' 
      $('.table-list').html(loading);
 $.ajax({
                        url: "/gettables",
                        type: "POST",
                        contentType: false,
                        cache: false,
                        processData: false,
                        success: function (result, jqXHR, textStatus) {
                            if (result) {
                                  var printhtml = '';
                               $.each(result, function(idx, obj){
                                   if(obj.isOccupied){
                                    printhtml = printhtml + '<div class="print-table-button col-xs-2" onclick="perform(' +obj.tableId +')" style="border-bottom: 8px solid rgba(247, 0, 0, 0.48);">'
                                                        +  obj.tableNo +' </div>'; 
                                   }else{
                                  
                                    printhtml = printhtml + '<div class="print-table-button col-xs-2" onclick="perform(' +obj.tableId +')" style="border-bottom: 8px solid rgba(0, 128, 0, 0.55);">'
                                                      +  obj.tableNo +' </div>'; 
                                   }
                               $('.table-list').html(printhtml);
                               });
                            } else {
                                var printhtml = '<div class="error-message"><div class="error-img"></div><span class="error-text">Requested data not found</span></div>';
                            $('.table-list').html(printhtml);
                            }
                        },
                        error: function (jqXHR, textStatus, errorThrown) {
                            var printhtml = '<div class="error-message"><div class="error-img"></div><span class="error-text">Requested data not found</span></div>';
                            $('.table-list').html(printhtml);
                        }});


</script>

<?php $this->end('script'); ?>