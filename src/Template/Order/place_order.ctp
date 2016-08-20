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

 <div class="right_col" role="main">
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
                                      <img src="img/menu/veg_icon.jpg" class="veg">
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
                                      <img src="img/menu/veg_icon.jpg" class="veg">
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
                                      <img src="img/menu/veg_icon.jpg" class="veg">
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
                                      <img src="img/menu/veg_icon.jpg" class="veg">
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
                                      <img src="img/menu/veg_icon.jpg" class="veg">
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
                                      <img src="img/menu/veg_icon.jpg" class="veg">
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
                                      <img src="img/menu/veg_icon.jpg" class="veg">
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
                                      <img src="img/menu/veg_icon.jpg" class="veg">
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
                                      <img src="img/menu/veg_icon.jpg" class="veg">
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
                                      <img src="img/menu/veg_icon.jpg" class="veg">
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
                                      <img src="img/menu/veg_icon.jpg" class="veg">
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
                                      <img src="img/menu/veg_icon.jpg" class="veg">
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
                                      <img src="img/menu/veg_icon.jpg" class="veg">
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
                                      <img src="img/menu/veg_icon.jpg" class="veg">
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
                                      <img src="img/menu/veg_icon.jpg" class="veg">
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
                                      <img src="img/menu/veg_icon.jpg" class="veg">
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
                                <img src="img/menu/veg_icon.jpg" class="veg">
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
                                <img src="img/menu/non_veg_icon.jpg" class="veg">
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
                                <img src="img/menu/veg_icon.jpg" class="veg">
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
                                <img src="img/menu/veg_icon.jpg" class="veg">
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
                                <img src="img/menu/veg_icon.jpg" class="veg">
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
                                <img src="img/menu/veg_icon.jpg" class="veg">
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
                                <img src="img/menu/veg_icon.jpg" class="veg">
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
        </div>