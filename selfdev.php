                <?php if ($_SESSION['jabatan']=='7' && $_SESSION['divisi']=='11') {
                    echo "<script>
                        location.href='index?p=selfdevreview';
                      </script>";
                } ?>

                <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
                    <h2 class="text-lg font-medium mr-auto">
                        Form KPI Self Development
                    </h2>

                    <h1 class="text-2xl font-bold" style="text-transform:uppercase;">
                        Nama : <?php echo $_SESSION['nama']; ?></h1>
                </div>
                <!-- BEGIN: Datatable -->
                <?php
                    $cekstat = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * from kpi_self_header where nik='$_SESSION[nik]' AND YEAR(tahun)='$periode'"));

                    if ($cekstat==null) {
                        mysqli_query($conn,"INSERT into kpi_self_header VALUES(0,'$_SESSION[nik]','$_SESSION[nama]',0,0,'$periode',0)");
                        echo "<script>location.reload(); </script>";
                        exit();
                    }
                ?>

                <?php if ($cekstat['status']=='0') { ?>
                    <div class="rounded-md flex items-center px-5 py-4 mb-2 mt-2 bg-theme-1 text-white" style="width: 100%"> <i data-feather="alert-circle" class="w-6 h-6 mr-2"></i> STATUS OPEN : BELUM MENGUNCI KPI </div>
                <?php } ?>

                <?php if ($cekstat['status']=='1') { ?>
                    <div class="rounded-md flex items-center px-5 py-4 mb-2 mt-2 bg-theme-12 text-white" style="width: 100%"> <i data-feather="alert-circle" class="w-6 h-6 mr-2"></i> STATUS LOCK : SEDANG DALAM PENGAJUAN </div>
                <?php } ?>

                <?php if ($cekstat['status']=='2') { ?>
                    <div class="rounded-md flex items-center px-5 py-4 mb-2 mt-2 bg-theme-9 text-white" style="width: 100%"> <i data-feather="alert-circle" class="w-6 h-6 mr-2"></i> STATUS APPROVED : KPI DISETUJUI </div>
                <?php } ?>

                <?php if ($cekstat['status']=='3') { ?>
                    <div class="rounded-md flex items-center px-5 py-4 mb-2 mt-2 bg-theme-11 text-white" style="width: 100%"> <i data-feather="alert-circle" class="w-6 h-6 mr-2"></i> STATUS FINAL : KPI SELESAI </div>
                <?php } ?>
    
                <div class="intro-y datatable-wrapper box p-5 mt-5">
                    <table class="table table-report table-report--bordered display datatable w-full">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th class="border-b-2 whitespace-no-wrap">Key Performace Indicator</th>
                                <th class="border-b-2 whitespace-no-wrap">Realisasi </th>
                                <th class="border-b-2 text-center whitespace-no-wrap">Actions</th>
                                
                        </thead>
                        <tbody>
                            <?php 
                            $no=1;
                                $query = "SELECT * from kpi_self where nik='$_SESSION[nik]' AND YEAR(tahun)='$periode' order by no_kpi_self DESC";
                                $data_query= mysqli_query($conn,$query);
                                while ($data = mysqli_fetch_assoc($data_query)) {
                                  
                             ?>
                            <tr> 
                                <td><?php echo $no++; ?></td>
                                <td><?php echo $data['kpi']; ?></td>
                                <td><?php echo $data['realisasi']; ?></td>
                                <td class="border-b w-4">
                                    <?php if ($cekstat['status']=='0') { ?>
                                        <div class="flex sm:justify-center items-center">
                                            <a onclick="update('<?php echo $data['no_kpi_self']; ?>')" href="javascript:;" data-toggle="modal" data-target="#update-item-modal" class="button w-50 bg-theme-1 text-white">UPDATE</a>
                                        </div>
                                    <?php } ?>
                                    <?php if ($cekstat['status']=='1') { ?>
                                        <div class="flex sm:justify-center items-center">
                                            <a onclick="alert('Status pengajuan lock, ada tidak bisa mengedit. Silahkan konsultasikan KPI dengan management / HRD')" class="button w-50 bg-theme-6 text-white"><i data-feather="lock"></i></a>
                                        </div>
                                    <?php } ?>
                                    <?php if ($cekstat['status']=='2') { ?>
                                        <div class="flex sm:justify-center items-center">
                                            <a onclick="realisasi('<?php echo $data['no_kpi_self']; ?>')" href="javascript:;" data-toggle="modal" data-target="#realisasi-item-modal" class="button w-50 bg-theme-1 text-white">REALISASI</a>
                                        </div>
                                    <?php } ?>
                                </td>   
                            </tr>
                        <?php } ?>


                        </tbody>
                    </table>

                    
                </div>

           
                <?php if ($cekstat['status'] < 1) { ?>
                    <a onclick="return confirm('Anda yakin akan mengajukan?')" href="action/simpankpiselfajukan?nik=<?php echo $_SESSION['nik'] ?>" class="button text-white bg-theme-1 shadow-md cursor-pointer shadow-md fixed bottom-0 right-0 box border rounded-full w-100 h-12 flex items-center justify-center z-50 mb-10 mr-10" style="margin-right: 220px">Simpan & Ajukan &nbsp; <i data-feather="save"></i></a>
               
                    <a href="javascript:;" data-toggle="modal" data-target="#add-item-modal" class="button text-white bg-theme-1 shadow-md cursor-pointer shadow-md fixed bottom-0 right-0 box border rounded-full w-40 h-12 flex items-center justify-center z-50 mb-10 mr-10">Tambah KPI &nbsp; <i data-feather="plus"></i></a>
               <?php } ?>

                <div class="modal" id="add-item-modal">
            
                    <div class="modal__content">
                        <div class="flex items-center px-5 py-5 sm:py-3 border-b border-gray-200">
                            <h2 class="font-medium text-base mr-auto">
                                Tambah KPI Self Development Baru
                            </h2>
                        </div>
                        <form method="POST" action="action/simpankpiself">
                        <div class="p-5 grid grid-cols-12 gap-4 row-gap-3">
                
                            <div class="col-span-12">
                                <label>Rencana KPI</label>
                                <textarea class="input w-full border mt-2 flex-1" placeholder="KPI" name="kpi" required=""></textarea> 
                            </div>
                          
                        </div>
                        <div class="px-5 py-3 text-right border-t border-gray-200">
                            <button type="button" data-dismiss="modal" class="button w-24 border text-gray-700 mr-1">Batal</button>

                            <button type="submit" class="button w-24 bg-theme-1 text-white">Simpan</button>
                        </div>
                        </form>    
                    </div>
                    
                </div>

                <div class="modal" id="update-item-modal">
            
                    <div class="modal__content">
                        <div class="flex items-center px-5 py-5 sm:py-3 border-b border-gray-200">
                            <h2 class="font-medium text-base mr-auto">
                                UPDATE KPI DATA
                            </h2>
                        </div>
                        <form method="POST" action="action/simpankpiselfupdate">
                        <div class="p-5 grid grid-cols-12 gap-4 row-gap-3">
                            <input type="hidden" id="no_kpi_self" name="no_kpi_self">
                            <div class="col-span-12">
                                <label>Rencana KPI</label>
                                <textarea class="input w-full border mt-2 flex-1" placeholder="KPI" name="kpi" required="" id="kpi"></textarea> 
                            </div>
                            
                        </div>
                        <div class="px-5 py-3 text-right border-t border-gray-200">
                            <button type="button" data-dismiss="modal" class="button w-24 border text-gray-700 mr-1">Batal</button>
                            <a href="#" id="hapuskpi" onclick="return confirm('Anda yakin akan dihapus?')" class="button w-24 bg-theme-6 border text-white mr-1">Hapus</a>
                            <button type="submit" class="button w-24 bg-theme-1 text-white">Update</button>
                        </div>
                        </form>    
                    </div>
                    
                </div>
                <!-- BEGIN: Delete Confirmation Modal -->
                <div class="modal" id="delete-confirmation-modal">
                    <div class="modal__content">
                        <div class="p-5 text-center">
                            <i data-feather="x-circle" class="w-16 h-16 text-theme-6 mx-auto mt-3"></i> 
                            <div class="text-3xl mt-5">Are you sure?</div>
                            <div class="text-gray-600 mt-2">Do you really want to delete these records? This process cannot be undone.</div>
                        </div>
                        <div class="px-5 pb-8 text-center">
                            <button type="button" data-dismiss="modal" class="button w-24 border text-gray-700 mr-1">Cancel</button>
                            <button type="button" class="button w-24 bg-theme-6 text-white">Delete</button>
                        </div>
                    </div>
                </div>
                <!-- END: Delete Confirmation Modal -->

                <script type="text/javascript">
                    function update(no_kpi_self){
                        $.ajax({
                            type:'GET',
                            url:'ajax/tampilkpiself',
                            data:'no_kpi_self='+no_kpi_self,
                            success: function(res) { // Jika berhasil
                                var json = $.parseJSON(res);
                                document.getElementById('kpi').innerHTML=json.kpi;
                                document.getElementById('no_kpi_self').value=no_kpi_self;
                                document.getElementById("hapuskpi").href="action/hapuskpiself?id="+no_kpi_self; 
                            }
                        }); 
                    }
                    function realisasi(no_kpi_self){
                        $.ajax({
                            type:'GET',
                            url:'ajax/tampilkpi',
                            data:'no_kpi_self='+no_kpi_self,
                            success: function(res) { // Jika berhasil
                                var json = $.parseJSON(res);
                                document.getElementById('no_kpi_self2').value=no_kpi_self;
                                document.getElementById('realisasi').value=json.realisasi;
                            }
                        }); 
                    }
                </script>