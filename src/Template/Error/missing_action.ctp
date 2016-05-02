<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!-- Meta, title, CSS, favicons, etc. -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>QuickServe </title>

  <!-- Bootstrap core CSS -->

  <?= $this->Html->css('design/bootstrap.min.css') ?>
  <?= $this->Html->css('design/animate.min.css') ?>
    <?= $this->Html->css('design/custom.css') ?>
    <?= $this->Html->css('design/font-awesome.min.css') ?>

  

</head>


<body>
    <header>
    
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <div class="">
                
                <!-- Logo -->
                <a class="navbar-brand" href="#"><?= $this->Html->image('quickserve-logo.png', ['class' => 'img-responsive logo', 'alt' => 'QuickServe'])?></a>
            </div>
            <!-- Navmenu -->
            
            <ul class="nav navbar-nav navbar-right">
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
        </div>
    </nav>
</header>
    
    
    <section class="fil-not-found">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8 push-width">
                    <div class="error-header">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 colsm-12 col-xs-12 push-10">
                                <span class="error-h1">Bad!
                                </span>
                            </div>
                            <div class="col-lg-12 col-md-12 colsm-12 col-xs-12 push-10">
                                <span class="error-h3">The request could not be understood by the server due to malformed syntax.
                                </span>
                            </div>
                            <div class="col-lg-12 col-md-12 colsm-12 col-xs-12 push-10">
                                <span class="error-h5">Error: 400 - Bad request.
                                </span>
                                <p>The 400 error can be malformed request syntax, invalid request message framing, or deceptive request routing.</p>
                            </div>
                            <div class="col-lg-12 col-md-12 colsm-12 col-xs-12 push-10">
                                <span class="error-h6">Here are some helpful links instend:
                                </span>
                                <ul>
                                    <li><a onclick="window.history.back();" href="">Back</a></li>
                                    <li><a href="login">Home</a></li>
                                    <li><a href="/">Dashboard</a></li>
                                </ul>
                            </div>
                            
                            <div class="col-lg-12 col-md-12 colsm-12 col-xs-12 push-10">
                                <span class="error-footer">Please for more details contact us: <a href="mailto:info@vibeosys.com">info@vibeosys.com</a>
                                </span>
                            </div>
                        </div>
                    </div>
                    
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                    <?= $this->Html->image('error-img-400.png', ['class' => 'img responsive error-img-404','alt' => '...'])?>
                </div>
                    
               </div>
        </div>
    </section>
<?= $this->Html->script('design/jquery.min.js') ?> 
<?= $this->Html->script('design/bootstrap.min.js') ?> 
<?= $this->Html->script('design/custom.js') ?> 
</body>

</html>
