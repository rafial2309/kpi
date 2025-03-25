            <!-- BEGIN: Side Menu -->
            <?php
            $uri = $_SERVER['REQUEST_URI']; 
            $page='dashboard';
            if (strpos($uri,'dashboard') !== false) { $page='dashboard';}
            if (strpos($uri,'matrix') !== false) { $page='matrix';}
            if (strpos($uri,'behaviour') !== false) { $page='behaviour';}
            if (strpos($uri,'selfdev') !== false) { $page='selfdev';}
            ?>
            <nav class="side-nav">
                <a href="#" class="intro-x flex items-center pl-5 pt-4">
                    <!-- <img alt="PT JEEVESINDO GEMILANG" class="w-6" src="dist/images/logo.png"> -->
                    <span class="hidden xl:block text-white text-lg ml-3">KPI <br>
                    <span style="font-size: 16px;background: white;color: #1c3faa;padding: 5px;border-radius: 5px;font-weight: bold;">JEEVES</span><br>
                   
                    
              </a>
                <div class="side-nav__devider my-6"></div>
                <ul>
                    
                    <li>
                        <a href="?p=dashboard" class="side-menu <?php if($page=='dashboard'){ echo "side-menu--active"; } ?>">
                            <div class="side-menu__icon"> <i data-feather="home"></i> </div>
                            <div class="side-menu__title"> Dashboard </div>
                        </a>
                    </li>
                    <?php if ($_SESSION['nik']=='231116') { ?>
                    <li>
                        <a href="?p=matrixreview" class="side-menu <?php if($page=='matrix'){ echo "side-menu--active"; } ?>">
                            <div class="side-menu__icon"> <i data-feather="target"></i> </div>
                            <div class="side-menu__title"> KPI Matrix </div>
                        </a>
                    </li>
                    <?php }else{ ?>
                    <li>
                        <a href="?p=matrix" class="side-menu <?php if($page=='matrix'){ echo "side-menu--active"; } ?>">
                            <div class="side-menu__icon"> <i data-feather="target"></i> </div>
                            <div class="side-menu__title"> KPI Matrix </div>
                        </a>
                    </li>
                    <?php } ?>
                    <li>
                        <a href="?p=behaviour" class="side-menu <?php if($page=='behaviour'){ echo "side-menu--active"; } ?>">
                            <div class="side-menu__icon"> <i data-feather="user-check"></i> </div>
                            <div class="side-menu__title"> KPI Behaviour </div>
                        </a>
                    </li>
                    <?php if ($_SESSION['nik']=='231116') { ?>
                    <li>
                        <a href="?p=selfdevreview" class="side-menu <?php if($page=='selfdev'){ echo "side-menu--active"; } ?>">
                            <div class="side-menu__icon"> <i data-feather="user-plus"></i> </div>
                            <div class="side-menu__title"> KPI Self Dev </div>
                        </a>
                    </li>
                    <?php }else{ ?>
                    <li>
                        <a href="?p=selfdev" class="side-menu <?php if($page=='selfdev'){ echo "side-menu--active"; } ?>">
                            <div class="side-menu__icon"> <i data-feather="user-plus"></i> </div>
                            <div class="side-menu__title"> KPI Self Dev </div>
                        </a>
                    </li>
                    <?php } ?>
                    <li class="side-nav__devider my-6"></li>
                    <li>
                        <span style="color:white;font-size: 28px;font-weight: bold;">PERIODE  <?php echo $periode; ?></span>
                        <br>
                        <span style="color:white">UBAH PERIODE &nbsp;</span> 
                        <select id="periodenya" class="input" style="margin-top: 8px;" onchange="gantiperiode()">
                            <option>--PILIH--</option>
                            <option>2023</option>
                            <option>2022</option>
                        </select>
                    </li>
              
    
                </ul>
            </nav>
            <!-- END: Side Menu -->
            <script>
                function gantiperiode(){
                    var periodenya = document.getElementById("periodenya").value;
                    window.location.href='gantiperiode?periode='+periodenya;
                }
            </script>