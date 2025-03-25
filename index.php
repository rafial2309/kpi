<?php include 'base/atas.php'; ?>

        <!-- END: Mobile Menu -->
        <div class="flex">
            <?php include 'base/m-menu.php'; ?>
            <!-- BEGIN: Content -->
            <div class="content">
                <?php include 'base/m-top.php'; ?>

                <?php 
                if (isset($_GET['p'])) {
                    if (file_exists($_GET['p'].'.php')) {   
                       include $_GET['p'].'.php';
                    }else{
                        
                    }
                    
                }else{
                    include 'dashboard.php';
                }
                ?>
            </div>
            <!-- END: Content -->
        </div>
        <!-- BEGIN: JS Assets-->
        
<?php include 'base/foot.php'; ?>