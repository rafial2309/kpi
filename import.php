    
                <?php
                $cekdo = mysqli_query($conn,"SELECT no_do FROM delivery_order where nomor_do='' AND no_user='$_SESSION[no_user]'");
                if (mysqli_num_rows($cekdo) > 0) {
                    echo "<script type='text/javascript'>window.location='?p=validasi'</script>";
                    exit();
                }
                ?>
                <!-- BEGIN: Wizard Layout -->
                <div class="intro-y box py-10 sm:py-20 mt-5">
                    <div class="wizard flex flex-col lg:flex-row justify-center px-5 sm:px-20">
                        <div class="intro-x lg:text-center flex items-center lg:block flex-1 z-10">
                            <button class="w-10 h-10 rounded-full button text-white bg-theme-1">1</button>
                            <div class="lg:w-32 font-medium text-base lg:mt-3 ml-3 lg:mx-auto">Upload</div>
                        </div>
                        <div class="intro-x lg:text-center flex items-center mt-5 lg:mt-0 lg:block flex-1 z-10">
                            <button class="w-10 h-10 rounded-full button text-gray-600 bg-gray-200">2</button>
                            <div class="lg:w-32 text-base lg:mt-3 ml-3 lg:mx-auto text-gray-700">Validasi</div>
                        </div>
                        <div class="intro-x lg:text-center flex items-center mt-5 lg:mt-0 lg:block flex-1 z-10">
                            <button class="w-10 h-10 rounded-full button text-gray-600 bg-gray-200">3</button>
                            <div class="lg:w-32 text-base lg:mt-3 ml-3 lg:mx-auto text-gray-700">Print E-DO</div>
                        </div>
                        
                        <div class="wizard__line hidden lg:block w-2/3 bg-gray-200 absolute mt-5"></div>
                    </div>
                    <div class="px-5 sm:px-20 mt-5 pt-10 border-t border-gray-200">
                
                        <!-- BEGIN: Single File Upload -->

                        <div class="intro-y box" style="background-color: #383838;color: #fff;">
                            <div class="flex flex-col sm:flex-row items-center p-5 border-b border-gray-200">
                                <h2 class="font-medium text-base mr-auto">
                                    Import File Excel (Manifest)
                                </h2>
                                <div class="w-full sm:w-auto flex items-center sm:ml-auto mt-3 sm:mt-0">
                                        <input type="hidden" name="File" id="namafile">
                                        <button onclick="govalidasi()" class="button w-32 mr-2 mb-2 flex items-center justify-center border text-white"> <i data-feather="send" class="w-4 h-4 mr-2"></i> Process File </button>
                              
                                     
                                </div>
                            </div>
                            <div class="p-5" id="single-file-upload">

                                   
                            
                                <div class="preview" style="color: #2d3748">
                                    <form data-single="true" action="action/file-upload" class="dropzone border-gray-200 border-dashed">
                                        <div class="fallback">
                                            <input name="file" type="file" />
                                        </div>
                                        <div class="dz-message" data-dz-message>
                                            <div class="text-lg font-medium">Drop files here or click to upload.</div>
                                            <div class="text-gray-600"> This is just a demo dropzone. Selected files are <span class="font-medium">not</span> actually uploaded. </div>
                                        </div>
                                    </form>
                                </div>
                                
                                
                            </div>
                            <img src="dist/images/loading.gif" style="opacity: 0;height: 1px">
                            <img src="dist/images/check.gif" style="opacity: 0;height: 1px">
                        </div>
                        <!-- END: Single File Upload -->
                    </div>
                </div>
                



                <!-- END: Wizard Layout -->
                <script type="text/javascript">
                    function after(str, substr) {
                      return str.slice(str.indexOf(substr) + substr.length, str.length);
                    }
                    // function wzww(){ 
                    //  var innerHtml = $('.dz-details').html();
                    //  var str = after(innerHtml, '<span data-dz-name="">');
                    //  var name = str.replace("</span></div>  ", "");
                    //  document.getElementById("namafile").value = name; 
                    // }
                    function govalidasi(){
                        document.getElementById("single-file-upload").style.backgroundColor = "white";
                        $("#single-file-upload").html('<center><img src="dist/images/loading.gif"></center>');
                        var namafile = document.getElementById("namafile").value;
                        $.ajax({
                            type:'GET',
                            url:'import-excel/read?File='+namafile,
                            success: function(data) { // Jika berhasil
                                //alert(data);
                                if (data=='SUDAH ADA AJU') {
                                    alert("SUDAH ADA AJU");
                                    window.location.reload();
                                }else{
                                    if (data=='SUKSES') {
                                        $("#single-file-upload").html('<center><img src="dist/images/check.gif"></center>');
                                        setTimeout(function(){ window.location.href="?p=validasi"; }, 2000);
                                        
                                    }else{
                                        alert("GAGAL!");
                                    }
                                }
                                
                            }
                        }); 
                    }
                      
              
                </script>       

