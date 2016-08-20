<?php

use Cake\Cache\Cache;
    use Cake\Core\Configure;
    use Cake\Datasource\ConnectionManager;
    use Cake\Error\Debugger;
    use Cake\Network\Exception\NotFoundException;
    use App\Controller;

    $this->layout = false;
    $this->layout = 'rorder_layout';
    $this->assign('title', 'Place an Order');
?>


          <div class="">
            <div class="clearfix">
            </div>
            <div class="row pop-margin">
              <ol class="breadcrumb mobile-show">
                <li>
                  <a href="#" class="red">Dashboard
                  </a>
                </li>
                <li>
                  <a href="#" class="red">Restaurent 1
                  </a>
                </li>
                <li class="active">Place Order
                </li>
              </ol>
              <!-- Menu List -->
              <div class="col-md-8 col-sm-8 col-xs-12 order-cate">
                <div class="main-menu" id="menu-center">
                  <div class="x_panel category-item">
                    <div class="x_content">
                      <div class="x_title">
                          
                        <input type="text" class="form-control search filterinput" placeholder="Search by dishes.." id="filter">
                          
                        <div class="clearfix">
                        </div>
                      </div>
                      <ul class="nav menu-list">
                        <li >
                          <a class="active-menu" href="#all" class="page-scroll all-cate">All
                          </a>
                        </li>
                        <li>
                          <a href="#soups" class="page-scroll soups-cat" >Soups
                          </a>
                        </li>
                        <li>
                          <a href="#starter" class="page-scroll">Starters
                          </a>
                        </li>
                        <li>
                          <a href="#chinese" class="page-scroll">Chinese
                          </a>
                        </li>
                        <li>
                          <a href="#panjabi" class="page-scroll">Panjabi
                          </a>
                        </li>
                        <li>
                          <a href="#dal" class="page-scroll">Dal
                          </a>
                        </li>
                        <li>
                          <a href="#rice">Rice
                          </a>
                        </li>
                        <li>
                          <a href="#thalis">Thalis
                          </a>
                        </li>
                        <li>
                          <a href="#desserts">Desserts
                          </a>
                        </li>
                        <li>
                          <a href="#mocktails" >Mocktails
                          </a>
                        </li>
                        <li>
                          <a href="#beverages">Beverages
                          </a>
                        </li>
                      </ul>
                    </div>  
                  </div>
                </div>
                <div class="x_panel category-item sub-cat scrollbar" id="style-1">
                  <div class="x_content" id=" menu-item">
                    <div class="sub-item-list">
                      <div class="x_panel">
                        <div class="x_content">
                          <!-- Stat All Category -->
                        <ul id="contents" class="inner-list">
                            <li>
                          <section id="all">
                            <div class="item-title">
                              <span>All
                              </span>
                            </div>
                            <div class="item-view">
                              <ul>
                                <li> 
                                  <div class="details">
                                    <div class="veg-tag">
                                      <?= $this->Html->image('menu/veg_icon.jpg', ['class' => 'veg','alt' => '...'])?>
                                    </div>
                                    <span class="dish-name">
                                      Veg Thali
                                    </span>
                                    <div class="price item-price ">
                                      Rs.155.00
                                      <button type="button" class="btn btn-item btn-price">
                                        <i class="fa fa-plus" aria-hidden="true">
                                        </i>
                                      </button>
                                    </div>
                                  </div>
                                </li>
                                <li> 
                                  <div class="details">
                                    <div class="veg-tag">
                                      <?= $this->Html->image('menu/veg_icon.jpg', ['class' => 'veg','alt' => '...'])?>
                                    </div>
                                    <span class="dish-name">
                                      papad
                                    </span>
                                    <div class="price item-price ">
                                      Rs.155.00
                                      <button type="button" class="btn btn-item btn-price">
                                        <i class="fa fa-plus" aria-hidden="true">
                                        </i>
                                      </button>
                                    </div>
                                  </div>
                                </li>
                                <li> 
                                  <div class="details">
                                    <div class="veg-tag">
                                      <?= $this->Html->image('menu/veg_icon.jpg', ['class' => 'veg','alt' => '...'])?>
                                    </div>
                                    <span class="dish-name">
                                      apple
                                    </span>
                                    <div class="price item-price ">
                                      Rs.155.00
                                      <button type="button" class="btn btn-item btn-price">
                                        <i class="fa fa-plus" aria-hidden="true">
                                        </i>
                                      </button>
                                    </div>
                                  </div>
                                </li>
                                <li> 
                                  <div class="details">
                                    <div class="veg-tag">
                                    <?= $this->Html->image('menu/veg_icon.jpg', ['class' => 'veg','alt' => '...'])?>
                                    </div>
                                    <span class="dish-name">
                                     mango
                                    </span>
                                    <div class="price item-price ">
                                      Rs.155.00
                                      <button type="button" class="btn btn-item btn-price">
                                        <i class="fa fa-plus" aria-hidden="true">
                                        </i>
                                      </button>
                                    </div>
                                  </div>
                                </li>
                              </ul>
                            </div>
                          </section>
                            </li>
                          <!-- End All Category-->
                          <!-- Stat Soups Category -->
                            <li>
                          <section id="soups">
                            <div class="item-title">
                              <span>Soups
                              </span>
                            </div>
                            <div class="item-view">
                              <ul>
                                <li> 
                                  <div class="details">
                                    <div class="veg-tag">
                                       <?= $this->Html->image('menu/veg_icon.jpg', ['class' => 'veg','alt' => '...'])?>
                                    </div>
                                    <span class="dish-name">
                                      Veg Thali
                                    </span>
                                    <div class="price item-price ">
                                      Rs.155.00
                                      <button type="button" class="btn btn-item btn-price">
                                        <i class="fa fa-plus" aria-hidden="true">
                                        </i>
                                      </button>
                                    </div>
                                  </div>
                                </li>
                                <li> 
                                  <div class="details">
                                    <div class="veg-tag">
                                      <?= $this->Html->image('menu/veg_icon.jpg', ['class' => 'veg','alt' => '...'])?>
                                    </div>
                                    <span class="dish-name">
                                      Rice
                                    </span>
                                    <div class="price item-price ">
                                      Rs.155.00
                                      <button type="button" class="btn btn-item btn-price">
                                        <i class="fa fa-plus" aria-hidden="true">
                                        </i>
                                      </button>
                                    </div>
                                  </div>
                                </li>
                                <li> 
                                  <div class="details">
                                    <div class="veg-tag">
                                     <?= $this->Html->image('menu/veg_icon.jpg', ['class' => 'veg','alt' => '...'])?>
                                    </div>
                                    <span class="dish-name">
                                      Dal
                                    </span>
                                    <div class="price item-price ">
                                      Rs.155.00
                                      <button type="button" class="btn btn-item btn-price">
                                        <i class="fa fa-plus" aria-hidden="true">
                                        </i>
                                      </button>
                                    </div>
                                  </div>
                                </li>
                                <li> 
                                  <div class="details">
                                    <div class="veg-tag">
                                     <?= $this->Html->image('menu/veg_icon.jpg', ['class' => 'veg','alt' => '...'])?>
                                    </div>
                                    <span class="dish-name">
                                      Veg 
                                    </span>
                                    <div class="price item-price ">
                                      Rs.155.00
                                      <button type="button" class="btn btn-item btn-price">
                                        <i class="fa fa-plus" aria-hidden="true">
                                        </i>
                                      </button>
                                    </div>
                                  </div>
                                </li>
                              </ul>
                            </div>
                          </section>
                            </li>
                          <!-- End Soups Category -->
                          <!-- Stat starter Category -->
                            <li>
                          <section id="starter">
                            <div class="item-title">
                              <span>starter
                              </span>
                            </div>
                            <div class="item-view">
                              <ul>
                                <li> 
                                  <div class="details">
                                    <div class="veg-tag">
                                     <?= $this->Html->image('menu/veg_icon.jpg', ['class' => 'veg','alt' => '...'])?>
                                    </div>
                                    <span class="dish-name">
                                      Green Apple
                                    </span>
                                    <div class="price item-price ">
                                      Rs.155.00
                                      <button type="button" class="btn btn-item btn-price">
                                        <i class="fa fa-plus" aria-hidden="true">
                                        </i>
                                      </button>
                                    </div>
                                  </div>
                                </li>
                                <li> 
                                  <div class="details">
                                    <div class="veg-tag">
                                    <?= $this->Html->image('menu/veg_icon.jpg', ['class' => 'veg','alt' => '...'])?>
                                     
                                    </div>
                                    <span class="dish-name">
                                      Veg Thali
                                    </span>
                                    <div class="price item-price ">
                                      Rs.155.00
                                      <button type="button" class="btn btn-item btn-price">
                                        <i class="fa fa-plus" aria-hidden="true">
                                        </i>
                                      </button>
                                    </div>
                                  </div>
                                </li>
                                <li> 
                                  <div class="details">
                                    <div class="veg-tag">
                                      <?= $this->Html->image('menu/veg_icon.jpg', ['class' => 'veg','alt' => '...'])?>
                                    </div>
                                    <span class="dish-name">
                                      Veg Thali
                                    </span>
                                    <div class="price item-price ">
                                      Rs.155.00
                                      <button type="button" class="btn btn-item btn-price">
                                        <i class="fa fa-plus" aria-hidden="true">
                                        </i>
                                      </button>
                                    </div>
                                  </div>
                                </li>
                                <li> 
                                  <div class="details">
                                    <div class="veg-tag">
                                       <?= $this->Html->image('menu/veg_icon.jpg', ['class' => 'veg','alt' => '...'])?>
                                    </div>
                                    <span class="dish-name">
                                      Veg Thali
                                    </span>
                                    <div class="price item-price ">
                                      Rs.155.00
                                      <button type="button" class="btn btn-item btn-price">
                                        <i class="fa fa-plus" aria-hidden="true">
                                        </i>
                                      </button>
                                    </div>
                                  </div>
                                </li>
                              </ul>
                            </div>
                          </section>
                            </li>
                          <!-- End starter Category -->
                          <!-- Stat chinese Category -->
                            <li>
                          <section id="chinese">
                            <div class="item-title">
                              <span>chinese
                              </span>
                            </div>
                            <div class="item-view">
                              <ul>
                                <li> 
                                  <div class="details">
                                    <div class="veg-tag">
                                      <?= $this->Html->image('menu/veg_icon.jpg', ['class' => 'veg','alt' => '...'])?>
                                    </div>
                                    <span class="dish-name">
                                      Veg Thali
                                    </span>
                                    <div class="price item-price ">
                                      Rs.155.00
                                      <button type="button" class="btn btn-item btn-price">
                                        <i class="fa fa-plus" aria-hidden="true">
                                        </i>
                                      </button>
                                    </div>
                                  </div>
                                </li>
                                <li> 
                                  <div class="details">
                                    <div class="veg-tag">
                                      <?= $this->Html->image('menu/veg_icon.jpg', ['class' => 'veg','alt' => '...'])?>
                                    </div>
                                    <span class="dish-name">
                                      Veg Thali
                                    </span>
                                    <div class="price item-price ">
                                      Rs.155.00
                                      <button type="button" class="btn btn-item btn-price">
                                        <i class="fa fa-plus" aria-hidden="true">
                                        </i>
                                      </button>
                                    </div>
                                  </div>
                                </li>
                                <li> 
                                  <div class="details">
                                    <div class="veg-tag">
                                      <?= $this->Html->image('menu/veg_icon.jpg', ['class' => 'veg','alt' => '...'])?>
                                    </div>
                                    <span class="dish-name">
                                      Veg Thali
                                    </span>
                                    <div class="price item-price ">
                                      Rs.155.00
                                      <button type="button" class="btn btn-item btn-price">
                                        <i class="fa fa-plus" aria-hidden="true">
                                        </i>
                                      </button>
                                    </div>
                                  </div>
                                </li>
                                <li> 
                                  <div class="details">
                                    <div class="veg-tag">
                                     <?= $this->Html->image('menu/veg_icon.jpg', ['class' => 'veg','alt' => '...'])?>
                                    </div>
                                    <span class="dish-name">
                                      Spicy
                                    </span>
                                    <div class="price item-price ">
                                      Rs.155.00
                                      <button type="button" class="btn btn-item btn-price">
                                        <i class="fa fa-plus" aria-hidden="true">
                                        </i>
                                      </button>
                                    </div>
                                  </div>
                                </li>
                              </ul>
                            </div>
                          </section>
                            </li>
                            </ul>
                          <!-- End chinese Category -->
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
             
              <!-- OrderList-->
              <div class="col-md-4 col-sm-4 col-xs-12 place-order">
                <div class="order-list">
                  <div class="x_panel">
                    <div class="x_title">
                      <h2>Your Order
                      </h2>
                      <div class="clearfix">
                      </div>
                    </div>
                    <div class="x_content">
                      <div class="order-inner">
                        <ul class="order-items scrollbar" id="style-1">
                          <li>
                            <div class="details">
                              <div class="veg-tag">
                               <?= $this->Html->image('menu/veg_icon.jpg', ['class' => 'veg','alt' => '...'])?>
                              </div>
                              <span class="dish-name">
                                Veg Thali
                              </span>
                                 <button type="button" class="btn btn-item-close btn-dis" >
                                    <i class="fa fa-times-circle" aria-hidden="true">
                                    </i> 
                                  </button>
                            </div>
                            <div class="count">
                              <div class="number">
                                <div class="dec">
                                  <button type="button" class="btn btn-item">
                                    <i class="fa fa-minus" aria-hidden="true">
                                    </i> 
                                  </button>
                                </div>
                                <input type="text" value="1" class="no-tem"  disabled>
                                <div class="inc">
                                  <button type="button" class="btn btn-item">
                                    <i class="fa fa-plus" aria-hidden="true">
                                    </i>
                                  </button>
                                </div>
                              </div>
                              <div class="quantity">x Rs.155.00
                              </div>
                            </div>
                            <div class="price item-price ">
                              Rs.155.00
                            </div>
                            <div class="clear">
                            </div>
                          </li>
                          <li>
                            <div class="details">
                              <div class="veg-tag">
                               <?= $this->Html->image('menu/non_veg_icon.jpg', ['class' => 'veg','alt' => '...'])?>
                              </div>
                              <span class="dish-name">
                                Butter Chicken
                              </span>
                                 <button type="button" class="btn btn-item-close btn-dis" >
                                    <i class="fa fa-times-circle" aria-hidden="true">
                                    </i> 
                                  </button>
                            </div>
                            <div class="count">
                              <div class="number">
                                <div class="dec">
                                  <button type="button" class="btn btn-item">
                                    <i class="fa fa-minus" aria-hidden="true">
                                    </i> 
                                  </button>
                                </div>
                                <input type="text" value="1" class="no-tem"  disabled>
                                <div class="inc">
                                  <button type="button" class="btn btn-item">
                                    <i class="fa fa-plus" aria-hidden="true">
                                    </i>
                                  </button>
                                </div>
                              </div>
                              <div class="quantity">x Rs.155.00
                              </div>
                            </div>
                            <div class="price item-price ">
                              Rs.155.00
                            </div>
                            <div class="clear">
                            </div>
                          </li>
                          <li>
                            <div class="details">
                              <div class="veg-tag">
                                <?= $this->Html->image('menu/veg_icon.jpg', ['class' => 'veg','alt' => '...'])?>
                              </div>
                              <span class="dish-name">
                                Veg Thali
                              </span>
                                 <button type="button" class="btn btn-item-close btn-dis" >
                                    <i class="fa fa-times-circle" aria-hidden="true">
                                    </i> 
                                  </button>
                            </div>
                            <div class="count">
                              <div class="number">
                                <div class="dec">
                                  <button type="button" class="btn btn-item">
                                    <i class="fa fa-minus" aria-hidden="true">
                                    </i> 
                                  </button>
                                </div>
                                <input type="text" value="1" class="no-tem"  disabled>
                                <div class="inc">
                                  <button type="button" class="btn btn-item">
                                    <i class="fa fa-plus" aria-hidden="true">
                                    </i>
                                  </button>
                                </div>
                              </div>
                              <div class="quantity">x Rs.155.00
                              </div>
                            </div>
                            <div class="price item-price ">
                              Rs.155.00
                            </div>
                            <div class="clear">
                            </div>
                          </li>
                          <li>
                            <div class="details">
                              <div class="veg-tag">
                                <?= $this->Html->image('menu/veg_icon.jpg', ['class' => 'veg','alt' => '...'])?>
                              </div>
                              <span class="dish-name">
                                Veg Thali
                              </span>
                                 <button type="button" class="btn btn-item-close btn-dis" >
                                    <i class="fa fa-times-circle" aria-hidden="true">
                                    </i> 
                                  </button>
                            </div>
                            <div class="count">
                              <div class="number">
                                <div class="dec">
                                  <button type="button" class="btn btn-item">
                                    <i class="fa fa-minus" aria-hidden="true">
                                    </i> 
                                  </button>
                                </div>
                                <input type="text" value="1" class="no-tem"  disabled>
                                <div class="inc">
                                  <button type="button" class="btn btn-item">
                                    <i class="fa fa-plus" aria-hidden="true">
                                    </i>
                                  </button>
                                </div>
                              </div>
                              <div class="quantity">x Rs.155.00
                              </div>
                            </div>
                            <div class="price item-price ">
                              Rs.155.00
                            </div>
                            <div class="clear">
                            </div>
                          </li>
                          <li>
                            <div class="details">
                              <div class="veg-tag">
                                <?= $this->Html->image('menu/veg_icon.jpg', ['class' => 'veg','alt' => '...'])?>
                              </div>
                              <span class="dish-name">
                                Veg Thali
                              </span>
                                 <button type="button" class="btn btn-item-close btn-dis" >
                                    <i class="fa fa-times-circle" aria-hidden="true">
                                    </i> 
                                  </button>
                            </div>
                            <div class="count">
                              <div class="number">
                                <div class="dec">
                                  <button type="button" class="btn btn-item">
                                    <i class="fa fa-minus" aria-hidden="true">
                                    </i> 
                                  </button>
                                </div>
                                <input type="text" value="1" class="no-tem"  disabled>
                                <div class="inc">
                                  <button type="button" class="btn btn-item">
                                    <i class="fa fa-plus" aria-hidden="true">
                                    </i>
                                  </button>
                                </div>
                              </div>
                              <div class="quantity">x Rs.155.00
                              </div>
                            </div>
                            <div class="price item-price ">
                              Rs.155.00
                            </div>
                            <div class="clear">
                            </div>
                          </li>
                          <li>
                            <div class="details">
                              <div class="veg-tag">
                                 <?= $this->Html->image('menu/veg_icon.jpg', ['class' => 'veg','alt' => '...'])?>
                              </div>
                              <span class="dish-name">
                                Veg Thali
                              </span>
                                 <button type="button" class="btn btn-item-close btn-dis" >
                                    <i class="fa fa-times-circle" aria-hidden="true">
                                    </i> 
                                  </button>
                            </div>
                            <div class="count">
                              <div class="number">
                                <div class="dec">
                                  <button type="button" class="btn btn-item">
                                    <i class="fa fa-minus" aria-hidden="true">
                                    </i> 
                                  </button>
                                </div>
                                <input type="text" value="1" class="no-tem"  disabled>
                                <div class="inc">
                                  <button type="button" class="btn btn-item">
                                    <i class="fa fa-plus" aria-hidden="true">
                                    </i>
                                  </button>
                                </div>
                              </div>
                              <div class="quantity">x Rs.155.00
                              </div>
                            </div>
                            <div class="price item-price ">
                              Rs.155.00
                            </div>
                            <div class="clear">
                            </div>
                          </li>
                          <li>
                            <div class="details">
                              <div class="veg-tag">
                               <?= $this->Html->image('menu/veg_icon.jpg', ['class' => 'veg','alt' => '...'])?>
                              </div>
                              <span class="dish-name">
                                Veg Thali
                              </span>
                                 <button type="button" class="btn btn-item-close btn-dis" >
                                    <i class="fa fa-times-circle" aria-hidden="true">
                                    </i> 
                                  </button>
                            </div>
                            <div class="count">
                              <div class="number">
                                <div class="dec">
                                  <button type="button" class="btn btn-item">
                                    <i class="fa fa-minus" aria-hidden="true">
                                    </i> 
                                  </button>
                                </div>
                                <input type="text" value="1" class="no-tem"  disabled>
                                <div class="inc">
                                  <button type="button" class="btn btn-item">
                                    <i class="fa fa-plus" aria-hidden="true">
                                    </i>
                                  </button>
                                </div>
                              </div>
                              <div class="quantity">x Rs.155.00
                              </div>
                            </div>
                            <div class="price item-price ">
                              Rs.155.00
                            </div>
                            <div class="clear">
                            </div>
                          </li>
                        </ul>
                        <ul class="totals clear">
                          <li class="subtotal2 clear">
                            <div class="total">
                              <span class="name">Subtotal
                              </span>
                              <span class="total-price">Rs.675.00
                              </span>
                            </div>
                          </li>
                        </ul>
                      </div>
                      <button type="button" class="checkout">Checkout
                      </button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- /page content -->
    <footer class="footer">
      <div class="container-fluid pop-padding">
          <div class="row">
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                <div class="total-item">
                        <i class="fa fa-wpforms"></i> <span>4</span>
                </div>
            </div>
            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-6 pop-padding">
                <div class="total-price-footer text-center">
                  Total :  Rs.675.00
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 pop-padding">
            <button type="button" class="checkout" data-toggle="modal" data-target="#myModal">Checkout</button>  
            </div>
          </div>
        
      </div>
    </footer>

<div id="myModal" class="modal animated zoomin">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Your Order</h4>

            </div>
           
            <div class="modal-body">
               <div class="row">
                    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                       <div class="order-inner">
                        <ul class="order-items modal-height scrollbar" id="style-1">
                          <li>
                            <div class="details">
                              <div class="veg-tag">
                                <img src="images/menu/veg_icon.jpg" class="veg">
                              </div>
                              <span class="dish-name">
                                Veg Thali
                              </span>
                            <button type="button" class="btn btn-item-close">
                                    <i class="fa fa-times-circle" aria-hidden="true">
                                    </i> 
                                  </button>
                            </div>
                            <div class="count">
                              <div class="number">
                                <div class="dec">
                                  <button type="button" class="btn btn-item">
                                    <i class="fa fa-minus" aria-hidden="true">
                                    </i> 
                                  </button>
                                </div>
                                <input type="text" value="1" class="no-tem"  disabled>
                                <div class="inc">
                                  <button type="button" class="btn btn-item">
                                    <i class="fa fa-plus" aria-hidden="true">
                                    </i>
                                  </button>
                                </div>
                              </div>
                              <div class="quantity">x Rs.155.00
                              </div>
                            </div>
                            <div class="price item-price ">
                              Rs.155.00
                            </div>
                            <div class="clear">
                            </div>
                          </li>
                          <li>
                            <div class="details">
                              <div class="veg-tag">
                                <img src="images/menu/non_veg_icon.jpg" class="veg">
                              </div>
                              <span class="dish-name">
                                Butter Chicken
                              </span>
                                    <button type="button" class="btn btn-item-close">
                                    <i class="fa fa-times-circle" aria-hidden="true">
                                    </i> 
                                  </button>
                            </div>
                            <div class="count">
                              <div class="number">
                                <div class="dec">
                                  <button type="button" class="btn btn-item">
                                    <i class="fa fa-minus" aria-hidden="true">
                                    </i> 
                                  </button>
                                </div>
                                <input type="text" value="1" class="no-tem"  disabled>
                                <div class="inc">
                                  <button type="button" class="btn btn-item">
                                    <i class="fa fa-plus" aria-hidden="true">
                                    </i>
                                  </button>
                                </div>
                              </div>
                              <div class="quantity">x Rs.155.00
                              </div>
                            </div>
                            <div class="price item-price ">
                              Rs.155.00
                            </div>
                            <div class="clear">
                            </div>
                          </li>
                          <li>
                            <div class="details">
                              <div class="veg-tag">
                                <img src="images/menu/veg_icon.jpg" class="veg">
                              </div>
                              <span class="dish-name">
                                Veg Thali
                              </span>
                                    <button type="button" class="btn btn-item-close">
                                    <i class="fa fa-times-circle" aria-hidden="true">
                                    </i> 
                                  </button>
                            </div>
                            <div class="count">
                              <div class="number">
                                <div class="dec">
                                  <button type="button" class="btn btn-item">
                                    <i class="fa fa-minus" aria-hidden="true">
                                    </i> 
                                  </button>
                                </div>
                                <input type="text" value="1" class="no-tem"  disabled>
                                <div class="inc">
                                  <button type="button" class="btn btn-item">
                                    <i class="fa fa-plus" aria-hidden="true">
                                    </i>
                                  </button>
                                </div>
                              </div>
                              <div class="quantity">x Rs.155.00
                              </div>
                            </div>
                            <div class="price item-price ">
                              Rs.155.00
                            </div>
                            <div class="clear">
                            </div>
                          </li>
                              <li>
                            <div class="details">
                              <div class="veg-tag">
                                <img src="images/menu/non_veg_icon.jpg" class="veg">
                              </div>
                              <span class="dish-name">
                                Butter Chicken
                              </span>
                                    <button type="button" class="btn btn-item-close">
                                    <i class="fa fa-times-circle" aria-hidden="true">
                                    </i> 
                                  </button>
                            </div>
                            <div class="count">
                              <div class="number">
                                <div class="dec">
                                  <button type="button" class="btn btn-item">
                                    <i class="fa fa-minus" aria-hidden="true">
                                    </i> 
                                  </button>
                                </div>
                                <input type="text" value="1" class="no-tem"  disabled>
                                <div class="inc">
                                  <button type="button" class="btn btn-item">
                                    <i class="fa fa-plus" aria-hidden="true">
                                    </i>
                                  </button>
                                </div>
                              </div>
                              <div class="quantity">x Rs.155.00
                              </div>
                            </div>
                            <div class="price item-price ">
                              Rs.155.00
                            </div>
                            <div class="clear">
                            </div>
                          </li>
                            <li>
                            <div class="details">
                              <div class="veg-tag">
                                <img src="images/menu/veg_icon.jpg" class="veg">
                              </div>
                              <span class="dish-name">
                                Veg Thali
                              </span>
                                    <button type="button" class="btn btn-item-close">
                                    <i class="fa fa-times-circle" aria-hidden="true">
                                    </i> 
                                  </button>
                            </div>
                            <div class="count">
                              <div class="number">
                                <div class="dec">
                                  <button type="button" class="btn btn-item">
                                    <i class="fa fa-minus" aria-hidden="true">
                                    </i> 
                                  </button>
                                </div>
                                <input type="text" value="1" class="no-tem"  disabled>
                                <div class="inc">
                                  <button type="button" class="btn btn-item">
                                    <i class="fa fa-plus" aria-hidden="true">
                                    </i>
                                  </button>
                                </div>
                              </div>
                              <div class="quantity">x Rs.155.00
                              </div>
                            </div>
                            <div class="price item-price ">
                              Rs.155.00
                            </div>
                            <div class="clear">
                            </div>
                          </li>
                              <li>
                            <div class="details">
                              <div class="veg-tag">
                                <img src="images/menu/non_veg_icon.jpg" class="veg">
                              </div>
                              <span class="dish-name">
                                Butter Chicken
                              </span>
                                    <button type="button" class="btn btn-item-close">
                                    <i class="fa fa-times-circle" aria-hidden="true">
                                    </i> 
                                  </button>
                            </div>
                            <div class="count">
                              <div class="number">
                                <div class="dec">
                                  <button type="button" class="btn btn-item">
                                    <i class="fa fa-minus" aria-hidden="true">
                                    </i> 
                                  </button>
                                </div>
                                <input type="text" value="1" class="no-tem"  disabled>
                                <div class="inc">
                                  <button type="button" class="btn btn-item">
                                    <i class="fa fa-plus" aria-hidden="true">
                                    </i>
                                  </button>
                                </div>
                              </div>
                              <div class="quantity">x Rs.155.00
                              </div>
                            </div>
                            <div class="price item-price ">
                              Rs.155.00
                            </div>
                            <div class="clear">
                            </div>
                          </li>
                        </ul>
                        <ul class="totals clear">
                          <li class="subtotal2 clear">
                            <div class="total">
                              <span class="name">Subtotal
                              </span>
                              <span class="total-price">Rs.675.00
                              </span>
                            </div>
                          </li>
                        </ul>
                      </div> 
                        <button type="button" class="checkout">Place Order
                      </button>
                    </div>
                 <div class="modal-footer">
                 </div>
                </div>
               </div>
            </div>
         </div>
        </div> 
<?= $this->start('script') ?>
 <script>
  
$(document).ready(function(){
    $("#filter").keyup(function(){
 
        // Retrieve the input field text and reset the count to zero
        var filter = $(this).val();
 
        // Loop through the comment list
        $("#contents li").each(function(){
 
            // If the list item does not contain the text phrase fade it out
            if ($(this).text().search(new RegExp(filter, "i")) < 0) {
                $(this).fadeOut();
 
            // Show the list item if the phrase matches
            } else {
                $(this).show();
            }
        });
 
    });
});

$(".btn-price").click(function(){
    $(".order-items").append(" <li><div class='details'><div class='veg-tag'><img src='images/menu/veg_icon.jpg' class='veg'></div><span class='dish-name'>Veg Thali</span><button type='button' class='btn btn-item-close btn-dis' ><i class='fa fa-times-circle' aria-hidden='true'></i> </button></div><div class='count'><div class='number'><div class='dec'><button type='button' class='btn btn-item'><i class='fa fa-minus' aria-hidden='true'></i> </button></div><input type='text' value='1' class='no-tem'  disabled><div class='inc'><button type='button' class='btn btn-item'><i class='fa fa-plus' aria-hidden='true'></i></button></div></div><div class='quantity'>x Rs.155.00</div></div><div class='price item-price'>Rs.155.00</div><div class='clear'></div></li>");
    
   
});
 $(".order-items").load;
$(".btn-item-close").click(function() {
  $(this).parent().parent().remove();
});
         
/*
$(document).ready(function(){       
   var scroll_start = 0;
   var startchange = $('#soups');
   var offset = startchange.offset();
   alert(scroll_start);
    if (startchange.length){
        
   $(".category-item").scroll(function() { 
      
      scroll_start = $(this).scrollTop();
       //alert(scroll_start);
      if(scroll_start > 280) {
         $('a').each(function () {
            $(this).removeClass('active-menu');
        $(".soups-cat").addClass('active-menu');
        })
      
       } else {
          $(".soups-cat").removeClass('active-menu');
         
       }
   });
    }
});*/
  

</script>
<?= $this->end('script') ?>