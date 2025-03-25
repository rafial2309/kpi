                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
                <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
                <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
                <!-- BEGIN: Wizard Layout -->
                <div class="intro-y box py-10 sm:py-20 mt-5">
                    <div class="wizard flex flex-col lg:flex-row justify-center px-5 sm:px-20">
                        <div class="intro-x lg:text-center flex items-center mt-5 lg:mt-0 lg:block flex-1 z-10">
                            <button class="w-10 h-10 rounded-full button text-gray-600 bg-gray-200">1</button>
                            <div class="lg:w-32 text-base lg:mt-3 ml-3 lg:mx-auto text-gray-700">Upload</div>
                        </div>

                        <div class="intro-x lg:text-center flex items-center lg:block flex-1 z-10">
                            <button class="w-10 h-10 rounded-full button text-white bg-theme-1">2</button>
                            <div class="lg:w-32 font-medium text-base lg:mt-3 ml-3 lg:mx-auto">Validasi</div>
                        </div>
                        
                        <div class="intro-x lg:text-center flex items-center mt-5 lg:mt-0 lg:block flex-1 z-10">
                            <button class="w-10 h-10 rounded-full button text-gray-600 bg-gray-200">3</button>
                            <div class="lg:w-32 text-base lg:mt-3 ml-3 lg:mx-auto text-gray-700">Print E-DO</div>
                        </div>
                        
                        <div class="wizard__line hidden lg:block w-2/3 bg-gray-200 absolute mt-5"></div>
                    </div>
                    <div class="intro-y datatable-wrapper box p-5 mt-5">
                    <table class="table table-report table-report--bordered display w-full">
                        <thead>
                            <tr>
                                <th class="border-b-2 whitespace-no-wrap">#</th>
                                <th class="border-b-2 whitespace-no-wrap">NAMA SHIPPER</th>
                                <th class="border-b-2 whitespace-no-wrap">NAMA CONSIGNEE</th>
                                <th class="border-b-2 whitespace-no-wrap">ALMT CONSIGNEE</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $no=1;
                            $no_aju='';
                                $query = "SELECT * from delivery_order where nomor_do='' AND no_user='$_SESSION[no_user]' order by no_do ASC";
                                $data_query= mysqli_query($conn,$query);
                                while ($data = mysqli_fetch_assoc($data_query)) {
                                    $no_aju=$data['no_aju'];
                             ?>
                            <tr class="bg-gray-200 dark:bg-dark-1"> 
                                <td><?php echo $no++; ?></td>
                                <td><?php echo $data["name_shipper"]; ?></td>
                                <td><?php echo $data["nama_consignee"]; ?></td>
                                <td><?php echo $data["almt_consignee"]; ?></td>
                            </tr>
                            <tr style="background-color: firebrick;color: white;">
                                <td colspan="2" style="padding-bottom: 1.75rem;">
                                    <label style="font-weight: 500;font-size: 15px;">PILIH CARRIER</label>
                                    <select onchange="carrier('<?php echo $data['no_do']; ?>','<?php echo $no; ?>')" class="js-example-basic-single" id="car-<?php echo $no; ?>" name="state" style="width: 100%">

                                        <?php if ($data['carrier']=='') { ?>
                                             <option>- - BELUM DIPILIH - -</option>
                                        <?php }else{ ?>
                                             <option value="<?php echo $data['carrier']; ?>"><?php echo $data['carrier']; ?></option>
                                        <?php } ?>
                                       

                                         <?php
                                         $qcarrier = mysqli_query($conn,"SELECT * from carrier");
                                         while ($dcarrier = mysqli_fetch_assoc($qcarrier)) { ?>
                                             <option value="<?php echo $dcarrier['carrier']; ?>"><?php echo $dcarrier['carrier']; ?></option>
                                         <?php } ?>
                                         
                                         
                                     </select> 
                                </td>
                                <td colspan="2" style="padding-bottom: 1.75rem;">
                                    <label style="font-weight: 500;font-size: 15px;">PILIH WAREHOUSE</label>
                                    <select class="js-example-basic-single" onchange="warehouse('<?php echo $data['no_do']; ?>','<?php echo $no; ?>')" name="state" id="war-<?php echo $no; ?>" style="width: 100%">
                                        
                                        <?php if ($data['warehouse']=='') { ?>
                                             <option>- - BELUM DIPILIH - -</option>
                                        <?php }else{ ?>
                                             <option value="<?php echo $data['warehouse']; ?>"><?php echo $data['warehouse']; ?></option>
                                        <?php } ?>

                                         <?php
                                         $qware = mysqli_query($conn,"SELECT * from warehouse");
                                         while ($dware = mysqli_fetch_assoc($qware)) { ?>
                                             <option value="<?php echo $dware['kode_warehouse']; ?>">KODE: <?php echo $dware['kode_warehouse']; ?> - <?php echo $dware['nama_warehouse']; ?></option>
                                         <?php } ?>
                                         
                                         
                                     </select> 
                                </td>
                            </tr>
                        <?php } ?>


                        </tbody>
                    </table>

                    <div class="text-right mt-5">
                                
                                <a href="action/batalkan" onclick="return confirm('Data import akan dihapus, Anda yakin membatalkannya?')" class="button w-24 border text-gray-700 mr-1">BATALKAN</a>
                                <a href="action/simpan_do?no_aju=<?php echo $no_aju; ?>" onclick="return confirm('Data akan disimpan, Anda yakin melanjutkannya?')" class="button w-50 bg-theme-1 text-white">SIMPAN DO</a>
                    </div>
                </div>
                </div>
                
                <!-- END: Wizard Layout -->
                    
                <script type="text/javascript">
                    $(document).ready(function() {
                        $('.js-example-basic-single').select2();
                    });

                    function carrier(no_do,no){
                        var data = document.getElementById("car-"+no).value;
                        var no_do = no_do;
                        $.ajax({
                            type:'GET',
                            url:'action/ajax_set_carrier?data='+data+'&no_do='+no_do,
                            success: function(data) { // Jika berhasil
                                console.log(data);
                            }
                        }); 
                    }

                    function warehouse(no_do,no){
                        var data = document.getElementById("war-"+no).value;
                        var no_do = no_do;
                        $.ajax({
                            type:'GET',
                            url:'action/ajax_set_warehouse?data='+data+'&no_do='+no_do,
                            success: function(data) { // Jika berhasil
                                console.log(data);
                            }
                        }); 
                    }
                </script>