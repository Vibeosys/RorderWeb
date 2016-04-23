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

  <title>QuickServe </title>

  <!-- Bootstrap core CSS -->

  <?= $this->Html->css('design/bootstrap.min.css') ?> 
      <?= $this->Html->css('design/font-awesome.min.css') ?>
  <?= $this->Html->css('design/animate.min.css') ?>
    <?= $this->Html->css('design/custom.css') ?>
    <?= $this->Html->css('design/admin.style.css') ?>
</head>


<body>
 <div class="container body">
     
      <!-- top navigation -->
      <div class="top_nav">

        <div class="nav_menu">
          <nav class="" role="navigation">
            <div class="nav logo">
               <?= $this->Html->image('quickserve-logo.png', ['class'=>'img-responsive', 'alt'=>'QuickServe'])?>
            </div>

            <ul class="nav navbar-nav navbar-right">
              <li>
                <a href="" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                   <?= $this->Html->image('quickserve-admin-img.jpg', ['alt' => '...'])?>Admin
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
            <?php if(isset($data)) { $i = 1; foreach ($data as $single){ ?>
            <div class="animated flipInY col-lg-4 col-md-4 col-sm-6 col-xs-12">
              <div class="tile-stats b-<?= $i ?>">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                      <div class="img-rest">
                          <?= $this->Html->image('quickserve-restaurant-default.png', ['class' => 'img-responsive'])?>
                </div>
                  </div>
                 <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8 remove-space">
                      
                <div class="count"><?= $single->title ?></div>
                            <p class="text-center"><?= $single->city ?>, <?= $single->country ?></p>
                                <input type="text" name="restId" class="hidden" value="<?= $single->restaurantId ?>">
                <input type="submit" name="resta1" value="More Detail" class=" btn-rest center-block text-center">
                 
                  </div>
                
              </div>
            </div>
            <?php $i++; }} ?>
        </div> 
        </div>
    </section>
    
  <?= $this->Html->script('design/jquery.min.js') ?>  
  <?= $this->Html->script('design/bootstrap.min.js') ?>  
  <?= $this->Html->script('design/custom.js') ?> 
    <script>
    $(document).ready(function(){
       $(":submit").on('click',function(){
           var restId = $(":text").val();
           $.post('/setcookie',{name:'cri',value:restId},function(result){});
           $(location).attr('href','reports');
       }); 
    });
    </script>
  <!-- /footer content -->
  </body>

</html>

