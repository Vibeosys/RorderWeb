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
    <?= $this->Html->css('https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css') ?>
    <?= $this->Html->css('https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css') ?>
    <?= $this->Html->css('dataTables.bootstrap.css') ?>
    <?= $this->Html->css('bootstrap-tagsinput.css') ?>
    <?= $this->Html->css('Style.css') ?>
    <?= $this->Html->css('All-skins.css') ?>
   
     <!-- new css  -->
 <?= $this->Html->css('design/animate.min.css') ?>
    <?= $this->Html->css('design/custom.css') ?>
    <?= $this->Html->css('design/font-awesome.css') ?>
    <?= $this->Html->css('design/admin.style.css') ?>
     
  <link href="../css/design/animate.min.css" rel="stylesheet">

  

</head>


<body class="nav-md">

  <div class="container container-page body">


    <div class="main_container">

 
      <div class="col-md-3 left_col scrollbar" id="style-1">
        <div class="left_col scroll-view">

          <div class="navbar nav_title" style="border: 0;">
            <a href="index.html" class="site_title"> <?= $this->Html->image('quickserve-small-logo.png', ['style' => ' width: 55px;'])?> <span>QuickeServe</span></a>
          </div>
          <div class="clearfix"></div>


          <!-- sidebar menu -->
            
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">

            <div class="menu_section">
              <h3>&nbsp;</h3>
           
              <ul class="nav side-menu">
                <li class="active"><a href="#"><i class="fa fa-home"></i> Dashboard </a>
                </li>
                <li><a><i class="fa fa-edit"></i> Order <span  class="fa fa-chevron-down fa-down-arrow"></span></a>
                 <ul class="nav child_menu" style="display: none">
                     <li class="child-plus"><a data-toggle="collapse" href="#submenu-table"  aria-expanded="false" aria-controls="collapseExample">Table View <i class="fa fa-chevron-down fa-down-arrow"></i> <i class="fa  fa-chevron-right fa-down-arrow1"></i></a>
                        
                          <div class="collapse" id="submenu-table">
                            <ul class="nav child_menu sub-child-menu">
                               <li><a href="../tableview/placeorder">Place Order</a>                      
                                  </li>
                                 <li><a href="../tableview/generatebill">Generate Bill</a>
                                </li>
                                <li><a href="../tableview/cancelorder">Cancel Order</a>
                                </li>
                                <li><a href="../tableview/printkot">Print KOT</a>
                                </li>
                                <li><a href="../tableview/printbill">Print Bill</a>
                                </li>
                              </ul>
                         </div>
                      </li>
                     
                    <li class="child-plus"><a data-toggle="collapse" href="#submenu-table2"  aria-expanded="false" aria-controls="collapseExample">Takeaway<i class="fa fa-chevron-down fa-down-arrow"></i><i class="fa  fa-chevron-right fa-down-arrow1"></i></a>
                        
                        
                          <div class="collapse" id="submenu-table2">
                            <ul class="nav child_menu sub-child-menu">
                                                                   <li><a href="../takeaway/placeorder">Place Order</a>                      
                                  </li>
                                 <li><a href="../takeaway/generatebill">Generate Bill</a>
                                </li>
                                <li><a href="../takeaway/cancelorder">Cancel Order</a>
                                </li>
                                <li><a href="../takeaway/printkot">Print KOT</a>
                                </li>
                                <li><a href="../takeaway/printbill">Print Bill</a>
                                </li>
                              </ul>
                         </div>
                        
                        
                        
                        
                    </li>
                    <li class="child-plus"><a data-toggle="collapse" href="#submenu-table3" aria-expanded="false" aria-controls="collapseExample">Home-Delivery<i class="fa fa-chevron-down fa-down-arrow"></i><i class="fa  fa-chevron-right fa-down-arrow1"></i></a>
                                                
                          <div class="collapse" id="submenu-table3">
                            <ul class="nav child_menu sub-child-menu">
                                                                   <li><a href="../delivery/placeorder">Place Order</a>                      
                                  </li>
                                 <li><a href="../delivery/generatebill">Generate Bill</a>
                                </li>
                                <li><a href="../delivery/cancelorder">Cancel Order</a>
                                </li>
                                <li><a href="../delivery/printkot">Print KOT</a>
                                </li>
                                <li><a href="../delivery/printbill">Print Bill</a>
                                </li>
                              </ul>
                         </div>
                        
                        
                    </li>
                   <li><a href="../rtables">Manage Table</a>
                    </li>
                    <li><a href="../tablecategory/addnewtablecategory">Table Category</a>
                    </li>
                  </ul>
                </li>
                
                <li><a><i class="fa fa-cutlery"></i> Kitchen <span  class="fa fa-chevron-down fa-down-arrow "></span></a>
                  <ul class="nav child_menu" style="display: none">
                  <li><a href="../menu">Menu</a>
                    </li>
                    <li><a href="../kitchen/recipe">Recipe</a>
                    </li>
                    <li><a href="../menucategory/addnewmenucategory" >Menu Category</a>
                    </li>
                    <li><a href="../kitchen/recipecategory">Recipe Category</a>
                    </li>
                    <li><a href="../kitchen/printers">Kitchen/Printers</a>
                    </li>
                  </ul>
                </li>
                <li><a><i class="fa fa-table"></i>  Inventory Management <span  class="fa fa-chevron-down fa-down-arrow"></span></a>
                  <ul class="nav child_menu" style="display: none">
                     <li class="stock-upload child-plus"><a data-toggle="collapse" href="#submenu-upload" aria-expanded="false" aria-controls="collapseExample">Stock Upload<i class="fa fa-chevron-down fa-down-arrow"></i><i class="fa  fa-chevron-right fa-down-arrow1"></i></a>
                          <div class="collapse" id="submenu-upload">
                         <ul class="nav child_menu submenu-stock-upload sub-child-menu">
                                  <li><a href="../inventory/materialstockupload">Material Stock Upload</a>                      
                                  </li>
                                 <li><a href="../inventory/materialbrandstockupload">Material Brand Stock Upload</a>
                                </li>
                                
                              </ul>
                         </div>
                    </li>
                    <li class="child-plus"><a  data-toggle="collapse" href="#submenu-modify" aria-expanded="false" aria-controls="collapseExample"s>Stock Modification<i class="fa fa-chevron-down fa-down-arrow"></i><i class="fa  fa-chevron-right fa-down-arrow1"></i></a>
                         <div class="collapse" id="submenu-modify">
                        <ul class="nav child_menu sub-child-menu">
                                <li><a href="../inventory/materialstockmodification">Material Stock Modification</a>                      
                                  </li>
                                 <li><a href="../inventory/materialbrandstockmodification">Material Brand Stock Modification</a>
                                </li>
                              </ul>
                        </div>
                    </li>
		<li><a href="../stocktaking">Stock Taking</a>
                    </li>
                  </ul>
                </li>
                 <li><a><i class="fa fa-bar-chart-o"></i> Reports <span  class="fa fa-chevron-down fa-down-arrow"></span></a>
                  <ul class="nav child_menu" style="display: none">
                                      <li><a href="../reports/transactionreport">Transaction Report</a>
                    </li>
                    <li><a href="../reports/orderleadtime">Order lead time Report</a>
                    </li>
                    <li><a href="../reports/salesreport">Sales Report</a>
                    </li>
                    <li><a href="../reports/salesforcast">Sales forcast Report</a>
                    </li>
                    <li><a href="../reports/leadtineforcast">Lead tine forcast Report</a>
                    </li>
                      <li><a href="../reports/favouratemenu">Favourate menu Report</a>
                    </li>
                      <li><a href="../reports/customerrushhour">Customer Rush hours Report</a>
                    </li>
                      <li><a href="../reports/perstawordssales">Per stawords sales Report</a>
                    </li>
                      <li><a href="../reports/stockavailability">Stock availability  Report</a>
                    </li>
                      <li><a href="../reports/stawordsperformance">Stawords performance Report</a>
                    </li>
                      <li><a href="../inventory/materialrequisitionreport">Material Requisition  Report</a>
                    </li>
                      <li><a href="../inventory/materialbrandwiserequisitionreport">Brandwise material Requisition Report</a>
                    </li>
                  </ul>
                </li>
                  <li><a><i class="fa fa-bug"></i> Manage Restaurant <span  class="fa fa-chevron-down fa-down-arrow"></span></a>
                  <ul class="nav child_menu" style="display: none">
                   <li><a href="../manage/edit">Edit Info</a>
                    </li>
                    <li><a href="../manage/users">Users</a>
                    </li>
                    <li><a href="../manage/devices">Devices</a>
                    </li>
                    <li><a href="../manage/configuration">Configration</a>
                    </li>
                   
                  </ul> 
                </li>
              </ul>
            </div>
              
          </div> <!-- /sidebar menu -->
        
         
          <!-- /menu footer buttons -->
        </div>
      </div>
        
        
      <!-- top navigation -->
      <div class="top_nav">

        <div class="nav_menu">
          <nav class="" role="navigation">
            <div class="nav toggle">
              <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                <h2 class="page-heading"><?= $this->fetch('heading')?></h2>
                
            </div>
               

            <ul class="nav navbar-nav navbar-right">
                <li>
                 <?php if($this->fetch('breadcrum')){
                         echo $this->fetch('breadcrum');
                      }?>
                    </li>
                  <li>
                <a href="" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                  <?= $this->Html->image('quickserve-admin-img.jpg', ['class' => '','alt' => '...'])?>Admin
                  <span class=" fa fa-angle-down"></span>
                </a>
                <ul class="dropdown-menu dropdown-usermenu animated fadeInDown pull-right">
                  <li><a href="">  Profile</a>
                  </li>
                  
                  <li><a href=""><i class="fa fa-sign-out pull-right"></i> Log Out</a>
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
           <?php if($this->fetch('content')){
                         echo $this->fetch('content');
                      }else{
                         
                      }
           ?>
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
          <?= $this->Html->script('fusioncharts.js') ?> 
        <?= $this->Html->script('fusioncharts.theme.fint.js') ?> 
    <!-- new js  -->
        <?= $this->Html->script('design/custom.js') ?> 
    <?php if($this->fetch('script')){
                         echo $this->fetch('script');
                      }else{
                         
                      }
           ?>
      </div>
    </div>
 <!--
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
-->
</body>
</html>
