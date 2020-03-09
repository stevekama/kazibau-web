<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Fashi Template">
    <meta name="keywords" content="Fashi, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Kazibau | Shopping</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Muli:300,400,500,600,700,800,900&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>landing/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>landing/css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>landing/css/themify-icons.css" type="text/css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>landing/css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>landing/css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>landing/css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>landing/css/jquery-ui.min.css" type="text/css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>landing/css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>landing/css/style.css" type="text/css">
</head>
<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Header Section Begin -->
    <header class="header-section">
        <div class="header-top">
            <div class="container">
                <div class="ht-left">
                    <div class="mail-service">
                        <i class="fa fa-envelope"></i>
                        info@kazibau.co.ke
                    </div>
                    <div class="phone-service">
                        <i class=" fa fa-phone"></i>
                        +254715053109
                    </div>
                </div>
                <?php if($session->is_logged_in()){
                    $user_id = $session->user_id; 
                    $user = new Users();
                    $current_user = $user->find_user_by_id($user_id);
                    ?>
                    <div class="ht-right">
                        <a href="#" class="login-panel logout">
                            Logout
                        </a>
                        <a href="#" class="login-panel">
                            <i class="fa fa-user"></i> Welcome <?php echo htmlentities($current_user['fullnames']); ?>
                        </a>
                        
                        <?php 
                        $user_type = new User_Type();
                        $type = $user_type->find_type_by_id($current_user['user_type_id']);
                        if(!$type){
                            die();
                        }
                        if($type['user_type'] == "ADMINS"){ ?>
                            <div class="lan-selector">
                                <div class="btn-group" role="group">
                                    <a href="<?php echo base_url(); ?>public/index.php" class="btn btn-link">Dashboard</a>
                                </div>
                            </div>
                        <?php } ?>
                        
                        <div class="top-social">
                            <!-- <a href="#"><i class="ti-facebook"></i></a> -->
                            <!-- <a href="#"><i class="ti-twitter-alt"></i></a> -->
                            <a href="#"><i class="ti-linkedin"></i></a>
                            <a href="#"><i class="ti-pinterest"></i></a>
                        </div>
                    </div>
                <?php }else{ ?>
                    <div class="ht-right">
                        <a href="<?php echo base_url(); ?>login.php" class="login-panel">
                            <i class="fa fa-user"></i>Login
                        </a>
                        <div class="top-social">
                            <!-- <a href="#"><i class="ti-facebook"></i></a> -->
                            <!-- <a href="#"><i class="ti-twitter-alt"></i></a> -->
                            <a href="#"><i class="ti-linkedin"></i></a>
                            <a href="#"><i class="ti-pinterest"></i></a>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
        <div class="container">
            <div class="inner-header">
                <div class="row">
                    <div class="col-lg-2 col-md-2">
                        <div class="logo">
                            <a href="<?php echo base_url(); ?>index.php">
                                <img src="<?php echo base_url(); ?>landing/img/logo.png" alt="" width="150">
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-7 col-md-7">
                        <div class="advanced-search">
                            <button type="button" class="category-btn">All Categories</button>
                            <div class="input-group">
                                <input type="text" placeholder="What do you need?">
                                <button type="button"><i class="ti-search"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 text-right col-md-3">
                        <ul class="nav-right">
                            <li class="heart-icon">
                                <a href="#">
                                    <i class="icon_heart_alt"></i>
                                    <span>1</span>
                                </a>
                            </li>
                            <li class="cart-icon">
                                <a href="#">
                                    <i class="icon_bag_alt"></i>
                                    <span>3</span>
                                </a>
                                <div class="cart-hover">
                                    <div class="select-items">
                                        <table>
                                            <tbody>
                                                <tr>
                                                    <td class="si-pic">
                                                        <img src="<?php echo base_url(); ?>landing/img/select-product-1.jpg" alt="">
                                                    </td>

                                                    <td class="si-text">
                                                        <div class="product-selected">
                                                            <p>Kes.60.00 x 1</p>
                                                            <h6>Kabino Bedside Table</h6>
                                                        </div>
                                                    </td>
                                                    <td class="si-close">
                                                        <i class="ti-close"></i>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="si-pic"><img src="<?php echo base_url(); ?>landing/img/select-product-2.jpg" alt=""></td>
                                                    <td class="si-text">
                                                        <div class="product-selected">
                                                            <p>Kes.60.00 x 1</p>
                                                            <h6>Kabino Bedside Table</h6>
                                                        </div>
                                                    </td>
                                                    <td class="si-close">
                                                        <i class="ti-close"></i>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="select-total">
                                        <span>total:</span>
                                        <h5>Kes.120.00</h5>
                                    </div>
                                    <div class="select-button">
                                        <a href="<?php echo base_url(); ?>/landing/cart.php" class="primary-btn view-card">VIEW CART</a>
                                        <a href="<?php echo base_url(); ?>/landing/checkout.php" class="primary-btn checkout-btn">CHECK OUT</a>
                                    </div>
                                </div>
                            </li>
                            <li class="cart-price">Kes.150.00</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="nav-item">
            <div class="container">
                <div class="nav-depart">
                    <div class="depart-btn">
                        <i class="ti-menu"></i>
                        <span>All Categories</span>
                        <?php 
                        $categories = new Categories();
                        $all_categories = $categories->fetch_all();
                        $count = $all_categories->rowCount(); ?>
                        <ul class="depart-hover">
                            <?php 
                            if($count > 0){
                                while($current_category = $all_categories->fetch(PDO::FETCH_ASSOC)){ ?>
                                    <li>
                                        <a href="<?php echo base_url(); ?>landing/categories.php?category=<?php echo urlencode($current_category['id']); ?>">
                                            <?php echo htmlentities($current_category['category_name']); ?>
                                        </a>
                                    </li>
                                <?php }
                            }else{ ?>
                                <li>
                                        <a href="#">
                                            No Categories added yet
                                        </a>
                                    </li>
                            <?php } ?>        
                        </ul>
                    </div>
                </div>
                <nav class="nav-menu mobile-menu">
                    <ul>
                        <li class="active"><a href="<?php echo base_url(); ?>index.php">Home</a></li>
                        <li><a href="<?php echo base_url(); ?>landing/shop.php">Shop</a></li>
                        <!-- <li>
                            <a href="#"></a>
                            <ul class="dropdown">
                                <li><a href="#">Men's</a></li>
                                <li><a href="#">Women's</a></li>
                                <li><a href="#">Kid's</a></li>
                            </ul>
                        </li> -->
                        <li><a href="<?php echo base_url(); ?>landing/contact.php">Contact</a></li>
                    </ul>
                </nav>
                <div id="mobile-menu-wrap"></div>
            </div>
        </div>
    </header>
    <!-- Header End -->
