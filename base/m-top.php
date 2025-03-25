 <!-- BEGIN: Top Bar -->
                <div class="top-bar">
                    <!-- BEGIN: Breadcrumb -->
                    <div class="-intro-x breadcrumb mr-auto hidden sm:flex"> <div class="text-3xl font-bold leading-8" style="color: #1c3faa;">KEY PERFORMANCE INDICATOR</div> </div>
                    <!-- END: Breadcrumb -->
                   
                    <!-- BEGIN: Account Menu -->
                    <div class="intro-x dropdown w-8 h-8 relative">
                        <div class="dropdown-toggle w-8 h-8 rounded-full overflow-hidden shadow-lg image-fit zoom-in">
                            <img alt="JEEVES" src="https://jvsindo.com/jeevesindonesia/assets/img/dummy/<?php echo $_SESSION['nik']; ?>.jpg" onerror="this.onerror=null; this.src='dist/images/user1-min.jpg'">
                        </div>
                        <div class="dropdown-box mt-10 absolute w-56 top-0 right-0 z-20">
                            <div class="dropdown-box__content box bg-theme-38 text-white">
                                <div class="p-4 border-b border-theme-40">
                                    <div class="font-medium"><?php echo $_SESSION['nama']; ?></div>
                                    <div class="text-xs text-theme-41">JEEVES</div>
                                </div>
                             
                                <div class="p-2 border-t border-theme-40">
                                    <a href="action/logout.php" class="flex items-center block p-2 transition duration-300 ease-in-out hover:bg-theme-1 rounded-md"> <i data-feather="toggle-right" class="w-4 h-4 mr-2"></i> Logout </a>
                                    
                                    <?php if (isset($_SESSION['kdvaletfull'])) {
                                    $tags = explode(',',$_SESSION['kdvaletfull']);

                                    foreach($tags as $key) {    ?>
                                            <a href="../jeevesindonesia/pos/switch?kd=<?php echo $key; ?>" class="flex items-center block p-2 transition duration-300 ease-in-out hover:bg-theme-1 rounded-md"> <i data-feather="arrow-right" class="w-4 h-4 mr-2"></i> <?php echo $key; ?> </a>
                                        <?php }
                                        
                                    } ?>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END: Account Menu -->
                </div>
                <!-- END: Top Bar -->