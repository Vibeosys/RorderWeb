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

<html>
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
     
</head>


<body class="nav-md">

  <div class="container body">


    <div class="main_container">

      <div class="col-md-3 left_col">
        <div class="left_col scroll-view">

          <div class="navbar nav_title" style="border: 0;">
            <a href="" class="site_title">
                 <?= $this->Html->image('quickserve-small-logo.png', ['style' => ' width: 55px;'])?>
                 <span>QuickeServe</span></a>
          </div>
          <div class="clearfix"></div>

          <!-- menu prile quick info -->
          <div class="profile">
            <div class="profile_pic">
                 <?= $this->Html->image('quickserve-admin-img.jpg', ['class' => 'img-circle profile_img','alt' => '...'])?>
            </div>
            <div class="profile_info">
              <span>Welcome,</span>
              <h2>Admin</h2>
            </div>
          </div>
          <!-- /menu prile quick info -->

          <br />

          <!-- sidebar menu -->
          <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">

            <div class="menu_section">
           <h3>&nbsp;</h3>
              <ul class="nav side-menu">
                <li class="active"><a href=""><i class="fa fa-home"></i> Dashboard </a>
                </li>
                <li><a><i class="fa fa-edit"></i> Order <span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu" style="display: none">
                    <li><a>Table View</a>
                    </li>
                    <li><a href="">Dine-In</a>
                    </li>
                    <li><a href="">Takeaway</a>
                    </li>
                    <li><a href="">Home-Delivery</a>
                    </li>
                    <li><a href="">Manage Table</a>
                    </li>
                    <li><a href="">Table Category</a>
                    </li>
                  </ul>
                </li>
                <li><a><i class="fa fa-cutlery"></i> Kitchen <span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu" style="display: none">
                    <li><a href="">Menu</a>
                    </li>
                    <li><a href="">Recipe</a>
                    </li>
                    <li><a href="">Menu Category</a>
                    </li>
                    <li><a href="">Recipe Category</a>
                    </li>
                    <li><a href="">Kitchen/Printers</a>
                    </li>
                  </ul>
                </li>
                <li><a><i class="fa fa-table"></i> Inventory Management <span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu" style="display: none">
                    <li><a href="tables.html">Stock Upload</a>
                    </li>
                    <li><a href="tables_dynamic.html">Stock Modification</a>
                    </li>
					<li><a href="tables_dynamic.html">Stock Taking</a>
                    </li>
                  </ul>
                </li>
                <li><a><i class="fa fa-bar-chart-o"></i> Reports <span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu" style="display: none">
                    <li><a href="chartjs.html">Reports 1</a>
                    </li>
                    <li><a href="chartjs2.html">Reports 2</a>
                    </li>
                    <li><a href="morisjs.html">Reports3</a>
                    </li>
                    <li><a href="echarts.html">Reports 4 </a>
                    </li>
                    <li><a href="other_charts.html">Reports 5</a>
                    </li>
                  </ul>
                </li>
           
           
                <li><a><i class="fa fa-bug"></i> Manage Restaurant <span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu" style="display: none">
                    <li><a href="e_commerce.html">Edit Info</a>
                    </li>
                    <li><a href="projects.html">Users</a>
                    </li>
                    <li><a href="project_detail.html">Devices</a>
                    </li>
                    <li><a href="contacts.html">Configration</a>
                    </li>
                    
                  </ul>
                </li>
               
              </ul>
            </div>

          </div>
          <!-- /sidebar menu -->
        </div>
      </div>

      <!-- top navigation -->
      <div class="top_nav">

        <div class="nav_menu">
          <nav class="" role="navigation">
            <div class="nav toggle">
              <a id="menu_toggle"><i class="fa fa-bars"></i></a>
            </div>

            <ul class="nav navbar-nav navbar-right">
              <li>
                <a href="" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                     <?= $this->Html->image('quickserve-admin-img.jpg', ['alt' => ''])?>
                  Admin
                  <span class=" fa fa-angle-down"></span>
                </a>
                <ul class="dropdown-menu dropdown-usermenu animated fadeInDown pull-right">
                  <li><a href="">  Profile</a>
                  </li>
                  
                  <li><a href="logout"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
                  </li>
                </ul>
              </li>


            </ul>
          </nav>
        </div>

      </div>
      <!-- /top navigation -->

        <!-- footer content -->

        <!-- /footer content -->
      </div>
      <!-- /page content -->

    </div>
    <div class="content-wrapper margin-constant">
           <?php if($this->fetch('content')){
                         echo $this->fetch('content');
                      }else{
                         echo 'content block not set';
                      }
           ?>
    </div>
    
    <!-- old js  -->
        <?= $this->Html->script('jQuery-2.1.4.min.js') ?>
        <?= $this->Html->script('bootstrap.min.js') ?> 
        <?= $this->Html->script('jQuery-cookie.js') ?>
        <?= $this->Html->script('vb-script-1.js') ?>
        <?= $this->Html->script('bootstrap-tagsinput.js') ?>
        <?= $this->Html->script('jquery.dataTables.js') ?> 
        <?= $this->Html->script('dataTables.bootstrap.min.js') ?> 
        <?= $this->Html->script('jquery.slimscroll.min.js') ?> 
        <?= $this->Html->script('Script.js') ?> 
       
    <!-- new js  -->
     <?= $this->Html->script('design/jquery.min.js') ?> 
        <?= $this->Html->script('design/custom.js') ?> 
  
<script>
    
     function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    var expires = "expires="+d.toUTCString();
    document.cookie = cname + "=" + cvalue + "; " + expires +';domain='+<?php echo DOMAIN?>;
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
<!-- Begin Inspectlet Embed Code -->
<script type="text/javascript" id="inspectletjs">
window.__insp = window.__insp || [];
__insp.push(['wid', 865249698]);
(function() {
function ldinsp(){if(typeof window.__inspld != "undefined") return; window.__inspld = 1; var insp = document.createElement('script'); insp.type = 'text/javascript'; insp.async = true; insp.id = "inspsync"; insp.src = ('https:' == document.location.protocol ? 'https' : 'http') + '://cdn.inspectlet.com/inspectlet.js'; var x = document.getElementsByTagName('script')[0]; x.parentNode.insertBefore(insp, x); };
setTimeout(ldinsp, 500); document.readyState != "complete" ? (window.attachEvent ? window.attachEvent('onload', ldinsp) : window.addEventListener('load', ldinsp, false)) : ldinsp();
})();
</script>
<!-- End Inspectlet Embed Code -->


</body>
</html>
