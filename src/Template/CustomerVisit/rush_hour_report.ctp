<?php
    use Cake\Cache\Cache;
    use Cake\Core\Configure;
    use Cake\Datasource\ConnectionManager;
    use Cake\Error\Debugger;
    use Cake\Network\Exception\NotFoundException;
    use App\Controller;

    
     $this->layout = 'rorder_layout';
     $this->assign('title', 'Restaurant Customer Rush Hours');
?>    
<?php $this->start('breadcrum');?>
      <ol class="breadcrumb">
                            <li><a href="../" class="red">Dashboard</a></li>
                            <li><a href="../reports" class="red">Reports</a></li>
                            <li class="active">Customer Rush Report</li>
                    </ol>
<?php $this->end('breadcrum'); ?>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Customer Rush Hours Report</h2>
                  <ul class="nav navbar-right panel_toolbox">
                    <li><a href="#"><i class="fa fa-download"></i> Download</a>
                    </li>
                  </ul>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  <div id="custRushHours"></div>
                </div>
              </div>
              </div>           
          </div>

 <?php $this->start('script');?>
<script type="text/javascript">
             $.ajax({
                        url: "/customervisitreport?id=" + '<?= $rest ?>',
                        type: "POST",
                        contentType: false,
                        cache: false,
                        processData: false,
                        success: function (result, jqXHR, textStatus) {
                            if (result) {
                             Morris.Donut({
                                element: 'custRushHours',
                                data: result,
                                colors: ['#26B99A', '#34495E', '#ACADAC', '#3498DB'],
                                formatter: function (y) {
                                    return y 
                                }
                            });   
                                   
                            } else {
                                $.get('/notfound',{},function(result){
                                    $('#custRushHours').html(result);
                                });
                            }
                        },
                        error: function (jqXHR, textStatus, errorThrown) {
                                 $.get('/notfound',{},function(result){
                                    $('#custRushHours').html(result);
                                });
                        }});
 </script>    
 <?php $this->end('script'); ?>