<?php
    use Cake\Cache\Cache;
    use Cake\Core\Configure;
    use Cake\Datasource\ConnectionManager;
    use Cake\Error\Debugger;
    use Cake\Network\Exception\NotFoundException;
    use App\Controller;

    $this->layout = false;
     $this->layout = 'rorder_layout';
     $this->assign('title', 'Restaurant Data Management');
     //$this->start('content');
?>
            <section class="content-header">
                <h1>
                    Restaurant Data Management 
                </h1>
                <ol class="breadcrumb">
                    <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active">Data  Management</li>
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
                                    <form action="users" method="post" > 
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
                                    <div id="printbll" class="manage-controls print-bill col-xs-3" onclick="printbill()"><a href="printbill"><button>
                                        <?= $this->Html->image('quickserve-prinbill.png', ['class' => 'quickserve-menu','alt' => 'TABLE'])?>
                                        <b>Print Bill</b>
                                            </button></a>
                                    </div>
                                </div>
                            </section>
                        </div><!-- /.box -->                       
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </section><!-- /.content -->