                
            <?php
            date_default_timezone_set('Asia/Jakarta');
            $today = date("d F Y"); 
            $month = date("m");
            $year = date("Y");
            ?>
                <div class="grid grid-cols-12 gap-6">
                    <div class="col-span-12 xxl:col-span-9 grid grid-cols-12 gap-6">
                        <!-- BEGIN: General Report -->
                        <div class="col-span-12 mt-8">
                            <div class="intro-y flex items-center h-10">
                                <h2 class="text-lg font-medium truncate mr-5">
                                    General Report
                                </h2>
                                <a href="" class="ml-auto flex text-theme-1"> <i data-feather="refresh-ccw" class="w-4 h-4 mr-3"></i> Reload Data </a>
                            </div>
                            <div class="grid grid-cols-12 gap-6 mt-5">
                                
                                <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                                    <div class="report-box zoom-in">
                                        <div class="box p-5">
                                            <div class="flex">
                                                <i data-feather="users" class="report-box__icon text-theme-11"></i> 
                                            
                                            </div>
                                            <?php
                                            $q = mysqli_query($conn,"SELECT * from kpi_matrix_header where YEAR(tahun)='$periode'");
                                            $total = mysqli_num_rows($q);
                                            ?>
                                            <div class="text-3xl font-bold leading-8 mt-6"><?php echo $total; ?></div>
                                            <div class="text-base text-gray-600 mt-1">Total Karyawan</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                                    <div class="report-box zoom-in">
                                        <div class="box p-5">
                                            <div class="flex">
                                                <i data-feather="unlock" class="report-box__icon text-theme-12"></i> 
                                              
                                            </div>
                                            <?php
                                            $q1 = mysqli_query($conn,"SELECT * from kpi_matrix_header where status='0' AND YEAR(tahun)='$periode'");
                                            $total1 = mysqli_num_rows($q1);
                                            ?>
                                            <div class="text-3xl font-bold leading-8 mt-6"><?php echo $total1; ?></div>
                                            <div class="text-base text-gray-600 mt-1">KPI OPEN</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                                    <div class="report-box zoom-in">
                                        <div class="box p-5">
                                            <div class="flex">
                                                <i data-feather="lock" class="report-box__icon text-theme-10"></i> 
                                                
                                            </div>
                                            <?php
                                            $q2 = mysqli_query($conn,"SELECT * from kpi_matrix_header where status='1' AND YEAR(tahun)='$periode'");
                                            $total2 = mysqli_num_rows($q2);
                                            ?>
                                            <div class="text-3xl font-bold leading-8 mt-6"><?php echo $total2; ?></div>
                                            <div class="text-base text-gray-600 mt-1">KPI LOCK</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                                    <div class="report-box zoom-in">
                                        <div class="box p-5">
                                            <div class="flex">
                                                <i data-feather="target" class="report-box__icon text-theme-9"></i> 
                                            
                                            </div>
                                            <?php
                                            $q3 = mysqli_query($conn,"SELECT * from kpi_matrix_header where status='2' AND YEAR(tahun)='$periode'");
                                            $total3 = mysqli_num_rows($q3);
                                            ?>
                                            <div class="text-3xl font-bold leading-8 mt-6"><?php echo $total3; ?></div>
                                            <div class="text-base text-gray-600 mt-1">KPI APPROVED</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                         <div class="col-span-12 lg:col-span-12 mt-10">
                            
                            <center>
                                <img alt="PT JEEVESINDO GEMILANG" style="width: 350px;" src="dist/images/logo2.png">
                                <br><br>
                                <div class="text-1xl font-bold leading-8">© 2022 JEEVES INDONESIA – All Rights Reserved | by Piizaa </div>
                            </center>
                            
                        </div>
                        <!-- END: General Report -->
                        <!-- BEGIN: Sales Report -->
                       <!--  <div class="col-span-12 lg:col-span-6 mt-8">
                            <div class="intro-y block sm:flex items-center h-10">
                                <h2 class="text-lg font-medium truncate mr-5">
                                    Sales Report
                                </h2>
                                <div class="sm:ml-auto mt-3 sm:mt-0 relative text-gray-700">
                                    <i data-feather="calendar" class="w-4 h-4 z-10 absolute my-auto inset-y-0 ml-3 left-0"></i> 
                                    <input type="text" data-daterange="true" class="datepicker input w-full sm:w-56 box pl-10">
                                </div>
                            </div>
                            <div class="intro-y box p-5 mt-12 sm:mt-5">
                                <div class="flex flex-col xl:flex-row xl:items-center">
                                    <div class="flex">
                                        <div>
                                            <div class="text-theme-20 text-lg xl:text-xl font-bold">$15,000</div>
                                            <div class="text-gray-600">This Month</div>
                                        </div>
                                        <div class="w-px h-12 border border-r border-dashed border-gray-300 mx-4 xl:mx-6"></div>
                                        <div>
                                            <div class="text-gray-600 text-lg xl:text-xl font-medium">$10,000</div>
                                            <div class="text-gray-600">Last Month</div>
                                        </div>
                                    </div>
                                    <div class="dropdown relative xl:ml-auto mt-5 xl:mt-0">
                                        <button class="dropdown-toggle button font-normal border text-white relative flex items-center text-gray-700"> Filter by Category <i data-feather="chevron-down" class="w-4 h-4 ml-2"></i> </button>
                                        <div class="dropdown-box mt-10 absolute w-40 top-0 xl:right-0 z-20">
                                            <div class="dropdown-box__content box p-2 overflow-y-auto h-32"> <a href="" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white hover:bg-gray-200 rounded-md">PC & Laptop</a> <a href="" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white hover:bg-gray-200 rounded-md">Smartphone</a> <a href="" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white hover:bg-gray-200 rounded-md">Electronic</a> <a href="" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white hover:bg-gray-200 rounded-md">Photography</a> <a href="" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white hover:bg-gray-200 rounded-md">Sport</a> </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="report-chart">
                                    <canvas id="report-line-chart" height="160" class="mt-6"></canvas>
                                </div>
                            </div>
                        </div> -->
                        <!-- END: Sales Report -->
                        <!-- BEGIN: Weekly Top Seller -->
                        <!-- <div class="col-span-12 sm:col-span-6 mt-8">
                            <div class="intro-y flex items-center h-10">
                                <h2 class="text-lg font-medium truncate mr-5">
                                    Weekly Top Seller
                                </h2>
                                <a href="" class="ml-auto text-theme-1 truncate">See all</a> 
                            </div>
                            <div class="col-span-12 sm:col-span-6 xxl:col-span-3 intro-y mt-5">
                                <div class="mini-report-chart box p-5 zoom-in">
                                    <div class="flex items-center">
                                        <div class="w-2/4 flex-none">
                                            <div class="text-lg font-medium truncate">Target Sales</div>
                                            <div class="text-gray-600 mt-1">300 Sales</div>
                                        </div>
                                        <div class="flex-none ml-auto relative">
                                            <canvas id="report-donut-chart-1" width="90" height="90"></canvas>
                                            <div class="font-medium absolute w-full h-full flex items-center justify-center top-0 left-0">20%</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-span-12 sm:col-span-6 xxl:col-span-3 intro-y mt-5">
                                <div class="mini-report-chart box p-5 zoom-in">
                                    <div class="flex">
                                        <div class="text-lg font-medium truncate mr-3">Social Media</div>
                                        <div class="py-1 px-2 rounded-full text-xs bg-gray-200 text-gray-600 cursor-pointer ml-auto truncate">320 Followers</div>
                                    </div>
                                    <div class="mt-4">
                                        <canvas class="simple-line-chart-1 -ml-1" height="60"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                        <!-- END: Weekly Top Seller -->
                        
                      
                    </div>
                    
                </div>