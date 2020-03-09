<?php 
require_once('models/initialization.php'); 
require_once('landing/layouts/header.php');
?>
<!-- Breadcrumb Section Begin -->
<div class="breacrumb-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-text">
                    <a href="#"><i class="fa fa-home"></i> Home</a>
                    <span>Login</span>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb Form Section Begin -->

<!-- Register Section Begin -->
<div class="register-login-section spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 offset-lg-3">
                <div class="login-form">
                    <h2>Login</h2>
                    <form id="loginForm">
                        <div class="group-input">
                            <label for="email">Email address *</label>
                            <input type="text" id="email" name="email">
                        </div>
                        <div class="group-input">
                            <label for="password">Password *</label>
                            <input type="password" id="password" name="password">
                        </div>
                        <div class="group-input gi-check">
                            <div class="gi-more">
                                &nbsp;
                                <a href="<?php echo base_url(); ?>forget.php" class="forget-pass">Forget your Password</a>
                            </div>
                        </div>
                        <button type="submit" id="loginSubmitBtn" class="site-btn login-btn">Sign In</button>
                    </form>
                    <div class="switch-login">
                        <a href="<?php echo base_url(); ?>register.php" class="or-login">Or Create An Account</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Register Form Section End -->
<!-- Partner Logo Section End -->
<?php require_once('landing/layouts/footer.php'); ?>
<script src="<?php echo base_url(); ?>landing/js/login.js"></script>