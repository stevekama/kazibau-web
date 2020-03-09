<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?php echo base_url(); ?>public/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p class="userLoggedUsername"></p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <br>
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MAIN NAVIGATION</li>
            <li class="active treeview menu-open">
                <a href="#">
                    <i class="fa fa-dashboard"></i> 
                    <span>Dashboard</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="active"><a href="<?php echo base_url(); ?>public/index.php"><i class="fa fa-circle-o"></i> Dashboard</a></li>
                    <li><a href="<?php echo base_url(); ?>index.php"><i class="fa fa-circle-o"></i> Home</a></li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-files-o"></i>
                    <span>Categories</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                <li><a href="<?php echo base_url(); ?>public/categories/index.php"><i class="fa fa-circle-o"></i> Categories</a></li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-th"></i>
                    <span>Brands</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <a href="<?php echo base_url(); ?>public/brands/index.php">
                            <i class="fa fa-circle-o"></i> Brands
                        </a>
                    </li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-th"></i>
                    <span>Products</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <a href="<?php echo base_url(); ?>public/products/index.php">
                            <i class="fa fa-circle-o"></i> Products
                        </a>
                    </li>
                </ul>
            </li>

            <li class="header">ORDERS</li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-laptop"></i>
                    <span>Orders</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <a href="<?php echo base_url(); ?>public/orders/index.php">
                            <i class="fa fa-circle-o"></i> Orders
                        </a>
                    </li>
                </ul>
            </li>
            
            <li class="header">REPORTS && TRANSACTIONS</li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-barcode"></i> <span>Transactions</span>
                    <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <a href="<?php echo base_url(); ?>public/transactions/index.php">
                            <i class="fa fa-circle-o"></i> Transactions
                        </a>
                    </li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-bar-chart"></i> <span>Reports</span>
                    <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <a href="<?php echo base_url(); ?>public/reports/index.php">
                            <i class="fa fa-circle-o"></i> Reports
                        </a>
                    </li>
                </ul>
            </li>
            
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>