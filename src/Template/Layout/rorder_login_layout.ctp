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
  
<script>
     function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    var expires = "expires="+d.toUTCString();
    document.cookie = cname + "=" + cvalue + "; " + expires;
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

</body>
</html>  
