<?php

use Cake\Cache\Cache;
use Cake\Core\Configure;
use Cake\Datasource\ConnectionManager;
use Cake\Error\Debugger;
use Cake\Network\Exception\NotFoundException;
use App\Controller;

$this->layout = false;
$page = $this->fetch('page');
$sec = $this->fetch('sec');
?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>QuickServe | <?= $this->fetch('title')?></title>
     <?= $this->Html->meta ( 'favicon.ico', '/favicon.ico', array ('type' => 'icon' ) )?>
    <?= $this->Html->meta(
    'viewport',
    'width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no')?>
 <?= $this->Html->meta(
    'keyword',
    'Popular Restaurant Billing Software,Popular Wireless Restaurant Ordering Software,Popular Pos for Restaurant, Popular Hotel Management System')?>
        <!-- old css  -->
    <?= $this->Html->css('vb-menu-style.css') ?> 
    <?= $this->Html->css('bootstrap.min.css') ?> 
    <?= $this->Html->css('design/font-awesome.min.css') ?>
    <?= $this->Html->css('https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css') ?>
    <?= $this->Html->css('dataTables.bootstrap.css') ?>
    <?= $this->Html->css('bootstrap-tagsinput.css') ?>
    <?= $this->Html->css('Style.css') ?>
    <?= $this->Html->css('All-skins.css') ?>

        <!-- new css  -->
 <?= $this->Html->css('design/animate.min.css') ?>
    <?= $this->Html->css('design/custom.css') ?>
    <?= $this->Html->css('design/bootstrap-fileupload.min.css') ?>
    <?= $this->Html->css('design/font-awesome.css') ?>
    <?= $this->Html->css('design/admin.style.css') ?>
    <?= $this->Html->css('design/icheck/flat/green.css') ?>
    <?= $this->Html->css('design/select/select2.min.css') ?>
    <?= $this->Html->css('design/chartist.min.css') ?>
    <?= $this->Html->css('design/datatables/jquery.dataTables.min.css') ?>
    <?= $this->Html->css('design/datatables/buttons.bootstrap.min.css') ?>
    <?= $this->Html->css('design/datatables/responsive.bootstrap.min.css') ?>
    </head>


    <body class="nav-md">

        <div class="container container-page body">


            <div class="main_container">


                <div class="col-md-3 left_col scrollbar" id="style-1">
                    <div class="left_col scroll-view">

                        <div class="navbar nav_title" style="border: 0;">
                            <a href="../../" class="site_title"> <?= $this->Html->image('quickserve-logo.png')?></a>
                        </div>
                        <div class="clearfix"></div>


                        <!-- sidebar menu -->

                        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                            <ul class="nav side-menu list-group" id="accordion">
                               
                                        <li class="panel"><a class="list-group-item" href="../../reports"><i class="fa fa-home"></i> Dashboard </a>
                                        </li>
                                
                                        <li class="panel"><a href="#demo3" class="main-list" data-toggle="collapse" data-parent="#accordion"><i class="fa fa-edit"></i> Order <span  class="fa fa-chevron-right fa-down-arrow  pull-right"></span></a>
                                            <ul class="submenu collapse " id="demo3">
                                                    <li class="panel"><a href="#SubMenu1"class="sub-list" data-toggle="collapse" data-parent="#demo3">Table View <i class="fa fa-chevron-right fa-down-arrow  pull-right"></i> <i class="fa  fa-chevron-right fa-down-arrow1"></i></a>
                                                      
                                                             <ul class="submenu collapse" id="SubMenu1">
                                                                <li><a class="list-group-item" data-parent="#SubMenu1" href="../../tableview/placeorder">Place Order</a>                      
                                                                </li>
                                                                <li><a class="list-group-item" data-parent="#SubMenu1" href="../../tableview/generatebill">Generate Bill</a>
                                                                </li>
                                                                <li><a class="list-group-item" data-parent="#SubMenu1" href="../../tableview/cancelorder">Cancel Order</a>
                                                                </li>
                                                                <li><a class="list-group-item" data-parent="#SubMenu1" href="../../tableview/printkot">Print KOT</a>
                                                                </li>
                                                                <li><a class="list-group-item" data-parent="#SubMenu1" href="../../tableview/printbill">Print Bill</a>
                                                                </li>
                                                            </ul>
                                                      
                                                    </li>

                                                    <li  class="panel"><a href="#SubMenu2" class="sub-list" data-toggle="collapse" data-parent="#demo3">Takeaway <i class="fa fa-chevron-right fa-down-arrow  pull-right"></i> <i class="fa  fa-chevron-right fa-down-arrow1"></i></a>
                                                        <ul class="submenu collapse" id="SubMenu2">
                                                                <li><a class="list-group-item" data-parent="#SubMenu2" href="../../takeaway/placeorder">Place Order</a>                      
                                                                </li>
                                                                <li><a class="list-group-item" data-parent="#SubMenu2" href="../../takeaway/generatebill">Generate Bill</a>
                                                                </li>
                                                                <li><a class="list-group-item" data-parent="#SubMenu2" href="../../takeaway/cancelorder">Cancel Order</a>
                                                                </li>
                                                                <li><a class="list-group-item" data-parent="#SubMenu2" href="../../takeaway/printkot">Print KOT</a>
                                                                </li>
                                                                <li><a class="list-group-item" data-parent="#SubMenu2" href="../../takeaway/printbill">Print Bill</a>
                                                                </li>
                                                           
                                                        </ul>
                                                    </li>

                                                    <li class="panel"><a href="#SubMenu3" class="sub-list" data-toggle="collapse" data-parent="#demo3">Home-Delivery <i class="fa fa-chevron-right fa-down-arrow  pull-right"></i> <i class="fa  fa-chevron-right fa-down-arrow1"></i></a>
                                                        <ul class="submenu collapse" id="SubMenu3">
                                                                <li><a class="list-group-item" data-parent="#SubMenu3" href="../../delivery/placeorder">Place Order</a>                      
                                                                </li>
                                                                <li><a class="list-group-item" data-parent="#SubMenu3" href="../../delivery/generatebill">Generate Bill</a>
                                                                </li>
                                                                <li><a class="list-group-item" data-parent="#SubMenu3" href="../../delivery/cancelorder">Cancel Order</a>
                                                                </li>
                                                                <li><a class="list-group-item" data-parent="#SubMenu3" href="../../delivery/printkot">Print KOT</a>
                                                                </li>
                                                                <li><a class="list-group-item" data-parent="#SubMenu3" href="../../delivery/printbill">Print Bill</a>
                                                                </li>
                                                            
                                                        </ul>
                                                    </li>
                                              
                                            </ul>
                                        </li>

                                        <li class="panel"> <a href="#demo4" class="main-list" data-toggle="collapse" data-parent="#accordion"><i class="fa fa-cutlery"></i>Kitchen <span  class="fa fa-chevron-right fa-down-arrow  pull-right"></span></a>
                                          <ul class="submenu collapse " id="demo4">
                                                    <li><a class="list-group-item" href="../menu">Menu</a>
                                                    </li>
                                                    <li><a class="list-group-item" href="../../menucategory" >Menu Category</a>
                                                    </li>
                                                    <li><a class="list-group-item" href="../../kitchen/printers">Kitchen/Printers</a>
                                                    </li>
                                               
                                            </ul>
                                        </li>
                                        <li class="panel"> <a href="#inventory" class="main-list"  data-toggle="collapse" data-parent="#accordion"><i class="fa fa-table"></i> Inventory Management  <span  class="fa fa-chevron-right fa-down-arrow  pull-right"></span></a>
                                           <ul class="submenu collapse" id="inventory">
                                                    <li class="panel"><a href="#upload" class="sub-list" data-toggle="collapse" data-parent="#inventory">Stock Upload <span  class="fa fa-chevron-right fa-down-arrow  pull-right"></span></a>
                                                        <ul class="submenu collapse" id="upload">
                                                                <li><a class="list-group-item" data-parent="#upload" href="../../inventory/materialstockupload">Material Stock Upload</a>                      
                                                                </li>
                                                                <!--  <li><a href="../../inventory/materialbrandstockupload">Material Brand Stock Upload</a>
                                                                  </li> -->
                                                            
                                                        </ul>

                                                    </li>
                                                    <li class="panel"><a href="#modify" data-toggle="collapse"  class="sub-list" data-parent="#inventory">Stock Modification <span  class="fa fa-chevron-right fa-down-arrow  pull-right"></span></a>
                                                        <ul class="submenu collapse" id="modify">
                                                                <li><a class="list-group-item" data-parent="#modify" href="../../inventory/materialstockmodification">Material Stock Modification</a>                      
                                                                </li>
                                                                <!--   <li><a href="../../inventory/materialbrandstockmodification">Material Brand Stock Modification</a>
                                                                   </li> -->
                                                                </ul>

                                                    </li>
                                                    <li><a class="list-group-item" href="../../stocktaking">Stock Taking</a>
                                                    </li>
                                               
                                            </ul>
                                        </li>

                                        <li class="panel"><a href="#report" class="main-list" data-toggle="collapse" data-parent="#accordion"><i class="fa fa-bar-chart-o"></i>Reports<span  class="fa fa-chevron-right fa-down-arrow  pull-right"></span></a>
                                             <ul class="submenu collapse" id="report">  
                                                    <li><a class="list-group-item" href="../../reports/transactionreport">Transaction Report</a>
                                                    </li>
                                                    <li><a class="list-group-item" href="../../reports/orderleadtime">Order Lead Time Report</a>
                                                    </li>
                                                    <li><a class="list-group-item" href="../../reports/salesreport">Sales Report</a>
                                                    </li>
                                                    <li><a class="list-group-item" href="../../reports/salesforcast">Sales Forecast Report</a>
                                                    </li>
                                                    <li><a class="list-group-item" href="../../reports/leadtineforcast">Lead Time Forecast Report</a>
                                                    </li>
                                                    <li><a class="list-group-item" href="../../reports/favouratemenu">Favourite Menu Report</a>
                                                    </li>
                                                    <li><a class="list-group-item" href="../../reports/customerrushhour">Customer Rush Hours Report</a>
                                                    </li>
                                                    <li><a class="list-group-item" href="../../reports/perstawordssales">Per Stewards Sales Report</a>
                                                    </li>
                                                    <!--  <li><a href="../../reports/stockavailability">Stock availability  Report</a>
                                                    </li> -->
                                                    <li><a class="list-group-item" href="../../reports/stawordsperformance">Stewards Performance Report</a>
                                                    </li>
                                                    <li><a class="list-group-item" href="../../inventory/materialrequisitionreport">Material Requisition  Report</a>
                                                    </li>
                                                    <!-- <li><a href="../../inventory/materialbrandwiserequisitionreport">Brandwise material Requisition Report</a>
                                                   </li> -->
                                               
                                            </ul>
                                        </li>
                                        <li class="panel"><a href="#manage" class="main-list" data-toggle="collapse" data-parent="#accordion"><i class="fa fa-bug"></i>Manage Restaurant <span  class="fa fa-chevron-right fa-down-arrow  pull-right"></span></a>
                                           <ul class="submenu collapse" id="manage">   
                                                    <li><a class="list-group-item" href="../../manage/edit">Edit Info</a>
                                                    </li>
                                                    <li><a class="list-group-item" href="../../manage/users">Users</a>
                                                    </li>
                                                    <li><a class="list-group-item" href="../../rtables">Manage Table</a>
                                                    </li>
                                                    <li><a class="list-group-item" href="../../tablecategory">Table Category</a>
                                                    </li>
                                                    <li><a class="list-group-item" href="../../manage/devices">Devices</a>
                                                    </li>
                                                    <li><a class="list-group-item" href="../../manage/configuration">Configuration</a>
                                                    </li>
                                                
                                            </ul> 
                                        </li>
                             

                            </ul>


                        </div> <!-- /sidebar menu -->


                        <!-- /menu footer buttons -->
                    </div>
                </div>


                <!-- top navigation -->
                <div class="top_nav navbar-fixed-top">

                    <div class="nav_menu">
                        <nav class="" role="navigation">
                            <?= $this->Html->image('quickserve-logo.png', ['class' => 'sm-logo', 'style' => 'float:left;padding:10px;display:none;'])?>
                            
                            <div class="nav toggle">
                                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                                <h2 class="page-heading"><?= $this->fetch('heading')?></h2>
                            </div>
                            <ul class="nav navbar-nav navbar-right">
                                <li class="mobile-hide">
                    <?php if($this->fetch('breadcrum')) {?>
                                    <ol class="breadcrumb mobile-hide">
                                        <li><a class="ttl_link red" href="../../"></a></li>
                                        <li><a href="../reports" class="red">Dashboard</a></li>
                           <?php if($this->fetch('breadcrum')){
                         echo $this->fetch('breadcrum');
                      }?>
                                    </ol>
               <?php }else if($this->fetch('b_yes')){ ?>
                                    <ol class="breadcrumb mobile-hide">
                                        <li><a class="ttl_link red" href="../../"></a></li>
                                        <li class="active">Dashboard</li>
                                    </ol>   
                      <?php }?>

                                </li>
                                <li>
                                    <a href="" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                  <?= $this->Html->image('quickserve-admin-img.jpg', ['class' => '','alt' => '...'])?>Admin
                                        <span class=" fa fa-angle-down"></span>
                                    </a>
                                    <ul class="dropdown-menu dropdown-usermenu animated fadeInDown pull-right">
                                        <li><a href="../../manage/edit">  Profile</a>
                                        </li>
                                        <li><a href="../../logout"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
                                        </li>
                                    </ul>
                                </li>


                            </ul>
                        </nav>
                    </div>

                </div>
                <!-- /top navigation -->
                <!-- /page content -->
                <div class="right_col" role="main">
                    <div class="row">
           <?php if(!$this->fetch('layout_change')){ ?>      
                        <div class="col-md-12 col-sm-12 col-xs-12"> 
                            <div class="x_panel"> 
           <?php } if($this->fetch('head_title')){
                         echo $this->fetch('head_title');
                      }?>
                  <?php if($this->fetch('breadcrum')) {?>
                                <ol class="breadcrumb mobile-show">
                                    <li><a class="ttl_link red" href="../../" ></a></li>
                                    <li><a href="../reports" class="red">Dashboard</a></li>
                           <?php if($this->fetch('breadcrum')){
                         echo $this->fetch('breadcrum');
                      }?>
                                </ol>
               <?php }else if($this->fetch('b_yes')){ ?>
                                <ol style="padding-left: 20px" class="breadcrumb mobile-show">
                                    <li><a class="ttl_link red" href="../../"></a></li>
                                    <li class="active">Dashboard</li>
                                </ol>   
                      <?php }?>    
           <?php if($this->fetch('content')){
                         echo $this->fetch('content');
                      }else{
                         
                      }
           ?>
                       <?php if(!$this->fetch('layout_change')){ ?>      
                            </div>
                        </div> 
                       <?php }?>
                    </div>
                </div>
                <!-- old js  -->
                <!-- scripts-->
         <?= $this->Html->script('design/jquery.min.js') ?> 
        <?= $this->Html->script('design/bootstrap.min.js') ?> 
        <?= $this->Html->script('jQuery-cookie.js') ?>
        <?= $this->Html->script('vb-script-1.js') ?>
        <?= $this->Html->script('jquery.dataTables.js') ?> 
        <?= $this->Html->script('dataTables.bootstrap.min.js') ?> 
        <?= $this->Html->script('jquery.slimscroll.min.js') ?> 
        <?= $this->Html->script('design/custom.js') ?> 
        <?= $this->Html->script('design/chartjs/chart.min.js') ?> 
        <?= $this->Html->script('design/chartjs/donut.js') ?> 
        <?= $this->Html->script('design/chartjs/donut.min.js') ?> 
        <?= $this->Html->script('design/datatables/jquery.dataTables.min.js') ?> 
        <?= $this->Html->script('design/datatables/dataTables.bootstrap.js') ?> 
        <?= $this->Html->script('design/datatables/dataTables.responsive.min.js') ?> 
        <?= $this->Html->script('design/datatables/responsive.bootstrap.min.js') ?> 
        <?= $this->Html->script('design/nicescroll/jquery.nicescroll.min.js') ?> 
         <?= $this->Html->script('design/icheck/icheck.min.js') ?> 
         <?= $this->Html->script('design/select/select2.full.js') ?> 
         <?= $this->Html->script('design/canvasjs.min.js') ?> 
         <?= $this->Html->script('design/highcharts.js') ?> 
         <?= $this->Html->script('design/exporting.js') ?> 
         <?= $this->Html->script('design/scroll-menu.js') ?> 
    <?php if($this->fetch('script')){
                         echo $this->fetch('script');
                      }else{
                         
                      }
           ?>
            </div>
        </div>
        <script type="text/javascript">
            $(document).ready(function () {
                $.post('/getcookie', {name: 'title'}, function (result) {
                    if (result) {

                        $('.ttl_link').text(result);
                    }
                });

                var heading_last = $('table.table-bordered th:last-child').text();
                if (heading_last == 'Action') {
                    $('th:last-child').removeClass('sorting');
                }

            });

        </script>

         <script>
          
              function setCookie(cname, cvalue, exdays) {
             var d = new Date();
             d.setTime(d.getTime() + (exdays*24*60*60*1000));
             var expires = "expires="+d.toUTCString();
             document.cookie = cname + "=" + cvalue + "; " + expires +';domain='+<?php //echo DOMAIN?>;
             }
             function getCookie(cname) {
             var name = cname + "=";
             var ca = document.cookie.split(';');
             for(var i=0; i<ca.length; i++) {
                 var c = ca[i];
                 while (c.charAt(0)===' ') c = c.substring(1);
                 if (c.indexOf(name) === 0) return c.substring(name.length, c.length);
             }
             return "";
             }
             var TempId = getCookie("Vb_Id");
             
             if(!TempId){
             var random = function(){
                 return Math.floor(Math.random() * 3);
             };
              var prefix = ['abc','def','ghi'];
              var middle = ['123','456','768'];
              var suffix = ['rst','uvw','xyz'];
              
              var randomUserId = function(){
                  return prefix[random()] + '-' + middle[random()] + '-' + suffix[random()];
              };
              var TempId = randomUserId();
              setCookie("Vb_Id", TempId);
             }
         
           (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
           (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
           m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
           })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
         
           ga('create', 'UA-76200600-1', 'auto');
           var randomId = TempId;
           ga('set', 'userId', randomId);
           ga('require', 'displayfeatures');
           ga('send', 'pageview');
         
         
         </script> 
         <script type="text/javascript" id="inspectletjs">
         window.__insp = window.__insp || [];
         __insp.push(['wid', 865249698]);
         (function() {
         function ldinsp(){if(typeof window.__inspld != "undefined") return; window.__inspld = 1; var insp = document.createElement('script'); insp.type = 'text/javascript'; insp.async = true; insp.id = "inspsync"; insp.src = ('https:' == document.location.protocol ? 'https' : 'http') + '://cdn.inspectlet.com/inspectlet.js'; var x = document.getElementsByTagName('script')[0]; x.parentNode.insertBefore(insp, x); };
         setTimeout(ldinsp, 500); document.readyState != "complete" ? (window.attachEvent ? window.attachEvent('onload', ldinsp) : window.addEventListener('load', ldinsp, false)) : ldinsp();
         })();
         </script>
       
    </body>
</html>
