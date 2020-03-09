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
                    <span>Register</span>
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
                <div class="register-form">
                    <h2>Register</h2>
                    <form id="registrationForm" >
                        <div class="group-input">
                            <input type="hidden" id="user_type" value="2" name="type_id">
                        </div>
                        <div class="group-input">
                            <label for="fullnames">Fullnames *</label>
                            <input type="text" id="fullnames" name="fullnames">
                        </div>
                        <div class="group-input">
                            <label for="email">Email address *</label>
                            <input type="email" id="email" name="email">
                        </div>
                        <div class="group-input">
                            <label for="phone">Phone Number *</label>
                            <input type="text" id="phone" name="phone">
                        </div>
                        
                        <div class="group-input">
                            <label for="username">Username *</label>
                            <input type="text" id="username" name="username">
                        </div>
                        <div class="group-input">
                            <label for="pass">Password *</label>
                            <input type="password" id="password" name="password">
                        </div>
                        <div class="group-input">
                            <label for="con-pass">Confirm Password *</label>
                            <input type="password" id="confirm_password" name="confirm_password">
                        </div>
                        <button type="submit" id="registrationSubmitBtn" class="site-btn register-btn">REGISTER</button>
                    </form>
                    <div class="switch-login">
                        <a href="<?php echo base_url(); ?>login.php" class="or-login">Or Login</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Register Form Section End -->

<!-- Partner Logo Section End -->
<?php require_once('landing/layouts/footer.php'); ?>
<script src="<?php echo base_url(); ?>landing/js/registration.js"></script>