<?php
    use Cake\Cache\Cache;
    use Cake\Core\Configure;
    use Cake\Datasource\ConnectionManager;
    use Cake\Error\Debugger;
    use Cake\Network\Exception\NotFoundException;
    use App\Controller;

     $this->layout = FALSE;
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!-- Meta, title, CSS, favicons, etc. -->
  <meta charset="utf-8">
    <?= $this->Html->meta ( 'favicon.ico', '/favicon.ico', array ('type' => 'icon' ) )?>
    <?= $this->Html->meta(
    'viewport',
    'width=device-width, initial-scale=1')?>
 <?= $this->Html->meta(
    'keyword',
    'Popular Restaurant Billing Software,Popular Wireless Restaurant Ordering Software,Popular Pos for Restaurant, Popular Hotel Management System')?>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <title>QuickServe</title>

  <!-- Bootstrap core CSS -->

  <?= $this->Html->css('design/bootstrap.min.css') ?> 
      <?= $this->Html->css('design/font-awesome.min.css') ?>
  <?= $this->Html->css('design/animate.min.css') ?>
    <?= $this->Html->css('design/custom.css') ?>
    <?= $this->Html->css('design/admin.style.css') ?>
    <style>
        .navbar-right{
            margin-right: 1em!important;
        }
    
    </style>
</head>


<body>
 <div class="container container-page body">
     
      <!-- top navigation -->
      <div class="top_nav">

        <div class="nav_menu">
          <nav class="" role="navigation">
            <div class="nav logo">
             <?= $this->Html->image('quickserve-logo.png', ['class'=>'img-responsive', 'alt'=>'QuickServe'])?>
              <div class="error-msg" id="error-msg" style="display:none;">
                <div class="error_left">
                <?= $this->Html->image('error-icon.png', ['class' => 'error-icon'])?>
                </div>
                <div class="error_right">
                <span class="error_text"></span>
                </div>
            </div>
            </div>

            <ul class="nav navbar-nav navbar-right rest-align">
              <li>
                <a href="" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                  <?= $this->Html->image('quickserve-admin-img.jpg', ['alt' => '...'])?>Admin
                  <span class=" fa fa-angle-down"></span>
                </a>
                <ul class="dropdown-menu dropdown-usermenu animated fadeInDown pull-right">
                  <li><a href="">  Profile</a>
                  </li>
                  
                  <li><a href="../logout"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
                  </li>
                </ul>
              </li>


            </ul>
          </nav>
        </div>

      </div>
    </div>
    <section class="welcome">
    <div class=" container-fluid">
        <div class="row">
            <div class="col-lg-12">
            <h3>Welcome !</h3>
            </div>
        </div>
        
        
        </div>
    </section>
    <section>
    <div class="container-fluid">
        <div class="row top_tiles">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
               
                 <?php if(isset($data)) { $i = 1; foreach ($data as $single){ ?>
                    <?php if($i%2 == 0){ ?>
                 <div class="animated flipInY col-lg-4 col-md-6 col-sm-6 col-xs-12 pull-padding">
                   <?php }else { ?>
                    <div class="animated flipInY col-lg-4 col-md-6 col-sm-6 col-xs-12  col-lg-offset-2 pull-padding">
                     <?php   } ?>
                        
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="card-continer">
                            <div class="card-img-continer">
                            <?= $this->Html->image('quickserve-restaurant-default.png', ['class' => 'img-responsive'])?>
                            </div>
                            
                            <div class="card-text-continer card-text-bg">
                            <p class="card-title" id="title<?=$single->restaurantId?>" class="count"><?= $single->title ?></p>
                            <h4 class="card-line"><?= $single->city ?>, <?= $single->country ?></h4>
                            <input type="button" name="resta1" id="<?=$single->restaurantId?>" value="Get Me Inside" class=" btn-rest no-link">
                               
                            </div>
                            
                        </div>
                    </div>
                      
                    </div>
                  <?php $i++; }} ?>
                  
            </div>
            </div>
        </div> 
        </div>
    </section>
 <?= $this->Html->script('design/jquery.min.js') ?>  
  <?= $this->Html->script('design/bootstrap.min.js') ?>  
  <?= $this->Html->script('design/custom.js') ?> 
    <script>
    $(document).ready(function(){
       $(":button").on('click',function(){
           var restId = $(this).attr('id');
           var ttl = $("#title"+restId).text();
           $.post('/setcookie',{name:'cri',value:restId},function(result1){
               
                 $.post('/setcookie',{name:'title',value:ttl},function(result2){
                     if(result1 && result2){
                     $(location).attr('href','reports');
                    }else{
                                $('#error-msg').css('display', 'inline-block!important;');
                                $('#error-msg').removeAttr("style");
                                $('.error_text').empty();
                                 $('.error_text').append('Please enable cookie option.');
                                $('#error-msg').fadeOut(10000);
                                $('#error-msg').removeAttr("style");
                    }
                 });
           });
         
           
       }); 
    });
    </script>
  </body>

</html>

