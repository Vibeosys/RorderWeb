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
<html  prefix="og:http://ogp.me/ns#" lang="en">
   <head>
      <!-- Meta -->
      <meta charset="utf-8">
      <meta name="keywords" content="QuickServe mobile app, QuickServe restaurant management system, Restaurant POS billing, Popular POS for restaurants, Restaurant management system, Popular restaurant systems, Mobile app for restaurant POS" />
      <meta name="description" content="QuickServe is a in-house restaurant ordering system for dine-in restaurants. QuickServe app helps Steward and Chef to exchange orders from customers.">
      <title>QuickServe | Mobile App for Restaurant POS, Popular POS for restaurants | A Vibeosys.com product</title>
      <!-- Mobile Metas -->
       
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
	 
	  <meta itemprop="name" content="QuickServe&trade; Mobile App for Restaurant POS">
  	  <meta itemprop="description" content="QuickServe is a in-house restaurant ordering system for dine-in restaurants. QuickServe app helps Steward and Chef to exchange orders from customers.">
	  <meta itemprop="image" content="http://quickserve.vibeosys.com/img/quickserve-logo.png"> 
	  
	  <meta property="og:title" content="QuickServe&trade; Mobile App for Restaurant POS"/>
      <meta property="og:type" content="product"/>
      <meta property="og:url" content="http://quickserve.vibeosys.com/"/>
      <meta property="og:site_name" content="QuickServe"/>
	  <meta property="product:price:amount" content="0"/>
	  <meta property="product:price:currency" content="USD"/>
	  <meta property="og:availability" content="instock" />
      <meta property="og:description" content="QuickServe is a in-house restaurant ordering system for dine-in restaurants. QuickServe app helps Steward and Chef to exchange orders from customers."/>
      <meta property="og:image" content="http://quickserve.vibeosys.com/img/quickserve-small-logo.png"/>
	  
       <link href="android-app://https://play.google.com/store/apps/details?id=com.vibeosys.rorderapp&amp;hl=en" rel="alternate">
       <link rel="icon" type="image/png" href="http://quickserve.vibeosys.com/img/quickserve-small-logo.png" />
	   <link rel="apple-touch-icon-precomposed" href="http://quickserve.vibeosys.com/img/quickserve-small-logo.png" />
	  <!-- Twitter Folliwing -->
	  	
		<meta name="twitter:card" content="product">
		<meta name="twitter:site" content="@vibeosys">
		<meta name="twitter:title" content="QuickServe&trade; Mobile App for Restaurant POS">
		<meta name="twitter:description" content="QuickServe is a in-house restaurant ordering system for dine-in restaurants. QuickServe, an alternative to traditional POS">
		<meta name="twitter:creator" content="@vibeosys">
		<meta name="twitter:image" content="http://quickserve.vibeosys.com/img/quickserve-small-logo.png">
		<meta name="twitter:app:id:googleplay" content="https://play.google.com/store/apps/details?id=com.vibeosys.rorderapp&amp;hl=en" />
		<meta name="twitter:app:name:googleplay" content="QuickServe" />
		<meta name="twitter:app:country" content="in">
	  
	  <!-- Favicon-->
	  
	 <?= $this->Html->meta ( 'favicon.ico', '/favicon.ico', array ('type' => 'icon' ) )?>
	   <link rel="apple-touch-icon-precomposed" href="favicon.ico" />
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
<body data-spy="scroll" data-target=".navbar-fixed-top" id="Home">
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
        <?= $this->Html->script('design/classie.js') ?> 
       
        <?= $this->Html->script('design/jquerybutton.js') ?> 
        <?= $this->Html->script('design/jquery.easing.min.js') ?> 
        <?= $this->Html->script('design/scrolling-nav.js') ?> 
 <script type="text/rocketscript">
        $('#carousel-example').carousel({
            interval: 3000 //TIME IN MILLI SECONDS
        })    
    </script>
<!--
<script>
    <>
     function setCookie(cname, cvalue, exdays) {
    $.post('/setcookie',{name:cname,value:cvalue},function(result){
        
    });
    }
    function getCookie(cname) {
    $.post('/getcookie',{name:cname},function(result){
        if(result){
            return result;
        }
        return "";
    });
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

  ga('create', 'UA-76420947-1', 'auto');
   var randomId = TempId;
  ga('set', 'userId', randomId);
  ga('require', 'displayfeatures');
  ga('send', 'pageview');


</script>
<!-- Begin Inspectlet Embed Code 
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
