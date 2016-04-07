<?php

use Cake\Cache\Cache;
use Cake\Core\Configure;
use Cake\Datasource\ConnectionManager;
use Cake\Error\Debugger;
use Cake\Network\Exception\NotFoundException;
use App\Controller;

$this->layout = false;

?>
<!DOCTYPE html>
<html>
<head>

	<!-- Meta -->
	<meta charset="utf-8">
	<meta name="keywords" content="Quick Serve" />
	<meta name="description" content="">
	<title>QuickServe Login</title>
	<!-- Mobile Metas -->
         <?= $this->Html->meta(
    'keyword',
    'Popular Restaurant Billing Software,Popular Wireless Restaurant Ordering Software,Popular Pos for Restaurant, Popular Hotel Management System')?>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- Favicon -->
	<link rel="shortcut icon" href="/favicon.ico">
	<!-- Google Webfont -->
	<link href='http://fonts.googleapis.com/css?family=Vampiro+One' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,700,800' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Josefin+Sans:400,100,100italic,300,300italic,600,700' rel='stylesheet' type='text/css'>
	<!-- CSS -->
        <?= $this->Html->css('https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css') ?>
         <?= $this->Html->css('design/bootstrap.min.css') ?> 
         <?= $this->Html->css('design/font-awesome.css') ?> 
         <?= $this->Html->css('design/supersized.css') ?> 
         <?= $this->Html->css('design/flexslider.css') ?> 
         <?= $this->Html->css('design/style.css') ?> 

</head>
<body>
      <?php if($this->fetch('content')){
                         echo $this->fetch('content');
                      }else{
                         echo 'content block not set';
                      }
           ?>
<!-- Javascript -->
        <?= $this->Html->script('design/jquery.js') ?>
        <?= $this->Html->script('design/bootstrap.min.js') ?> 
        <?= $this->Html->script('design/stellar.js') ?> 
        <?= $this->Html->script('design/jquery.sticky.js') ?> 
        <?= $this->Html->script('design/main.js') ?> 
        <?= $this->Html->script('design/superslider.js') ?> 
        <?= $this->Html->script('design/jquery.bgslider.js') ?> 
 <script type="text/rocketscript">
        $('#carousel-example').carousel({
            interval: 1000 //TIME IN MILLI SECONDS
        })    
    </script>
</body>
</html>  
