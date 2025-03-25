                
                <!-- BEGIN: Wizard Layout -->
                <div class="intro-y box py-10 sm:py-20 mt-5">
                    <div class="wizard flex flex-col lg:flex-row justify-center px-5 sm:px-20">
                        <div class="intro-x lg:text-center flex items-center mt-5 lg:mt-0 lg:block flex-1 z-10">
                            <button class="w-10 h-10 rounded-full button text-gray-600 bg-gray-200">1</button>
                            <div class="lg:w-32 text-base lg:mt-3 ml-3 lg:mx-auto text-gray-700">Upload</div>
                        </div>

                       
                        
                        <div class="intro-x lg:text-center flex items-center mt-5 lg:mt-0 lg:block flex-1 z-10">
                            <button class="w-10 h-10 rounded-full button text-gray-600 bg-gray-200">2</button>
                            <div class="lg:w-32 text-base lg:mt-3 ml-3 lg:mx-auto text-gray-700">Validasi</div>
                        </div>

                         <div class="intro-x lg:text-center flex items-center lg:block flex-1 z-10">
                            <button class="w-10 h-10 rounded-full button text-white bg-theme-1">3</button>
                            <div class="lg:w-32 font-medium text-base lg:mt-3 ml-3 lg:mx-auto">Print E-DO</div>
                        </div>
                        
                        <div class="wizard__line hidden lg:block w-2/3 bg-gray-200 absolute mt-5"></div>
                    </div>
                    <div class="px-5 sm:px-20 mt-5 pt-10 border-t border-gray-200">
                        <center>
                            <div class="text-3xl font-bold leading-8" style="color: #1c3faa;"><?php echo $_GET['no_master_blawb']; ?> BERHASIL TERSIMPAN </div>
                            <br>
                            <hr>
                            <br>
                        <a target="_blank" href="print/e-do-multi?no_master_blawb=<?php echo $_GET['no_master_blawb']; ?>" class="button bg-theme-1 w-32 mr-2 mb-2 flex items-center justify-center border text-white"> <i data-feather="send" class="w-4 h-4 mr-2"></i> PRINT E-DO </a>
                        </center>
                    </div>
                </div>
                
                <!-- END: Wizard Layout -->
               