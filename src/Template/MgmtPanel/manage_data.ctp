<?php
    use Cake\Cache\Cache;
    use Cake\Core\Configure;
    use Cake\Datasource\ConnectionManager;
    use Cake\Error\Debugger;
    use Cake\Network\Exception\NotFoundException;
    use App\Controller;

    $this->layout = false;
     $this->layout = 'rorder_layout';
     $this->assign('title', 'Manage Data');
     //$this->start('content');
?>
            <section class="content-header">
                <h1>
                    Restaurant Statistics
                </h1>
                <ol class="breadcrumb">
                    <li><a href="Login.html"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li><a href="../mgmtpanel">MgmtPanel</a></li>
                    <li class="active">Statistics</li>
                </ol>
            </section>
            <section class="content">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box">                           
                            <section class="content content-div show-add-section">
                                <div class="row">
                                    <form action="menu/addnewmenu" method="post"> 
                                    <div class="manage-controls menu col-xs-3">
                                        <button>
                                    <?= $this->Html->image('quickserve-menu-control.png', ['class' => 'quickserve-menu','alt' => 'MENU'])?>
                                        <b>Menu</b>
                                        </button>
                                    </div>
                                    </form>  
                                    <form action="rtables/addnewtables" method="post" > 
                                    <div class="manage-controls tables col-xs-3"><button>
                                        <?= $this->Html->image('quickserve-table-control.png', ['class' => 'quickserve-menu','alt' => 'TABLE'])?>
                                        <b>Table</b> 
                                        </button>
                                    </div>
                                    </form> 
                                    <form action="user/addnewuser" method="post" > 
                                    <div class="manage-controls users col-xs-3"><button>
                                        <?= $this->Html->image('quickserve-user-control.png', ['class' => 'quickserve-menu','alt' => 'USER'])?>
                                         <b>User</b>
                                         </button>
                                    </div>
                                    </form> 
                                </div>
                                <div class="row">
                                     <form action="tablecategory/addnewtablecategory" method="post" > 
                                    <div class="manage-controls table-category col-xs-3"><button>
                                       <?= $this->Html->image('quickserve-tablecategory.png', ['class' => 'quickserve-menu','alt' => 'TABLE'])?>
                                         <b>Table Category</b>
                                         </button>
                                    </div>
                                     </form>
                                     <form action="menucategory/addnewmenucategory" method="post" > 
                                    <div class="manage-controls menu-category col-xs-3"><button>
                                          <?= $this->Html->image('quickserve-menucategory.png', ['class' => 'quickserve-menu','alt' => 'TABLE'])?>
                                         <b>Menu Category</b>
                                         </button>
                                    </div>
                                     </form>
                                    <div id="printbll" class="manage-controls print-bill col-xs-3" onclick="printbill()"><button>
                                        <?= $this->Html->image('quickserve-prinbill.png', ['class' => 'quickserve-menu','alt' => 'TABLE'])?>
                                        <b>Print Bill</b>
                                        </button>
                                    </div>
                                </div>
                            </section>
                        </div><!-- /.box -->                       
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </section><!-- /.content -->