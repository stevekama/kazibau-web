        </div>
        <!-- /.content-wrapper -->

        <footer class="main-footer">
            <div class="pull-right hidden-xs">
                <b>Version</b> 2.4.13
            </div>
            <strong>Copyright &copy; 2014-2019 <a href="https://adminlte.io">AdminLTE</a>.</strong> All rights
            reserved.
        </footer>
        <div class="control-sidebar-bg"></div>
    </div>
    <!-- ./wrapper -->
    <!-- jQuery 3 -->
    <script src="<?php echo base_url(); ?>public/components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="<?php echo base_url(); ?>public/components/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- DataTables -->
    <script src="<?php echo base_url(); ?>/public/components/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url(); ?>/public/components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <!-- FastClick -->
    <!-- FastClick -->
    <script src="<?php echo base_url(); ?>public/components/fastclick/lib/fastclick.js"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo base_url(); ?>public/dist/js/adminlte.min.js"></script>
    <!-- Sparkline -->
    <script src="<?php echo base_url(); ?>public/components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
    <!-- jvectormap  -->
    <script src="<?php echo base_url(); ?>public/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
    <script src="<?php echo base_url(); ?>public/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <!-- SlimScroll -->
    <script src="<?php echo base_url(); ?>public/components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
    <!-- ChartJS -->
    <script src="<?php echo base_url(); ?>public/components/chart.js/Chart.js"></script>
     <!-- BASE URl -->
     <script src="<?php echo base_url(); ?>public/dist/js/base_url.js"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <!-- AdminLTE for demo purposes -->
    <script src="<?php echo base_url(); ?>public/dist/js/demo.js"></script>
    <script>
        $(document).ready(function(){
            function find_logged_in_user(){
                var action = "FETCH_USER";
                $.ajax({
                    url:base_url+'api/users/users.php',
                    type:"POST",
                    data:{action:action},
                    dataType:"json",
                    success:function(data){
                        if(data.message == "notLoggedIn"){
                            logout();
                        }else{
                            $('.userLoggedUsername').html(data.username);
                            $('.userLoggedFullNames').html(data.fullnames);
                            $('.userLoggedEmail').html(data.email);
                        }
                    }
                });
            }
            find_logged_in_user();

            function logout(){
                var action = "LOGOUT";
                $.ajax({
                    url:base_url+'api/users/users.php',
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

            }
        });
    </script>
</body>
</html>