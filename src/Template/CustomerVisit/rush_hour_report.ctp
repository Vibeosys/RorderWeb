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

                            <li class="active">Customer Rush Report</li>
<?php $this->end('breadcrum'); ?>
 <?php $this->start('layout_change');?> 
 <?php $this->end('layout_change'); ?>                            
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
                  <div class="x_content" style="height: 400px">
                  <div id="graph_donut"></div>
                </div>
              </div>
              </div>           
          </div>

 <?php $this->start('script');?>
<script type="text/javascript">
             $.ajax({
                        url: "/customervisitreport?id=" + ' <?= $rest ?>',
                        type: "POST",
                        contentType: false,
                        cache: false,
                        processData: false,
                        success: function (result, jqXHR, textStatus) {
                            if (result) {
                                var chart = new CanvasJS.Chart("graph_donut",
                                {
                                        title:{
                                                text: ""
                                        },
                                        exportFileName: "Pie Chart",
                                        exportEnabled: true,
                                        animationEnabled: true,
                                        legend:{
                                                verticalAlign: "bottom",
                                                horizontalAlign: "center"
                                        },
                                        data: [
                                        {       
                                                type: "pie",
                                                showInLegend: true,
                                                toolTipContent: "{legendText}: <strong>{y}%</strong>",
                                                indexLabel: "{label} {y}%",
                                                dataPoints: result
                                }
                                ]
                                });
                                chart.render();
                            } else {
                                $.post('/chartnotfound',{},function(result){
                                    $('#graph_donut').html(result);
                                });
                            }
                        },
                        error: function (jqXHR, textStatus, errorThrown) {
                                 $.post('/chartnotfound',{},function(result){
                                    $('#graph_donut').html(result);
                                }); 
                        }});
 </script>    
 <?php $this->end('script'); ?>