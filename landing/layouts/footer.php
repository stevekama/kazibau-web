   <!-- Footer Section Begin -->
    <footer class="footer-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="footer-left">
                        <div class="footer-logo">
                            <a href="#"><img src="<?php echo base_url(); ?>landing/img/footer-logo.png" alt=""></a>
                        </div>
                        <ul>
                            <li>Address: Nairobi, Kenya</li>
                            <li>Phone: +254715053109</li>
                            <li>Email: info@kazibau.co.ke</li>
                        </ul>
                        <div class="footer-social">
                            <!-- <a href="#"><i class="fa fa-facebook"></i></a> -->
                            <a href="#"><i class="fa fa-instagram"></i></a>
                            <!-- <a href="#"><i class="fa fa-twitter"></i></a> -->
                            <a href="#"><i class="fa fa-pinterest"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 offset-lg-1">
                    <div class="footer-widget">
                        <h5>Information</h5>
                        <ul>
                            <li><a href="<?php echo base_url(); ?>landing/about.php">About Us</a></li>
                            <li><a href="#">Faqs</a></li>
                            <li><a href="<?php echo base_url(); ?>landing/contact.php">Contact</a></li>
                            <li><a href="<?php echo base_url(); ?>landing/shop.php">Shop</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="footer-widget">
                        <h5>My Account</h5>
                        <ul>
                            <li><a href="#">My Account</a></li>
                            <li><a href="#">Contact</a></li>
                            <li><a href="#">Shopping Cart</a></li>
                            <li><a href="#">Shop</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="newslatter-item">
                        <h5>Join Our Newsletter Now</h5>
                        <p>Get E-mail updates about our latest shop and special offers.</p>
                        <form action="#" class="subscribe-form">
                            <input type="text" placeholder="Enter Your Mail">
                            <button type="button">Subscribe</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="copyright-reserved">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="copyright-text">
                            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                            Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | Kazibau
                            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        </div>
                        <!-- <div class="payment-pic">
                            <img src="landing/img/payment-method.png" alt="">
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer Section End -->
    <!-- Js Plugins -->
    <script src="<?php echo base_url(); ?>landing/js/jquery-3.3.1.min.js"></script>
    <script src="https://unpkg.com/@popperjs/core@2/dist/umd/popper.js"></script>
    <script src="<?php echo base_url(); ?>landing/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>landing/js/jquery-ui.min.js"></script>
    <script src="<?php echo base_url(); ?>landing/js/jquery.countdown.min.js"></script>
    <script src="<?php echo base_url(); ?>landing/js/jquery.nice-select.min.js"></script>
    <script src="<?php echo base_url(); ?>landing/js/jquery.zoom.min.js"></script>
    <script src="<?php echo base_url(); ?>landing/js/jquery.dd.min.js"></script>
    <script src="<?php echo base_url(); ?>landing/js/jquery.slicknav.js"></script>
    <script src="<?php echo base_url(); ?>landing/js/owl.carousel.min.js"></script>
    <script src="<?php echo base_url(); ?>landing/js/main.js"></script>
    <script src="<?php echo base_url(); ?>landing/js/base_url.js"></script>
    <script>
        $(document).ready(function(){
            $('.logout').click(function(){
                var action = "LOGOUT";
                $.ajax({
                    url: base_url+'api/users/users.php',
                    type:"POST",
                    data:{action:action},
                    dataType:"json",
                    success:function(data){
                        if(data.message == "success"){
                            localStorage.clear();
                            window.location.href=base_url+'index.php';
                        }
                    }
                });
            });
        });
    </script>
</body>
</html>