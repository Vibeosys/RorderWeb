<?php
    use Cake\Cache\Cache;
    use Cake\Core\Configure;
    use Cake\Datasource\ConnectionManager;
    use Cake\Error\Debugger;
    use Cake\Network\Exception\NotFoundException;
    use App\Controller;

    
     $this->layout = 'rorder_layout';
     $this->assign('title', 'Restaurant Stock Availability');
?>  
<?php $this->start('breadcrum');?>

                          <li class="active">Stock Availability Report</li>
<?php $this->end('breadcrum'); ?>       
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Monthly Sales Report</h2>
                  <ul class="nav navbar-right panel_toolbox">
                    <li><a href="#"><i class="fa fa-download"></i> Download</a>
                    </li>
                  </ul>
                  <div class="clearfix"></div>
                </div>
                  <div class="x_content" id="error_sa">
                  <canvas id="stock_availble"></canvas>
                </div>
              </div>
              </div>           
          </div>
<?php $this->start('script');?>
<script type="text/javascript">
   
    // Bar chart
    var ctx = document.getElementById("stock_availble");
    var mybarChart = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: ["Paneer", "Eggs", "Oil", "Chicken", "Salt", "Milk", "Sugar"],
        datasets: [{
          label: 'Quantity (Kg and Litre)',
          backgroundColor: "#3498DB",
          data: [51, 30, 40, 28, 92, 50, 45]
        }]
      },

      options: {
        scales: {
          yAxes: [{
            ticks: {
              beginAtZero: true
            }
          }]
        }
      }
    });
      
    </script>
     <?php $this->end('script'); ?>       