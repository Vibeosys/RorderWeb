<?php
    use Cake\Cache\Cache;
    use Cake\Core\Configure;
    use Cake\Datasource\ConnectionManager;
    use Cake\Error\Debugger;
    use Cake\Network\Exception\NotFoundException;
    use App\Controller;

     $this->layout = 'rorder_login_layout';
     
     //$this->start('content');
?>
<!-- Header -->
 <header>
         <nav class="navbar navbar-default navbar-fixed-top">
            <div class="container">
               <div class="navbar-header">
                  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  </button>
                  <!-- Logo -->
                  <a class="navbar-brand" href="#"><?= $this->Html->image('quickserve-logo.png', ['class' => 'img-responsive logo','alt' => 'QuickServe'])?></a>
               </div>
               <!-- Navmenu -->
               <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                  <ul class="nav navbar-nav navbar-right">
                     <li><a href="#Home" class="page-scroll">Home</a></li>
                     <li><a href="#Product" class="page-scroll">Product</a></li>
                     <li><a href="#Process" class="page-scroll">Process</a></li>
                     <li><a href="#Pricing" class="page-scroll">Pricing</a></li>
                     <li><a href="#Demo" class="page-scroll">Demo</a></li>
                     <li><a href="#Testimonial" class="page-scroll">Testimonial</a></li>
                     <li><a href="#Contact" class="page-scroll">Contact</a></li>
                  </ul>
               </div>
            </div>
         </nav>
      </header>

<!-- Slider -->
<div class="slider">
	<div class="slider-caption text-center">
		<div class="container">
			 <form action="login" method="post" class="form form--login">
                  <div class="row">
                     <div class="login center-block" >
                        <h1 class="login-text"> Restaurant Login</h1>
                        <span class="info">If you have an account with us. Please Login.</span>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                           <span class="input input--login">
                               <input class="input__field input__field--login" type="text" id="input-username" name="userName" required/>
                           <label class="input__label input__label--login" for="input-username">
                           <i class="fa fa-fw fa-user icon icon1 icon--login"></i>
                           <span class="input__label-content input__label-content--login">UserName</span>
                           </label>
                           </span>
                           <span class="input input--login">
                               <input class="input__field input__field--login" type="password" id="input-password" name="password" required/>
                           <label class="input__label input__label--login" for="input-password">
                           <i class="fa fa-fw fa-lock icon icon--login"></i>
                           <span class="input__label-content input__label-content--login">Password</span>
                           </label>
                           </span>
                        </div>
                        <div class="alink col-sm-6 col-md-6 col-lg-6 col-xs-6">
                           <a href="" data-toggle="modal" data-target="#myModal" >Forgot Password?</a><br>
                        </div>
                        <div class="col-sm-6 col-md-6 col-lg-6 col-xs-6">
                           <input type="submit" name="Login" value="Login" class="form-control sub-btn">
                        </div>
                     </div>
                  </div>
               </form>
            
		</div>
	</div>
</div>

    
    
<div id="myModal" class="modal animated zoomin">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Forgot Your Password</h4>
                
            </div>
            <div class="modal-body">
               <form id="contact-form" role="form" action="" method="post">
                      <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
							
                          <p>If you forgot your password, No worries: enter your email address and we'll send a link you can  use to pick a new password</p>
                          
                          
                               <div class="contact-form">
										
											
											<div class="form-group has-feedback">
												<label for="email">Email*</label>
												<input type="email" class="form-control" placeholder="Email: xxxx@xxx.com" name="Email" required>
												<i class="fa fa-envelope form-control-feedback contact-icon"></i>
											</div>
								
							</div>
					  
													
					  </div>
				<div class="modal-footer">
                <div class="form-group text-center">
                                <input type="Submit" class="form-control center-block submitbtn btn btn-primary" name="submit" value="Submit">
							</div>
            </div>
                </form>
             </div>
        </div>
    </div>
</div>
    
    <!-------- Product ------------>
      <section class="product" id="Product">
         <div class="container">
            <div class="row margin-bottom margin-top">
               <div class="col-lg-12 margin-top">
                  <h1 class="margin-top">About quickserve</h1>
               </div>
               <div class="col-md-12 col-sm-12">
                  <h4 class="product-text">QuickServe is a in-house restaurant ordering system for dine-in restaurants. QuickServe app helps Steward and Chef to exchange orders from customers. QuickServe is mainly focused for large area restaurants where KOT is manual and error prone. 
                     QuickServe app can be used for beach, resorts, hotels, villas, lounge or multi-storey restaurants.
                  </h4>
               </div>
               <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 benefit-top">
                  <div class="benefit-style center-block">
                     <h4 class="product-benefit process-h4">Few important benefits</h4>
                  </div>
               </div>
               <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 ">
                  <ul class="bullet">
                     <li>Single app for Steward and Chef for easy ordering.</li>
                     <li>App to take orders for Take-away, Home delivery and Dine-in.</li>
                     <li>Waiting list ease, real-time update to manage customers on week-ends.</li>
                     <li>Table allocatioreal time update.</li>
                     <li> Menu item search and filter to quickly search desired item.</li>
                     <li>Order completion and pickup notification on notification board.</li>
                  </ul>
               </div>
               <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                  <ul class="bullet">
                     <li>One click error-free bill generation.</li>
                     <li> Dashboard for Chef to view current orders with notes added by waiter.</li>
                     <li>Feedback mechanism to improve quality.</li>
                     <li> Cloud storage eases data backup and anytime availability of data.</li>
                     <li>Inventory management made easy with a single click.</li>
                     <li>Billing, customer rush statistical reports in PDF and Excel format at one go.</li>
                  </ul>
               </div>
               <div class="row">
                  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 margin-top">
                     <h4 class="text-right google-text" style="color: #E24425;">Now available on</h4>
                  </div>
                  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 margin-top">
                     <a href="https://play.google.com/store/apps/details?id=com.vibeosys.rorderapp&amp;hl=en" target="_blank">
                    <?= $this->Html->image('google-play-badge.png', ['class' => 'img-responsive','style'=> 'width: 186px;','alt' => 'QuickServe'])?>        
                     </a>
                  </div>
               </div>
            </div>
         </div>
      </section>
     
    
    <!----------------- Process --------------->
    
    <section class="process" id="Process">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 margin-top">
                    <h1 class="margin-top" style="margin-top:3em">How it works?</h1>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 mobile-view">
                    <?= $this->Html->image('dotted-line.png', ['class' => 'line1 line img-responsive'])?>                        
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <h4 class="process-h4">Just 4 Steps To Follow</h4>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 mobile-view" >
            <?= $this->Html->image('dotted-line.png', ['class' => 'line2 line img-responsive'])?>        
                </div>
            </div>
            <div class="row margin-bottom">
                
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 process-height">
                    <div class="process-info center-block">
                        
                        <div class="icon center-block icon-color">
                            <i class="fa fa-bars fa-2x"></i>
                        </div>
                        
                        <div class="crl-process">
                     <span class="crl-text">1</span>
                     </div>
                    <?= $this->Html->image('arrow_right.png', ['class' => 'img-responsive arrow'])?>       
                        <div class="prs-text">
                    <span>Order Taking</span>
                        </div>
                         </div>
                        <?= $this->Html->image('process-section-bg.png', ['class' => 'img-responsive center-block process-img'])?>       
                        <p>Steward takes order in restaurant in Dine-In or Takeaway or Home Delivery</p>
                  
                
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 process-height">
                    <div class="process-info center-block">
                        
                        <div class="icon center-block icon-color">
                            <i class="fa fa-cutlery fa-2x"></i>
                        </div>
                        
                        <div class="crl-process">
                     <span class="crl-text">2</span>
                     </div>
                    <?= $this->Html->image('arrow_right.png', ['class' => 'img-responsive arrow arrow2'])?>       
                        <div class="prs-text">
                    <span>Chef  Confirm</span>
                        </div>
                         </div>
                        <?= $this->Html->image('process-section-bg.png', ['class' => 'img-responsive center-block process-img'])?>
                        <p>KOT gets printed in Kitchen Chef confirms the orders</p>
                   
                
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 process-height">
                    <div class="process-info center-block">
                        
                        <div class="icon center-block icon-color">
                            <i class="fa fa-user fa-2x"></i>
                        </div>
                        
                        <div class="crl-process">
                     <span class="crl-text">3</span>
                     </div>
                        <?= $this->Html->image('arrow_right.png', ['class' => 'img-responsive arrow'])?>  
                        <div class="prs-text">
                    <span>Customer Process</span>
                        </div>
                         </div>
                        <?= $this->Html->image('process-section-bg.png', ['class' => 'img-responsive center-block process-img'])?>
                        <p>Customer enjoy the meal and gets printed bill</p>
                   
                
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 process-height">
                    <div class="process-info center-block">
                        
                        <div class="icon center-block">
                        <?= $this->Html->image('Hotel.png', ['class' => 'hotel-img','style' => 'width: 37px;'])?>  
                        </div>
                        
                        <div class="crl-process">
                     <span class="crl-text">4</span>
                     </div>
                        
                        <div class="prs-text">
                    <span>Restaurant Owner</span>
                        </div>
                         </div>
                   <?= $this->Html->image('process-section-bg.png', ['class' => 'img-responsive center-block process-img'])?>
                        <p>Owner views repors on Daily, Monthly and Annually</p>
                   
                
                </div>
              
            </div>
            
        
        </div>
    
    
    </section>
    
    
    
    
    <!-------------------------------  Price    ------------------------------>
    
    <section class="price-list" id="Pricing">
        <div class="container">
            <div class="row margin-bottom">
                <div class="col-lg-12 margin-top">
                    <h1 class="margin-top text-center" style="margin-top:3em">Pricing</h1>
                </div>
            	
		 <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
					<div class="panel price panel-green">
						<div class="panel-heading arrow_box text-center">
						<h3>Annual Plan</h3>
						</div>
						
						<ul class="list-group list-group-flush text-center">
							<li class="list-group-item"><i class="fa fa-check text-info"></i> Smart mobile ordering</li>
							<li class="list-group-item"><i class="fa fa-check text-info"></i> KOT printing</li>
							<li class="list-group-item"><i class="fa fa-check text-info"></i> Bill printing</li>
                            <li class="list-group-item"><i class="fa fa-check text-info"></i> Waiter screen software</li>
							<li class="list-group-item"><i class="fa fa-check text-info"></i> Inventory management</li>
							<li class="list-group-item"><i class="fa fa-check text-info"></i> Website access</li>
                            <li class="list-group-item"><i class="fa fa-check text-info"></i> Reports</li>
							<li class="list-group-item"><i class="fa fa-check text-info"></i> One time charges</li>
							<li class="list-group-item"><i class="fa fa-check text-info"></i>AMC charges</li>
						</ul>
						<div class="panel-footer footer-green">
							<a class="btn-green btn-lg btn-block btn-info center-block" href="#Contact">BUY NOW!</a>
						</div>
					</div>
                </div>		
					<!-- PRICE ITEM -->
                <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
					<div class="panel price panel-green">
						<div class="panel-heading arrow_box text-center">
						<h3>Monthly Plan</h3>
						</div>
						
						<ul class="list-group list-group-flush text-center">
							<li class="list-group-item"><i class="fa fa-check text-info"></i> Smart mobile ordering</li>
							<li class="list-group-item"><i class="fa fa-check text-info"></i> KOT printing</li>
							<li class="list-group-item"><i class="fa fa-check text-info"></i> Bill printing</li>
                            <li class="list-group-item"><i class="fa fa-check text-info"></i> Waiter screen software</li>
							<li class="list-group-item"><i class="fa fa-check text-info"></i> Inventory management</li>
							<li class="list-group-item"><i class="fa fa-check text-info"></i> Website access</li>
                            <li class="list-group-item"><i class="fa fa-check text-info"></i> Reports</li>
							<li class="list-group-item"><i class="fa fa-check text-info"></i> Monthly charges</li>
							<li class="list-group-item"><i class="fa fa-check text-info"></i> One review per month</li>
						</ul>
						<div class="panel-footer footer-green">
							<a class="btn-green btn-lg btn-block btn-info center-block" href="#Contact">BUY NOW!</a>
						</div>
					</div>
					
                </div>
                    <!-- /PRICE ITEM -->
                    
                    <!-- PRICE ITEM -->
               
					<!-- /PRICE ITEM -->
                    
                    
                    
                    
                    	<!-- PRICE ITEM -->
                <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
					<div class="panel price panel-yellow">
						<div class="panel-heading arrow_box text-center">
						<h3>Per transaction</h3>
						</div>
						
						<ul class="list-group list-group-flush text-center">
							<li class="list-group-item"><i class="fa fa-check text-info"></i> Smart mobile ordering</li>
							<li class="list-group-item"><i class="fa fa-check text-info"></i> KOT printing</li>
							<li class="list-group-item"><i class="fa fa-check text-info"></i> Bill printing</li>
                            <li class="list-group-item"><i class="fa fa-check text-info"></i> Waiter screen software</li>
							<li class="list-group-item"><i class="fa fa-check text-info"></i> Inventory management</li>
							<li class="list-group-item"><i class="fa fa-check text-info"></i> Website access</li>
                            <li class="list-group-item"><i class="fa fa-check text-info"></i> Reports</li>
							<li class="list-group-item"><i class="fa fa-check text-info"></i> FREE mobile app</li>
							<li class="list-group-item"><i class="fa fa-check text-info"></i>FREE website access</li>
						</ul>
						<div class="panel-footer footer-yellow">
							<a class="btn-yellow btn-lg btn-block btn-info center-block" href="#Contact">BUY NOW!</a>
						</div>
					</div>
					
                </div>
                    <!-- /PRICE ITEM -->
                    
                    
                    
            
            </div>
        </div>
       
    
    
    </section>
     <!-- ---------------------------------------------------- Demo------------------------------------------------>
      <section id="Demo">
         <div class="container">
            <div class="row  margin-bottom margin-top">
               <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                  <h1 class="text-center margin-top"> For Free Demo Or For 1 Month Free Trial</h1>
               </div>
               <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                  <h3 class="text-justify">Fill up form and We will get back to you  <input type="button" value="Fill Me" class="btn-contact" onclick="window.location.href='#Contact'"> </h3>
               </div>
               <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                  <p class="text-center">Alternatively You can also send a Email at <a href="mailto:info@vibeosys.com">info@vibeosys.com</a>  </p>
               </div>
            </div>
         </div>
      </section>
    
    
    <!----------------------- Testimonial -------------------------->
    
    
    <section class="testimonial" id="Testimonial">
        <div class="container">
            <div class="row margin-bottom">
             
            <div class="col-md-12 col-lg-offset-3 col-sm-12 col-xs-12 col-lg-6 margin-top-testimonial">
                <h1>Client Testimonial</h1>
                <br />
                <div id="carousel-example" class="carousel slide" data-ride="carousel">

                    <div class="carousel-inner">
                        
                        <div class="item active">
                            <div class="testimonial-section">
                           QuickServe mobile app is such a user-friendly and utility app that it has not only increased our restaurant sale but now our staff members started loving it.
                        </div>
                        <div class="testimonial-section-name">
                            -   Shabir H, Neon Hospitality
                        </div>
                            
                        </div>
                        <div class="item">
                           <div class="testimonial-section">
                           KOT, billing was never easy earlier, and it was error-prone mostly on weekends when there was a rush. QuickServe website and mobile has made everything so fantastic now.
                        </div>
                        <div class="testimonial-section-name">
                            -  Vijay Shetty, Kelly Restaurant
                        </div>
                            
                        </div>
                        <div class="item">
                          <div class="testimonial-section">
                          
                              Inventory management is very important stuff QuickServe provides to us, I am able to reduce 40% of waste due to this management app.
                        </div>
                        <div class="testimonial-section-name">
                            -  Nilam T, Meekal Hospitality
                        </div>
                        </div>
                            <div class="item">
                          <div class="testimonial-section">
                          
                              Graphical on the go reports has made my life pretty easy, thanks to QuickServe team. They have really work hard to keep my 3 restaurants manageable.
                        </div>
                        <div class="testimonial-section-name">
                            -  General Manager, Chain restaurant in Bangalore
                        </div>
                            
                        </div>
                         <!--INDICATORS-->
                    <ol class="carousel-indicators carousel-indicators-set">
                        <li data-target="#carousel-example" data-slide-to="0" class="active"></li>
                        <li data-target="#carousel-example" data-slide-to="1"></li>
                        <li data-target="#carousel-example" data-slide-to="2"></li>
                        <li data-target="#carousel-example" data-slide-to="3"></li>
                    </ol>

                    </div>
                   
                </div>
                
            </div>
      
            </div>
        </div>
    
    
    </section>
     <!-------------------------------------------------- Contact ---------------------------------------->
      <section id="Contact">
         <div class="container">
            <div class="row margin-top">
                <form id="sales-form">
               <div class="col-lg-12">
                  <h1> Contact Us</h1>
               </div>
               <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                  <span class="input input--contact">
                  <input class="input__field input__field--contact" type="text" id="input-first" required/>
                  <label class="input__label input__label--contact" for="input-first">
                  <span class="input__label-content input__label-content--contact">First Name</span>
                  </label>
                  </span>
               </div>
               <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                  <span class="input input--contact">
                  <input class="input__field input__field--contact" type="text" id="input-last" required/>
                  <label class="input__label input__label--contact" for="input-last">
                  <span class="input__label-content input__label-content--contact">Last Name</span>
                  </label>
                  </span>
               </div>
               <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                  <span class="input input--contact">
                  <input class="input__field input__field--contact" type="text" id="input-restaurant" required/>
                  <label class="input__label input__label--contact" for="input-restaurant">
                  <span class="input__label-content input__label-content--contact">Restaurant Name</span>
                  </label>
                  </span>
               </div>
               <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                  <span class="input input--contact">
                  <input class="input__field input__field--contact" type="email" id="input-email" required/>
                  <label class="input__label input__label--contact" for="input-email">
                  <span class="input__label-content input__label-content--contact">Email id</span>
                  </label>
                  </span>
               </div>
               <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                  <span class="input input--contact">
                      <input class="input__field input__field--contact" type="number" id="input-phone" required/>
                  <label class="input__label input__label--contact" for="input-phone">
                  <span class="input__label-content input__label-content--contact">Phone No</span>
                  </label>
                  </span>
               </div>
               <div class="col-sm-12 col-md-12 col-lg-12 col-xs-12 margin-bottom">
                   <input type="button" id="mail-send-btn" name="contact" value="Submit" class="form-control sub-btn-contact">
               </div>
                </form>
            </div>
         </div>
      </section>
     <div id="myContactModal" class="modal animated zoomin"> 
         <div class="modal-dialog" style="margin: 18em auto;">
             <div class="modal-content" style="color: green">
               <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                  <h4 class="modal-title">Message Successfully Send.</h4>
               </div>
               <div class="modal-body" style="height: 6em;">
                
                     <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                        <p>Thank You.!<br>We will get back to you soon.....</p>
                        
                     </div>
                     
               </div>
            </div>
         </div>
      </div>
     <div id="myErrorModal" class="modal animated zoomin"> 
         <div class="modal-dialog" style="margin: 18em auto;">
             <div class="modal-content" style="color: orangered">
               <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                  <h4 class="modal-title">Failed to Send Message.</h4>
               </div>
               <div class="modal-body" style="height: 6em;">
                
                     <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                        <p>Sorry.!<br>Please try again.....</p>
                        
                     </div>
                     
               </div>
            </div>
         </div>
      </div>
    
	
	<!-- Footer -->
	<footer class="footer-section">
		<div class="continer-fluid">
        <div class="row">
                
            
		
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 text-left">
                    <p>Copyright <a href="http://www.vibeosys.com/" target="_blank">Vibeosys Software Pvt Ltd</a> 2016. All Rights Reserved</p>
				</div>
                
                 <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <ul class="social-icon">
                <li>
                <a href="https://www.facebook.com/vibeosys"> <span class="footer-icon facebook"> <i class="fa fa-facebook"></i></span></a>
                </li>
                 <li>
                 <a href="https://twitter.com/vibeosys"> <span class="footer-icon twitter"> <i class="fa fa-twitter"></i></span></a>
                </li>
                 <li>
                 <a href="https://www.linkedin.com/company/vibeosys-software-pvt-ltd"> <span class="footer-icon linkedin"> <i class="fa fa-linkedin"></i></span></a>
                </li>
                 <li>
                 <a href="https://plus.google.com/+VibeosysSoftware"> <span class="footer-icon gplus"> <i class="fa fa-google-plus"></i></span></a>
                </li>
                </ul>
		</div>
            </div>
        </div>
	</footer>

