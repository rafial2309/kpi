                <?php if ($_SESSION['jabatan']=='7' && $_SESSION['divisi']=='11') {
                    echo "<script>
                        location.href='index?p=matrixreview';
                      </script>";
                } ?>

                <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
                    <h2 class="text-lg font-medium mr-auto">
                        Form KPI Matrix
                    </h2>
                    <h1 class="text-2xl font-bold" style="text-transform:uppercase;">
                        Nama : <?php echo $_SESSION['nama']; ?></h1>
                </div>
                <!-- BEGIN: Datatable -->
                <?php
                    $cekstat = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * from kpi_matrix_header where nik='$_SESSION[nik]' AND YEAR(tahun)='$periode'"));

                    if ($cekstat==null && isset($_SESSION['nik'])) {
                        mysqli_query($conn,"INSERT into kpi_matrix_header VALUES(0,'$_SESSION[nik]','$_SESSION[nama]',0,0,'$periode',0)");
                        echo "<script>location.reload(); </script>";
                        exit();
                    }
                ?>

                <?php if ($cekstat['status']=='0') { ?>
                    <div class="rounded-md flex items-center px-5 py-4 mb-2 mt-2 bg-theme-1 text-white" style="width: 100%"> <i data-feather="alert-circle" class="w-6 h-6 mr-2"></i> STATUS OPEN : BELUM MENGUNCI KPI </div>
                <?php } ?>

                <?php if ($cekstat['status']=='1') { ?>
                    <div class="rounded-md flex items-center px-5 py-4 mb-2 mt-2 bg-theme-11 text-white" style="width: 100%"> <i data-feather="alert-circle" class="w-6 h-6 mr-2"></i> STATUS LOCK : SEDANG DALAM PENGAJUAN </div>
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
                                <th class="border-b-2 whitespace-no-wrap">Bobot</th>
                                <th class="border-b-2 whitespace-no-wrap">Target</th>
                                <th class="border-b-2 whitespace-no-wrap">Realisasi </th>
                                <th class="border-b-2 whitespace-no-wrap">Score</th>
                                <th class="border-b-2 whitespace-no-wrap">Score Akhir</th>
                                <th class="border-b-2 text-center whitespace-no-wrap">Actions</th>
                                
                        </thead>
                        <tbody>
                            <?php 
                            $no=1;
                            $bobot=0;
                            $totalscore=0;
                                $query = "SELECT * from kpi_matrix where nik='$_SESSION[nik]' and tahun='$periode' order by no_kpi_mat ASC";
                                $data_query= mysqli_query($conn,$query);
                                while ($data = mysqli_fetch_assoc($data_query)) {
                                    $bobot = $bobot+$data['bobot'];
                                    $totalscore = $totalscore + $data['score_akhir'];
                             ?>
                            <tr> 
                                <td><?php echo $no++; ?></td>
                                <td><?php echo $data['kpi']; ?> <b>[KPI <?php echo $data['jenis_target'] ?>]</b></td>
                                <td><?php echo $data['bobot']; ?></td>
                                <td><?php echo $data['target']; ?></td>
                                <td style="background-color: coral; border: 1px solid rgba(237, 242, 247, var(--bg-opacity))"><?php echo $data['realisasi']; ?></td>
                                <td style="background-color: yellow; border: 1px solid rgba(237, 242, 247, var(--bg-opacity))">
                                    <?php echo $data['score']; ?>
                                        
                                </td>
                                <td style="background-color: cadetblue; border: 1px solid rgba(237, 242, 247, var(--bg-opacity))"><?php echo $data['score_akhir']; ?></td>
                                <td class="border-b w-4">
                                    <?php if ($cekstat['status']=='0') { ?>
                                        <div class="flex sm:justify-center items-center">
                                            <a onclick="update('<?php echo $data['no_kpi_mat']; ?>')" href="javascript:;" data-toggle="modal" data-target="#update-item-modal" class="button w-50 bg-theme-1 text-white">UPDATE</a>
                                        </div>
                                    <?php } ?>
                                    <?php if ($cekstat['status']=='1') { ?>
                                        <div class="flex sm:justify-center items-center">
                                            <a onclick="alert('Status pengajuan lock, ada tidak bisa mengedit. Silahkan konsultasikan KPI dengan management / HRD')" class="button w-50 bg-theme-6 text-white"><i data-feather="lock"></i></a>
                                        </div>
                                    <?php } ?>
                                    <?php if ($cekstat['status']=='2') { ?>
                                        <div class="flex sm:justify-center items-center">
                                            <a onclick="realisasi('<?php echo $data['no_kpi_mat']; ?>')" href="javascript:;" data-toggle="modal" data-target="#realisasi-item-modal" class="button w-50 bg-theme-1 text-white">REALISASI</a>
                                        </div>
                                    <?php } ?>
                                </td>   
                            </tr>
                        <?php } ?>


                        </tbody>
                    </table>

                    <?php if ($cekstat['status']<2) { ?>
                        <?php if ($bobot=='100') { ?>
                            <div class="rounded-md flex items-center px-5 py-4 mb-2 mt-2 bg-theme-9 text-white" style="width: 100%"> <i data-feather="alert-circle" class="w-6 h-6 mr-2"></i> TOTAL BOBOT : <?php echo $bobot; ?>% SUDAH TERPENUHI </div>
                        <?php } ?>
                        
                        <?php if ($bobot>'100') { ?>
                            <div class="rounded-md flex items-center px-5 py-4 mb-2 mt-2 bg-theme-6 text-white" style="width: 100%"> <i data-feather="alert-circle" class="w-6 h-6 mr-2"></i> TOTAL BOBOT : <?php echo $bobot; ?>% MELEBIHI 100% SILAHKAN EDIT BOBOT KPI </div>
                        <?php } ?>

                        <?php if ($bobot<'100') { ?>
                            <div class="rounded-md flex items-center px-5 py-4 mb-2 mt-2 bg-theme-11 text-white" style="width: 100%"> <i data-feather="alert-circle" class="w-6 h-6 mr-2"></i> TOTAL BOBOT : <?php echo $bobot; ?>% BELUM TERPENUHI, SILAHKAN TAMBAHKAN KPI UNTUK MENCAPAI 100% </div>
                        <?php } ?>
                    <?php }else{ ?>
                                <?php if ($totalscore>=90) {
                                    $txtnilai = "SANGAT BAIK (BERHASIL)";
                                    $bg = 'bg-theme-1';
                                }elseif($totalscore>=76){
                                    $txtnilai = "BAIK";
                                    $bg = 'bg-theme-11';
                                }elseif($totalscore>=50){
                                    $txtnilai = "CUKUP";
                                    $bg = 'bg-theme-6';
                                }else{
                                    $txtnilai = "KURANG";
                                    $bg = 'bg-theme-6';
                                } ?>
                            <div class="rounded-md flex items-center px-5 py-4 mb-2 mt-2 <?php echo $bg; ?> text-white" style="width: 100%;font-weight: bold;font-size: 25px;"> <i data-feather="alert-circle" class="w-6 h-6 mr-2"></i> TOTAL SCORE : <?php echo $totalscore; ?> - <?php echo $txtnilai; ?>

                            </div>
                    <?php } ?>
                </div>

              <div class="col-span-12 md:col-span-6 2xl:col-span-12 mt-3 2xl:mt-6">
                        <div class="intro-x flex items-center h-10">
                            <h2 class="text-lg font-medium truncate mr-5">Panel Diskusi</h2>
                        </div>
                        <div class="mt-5 relative before:block before:absolute before:w-px before:h-[85%] before:bg-slate-200 before:dark:bg-darkmode-400 before:ml-5 before:mt-5">
                            <?php 
                            $query = mysqli_query($conn,"SELECT * from kpi_diskusi where tahun='$periode' AND  (nik_from='$_SESSION[nik]' OR nik_to='$_SESSION[nik]')");
                            while($data=mysqli_fetch_assoc($query)){
                            ?>
                            <div class="intro-x relative flex items-center mb-3">
                                <div class="before:block before:absolute before:w-20 before:h-px before:bg-slate-200 before:dark:bg-darkmode-400 before:mt-5 before:ml-5">
                                    <div class="w-10 h-10 flex-none image-fit rounded-full overflow-hidden">
                                        <img alt="JEEVES" src="https://jvsindo.com/jeevesindonesia/assets/img/dummy/<?php echo $data['nik_from']; ?>.jpg" onerror="this.onerror=null; this.src='dist/images/user1-min.jpg'">
                                    </div>
                                </div>
                                <div class="box px-5 py-3 ml-4 flex-1 zoom-in">
                                    <div class="flex items-center">
                                        <div class="font-medium"><?php echo $data['nama']; ?></div>
                                        <div class="text-xs text-slate-500 ml-auto"><?php echo date("d F Y H:i", strtotime($data['waktu'])); ?></div>
                                    </div>
                                    <div class="text-slate-500 mt-1"><?php echo $data['diskusi']; ?></div>
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                    <!-- END: Recent Activities -->

                    <a href="javascript:;" data-toggle="modal" data-target="#diskusi-item-modal" class="button text-white bg-theme-1 shadow-md cursor-pointer shadow-md fixed bottom-0 right-0 box border rounded-full w-100 h-12 flex items-center justify-center z-50 mb-10" style="margin-right: 210px">Tulis Diskusi &nbsp; <i data-feather="edit"></i></a>
            
                    <div class="modal" id="diskusi-item-modal">
            
                        <div class="modal__content">
                            <div class="flex items-center px-5 py-5 sm:py-3 border-b border-gray-200">
                                <h2 class="font-medium text-base mr-auto">
                                    Tulis Diskusi
                                </h2>
                            </div>
                            <form method="POST" action="action/simpandiskusi">
                            <div class="p-5 grid grid-cols-12 gap-4 row-gap-3">
                                <input type="hidden" name="nik_to" value="231116">
                                <div class="col-span-12">
                                    <label>Tulis disini</label>
                                    <textarea class="input w-full border mt-2 flex-1" placeholder="Isi Diskusi" name="diskusi" required=""></textarea> 
                                </div>
                               
                            </div>
                            <div class="px-5 py-3 text-right border-t border-gray-200">
                                <button type="button" data-dismiss="modal" class="button w-24 border text-gray-700 mr-1">Batal</button>

                                <button type="submit" class="button w-24 bg-theme-1 text-white">Kirim</button>
                            </div>
                            </form>    
                        </div>
                        
                    </div>

                    <div class="modal" id="realisasi-item-modal">
            
                        <div class="modal__content">
                            <div class="flex items-center px-5 py-5 sm:py-3 border-b border-gray-200">
                                <h2 class="font-medium text-base mr-auto">
                                    Realisasi KPI
                                </h2>
                            </div>
                            <form method="POST" action="action/simpankpimatrixrealisasi">
                            <div class="p-5 grid grid-cols-12 gap-4 row-gap-3">
                                <input type="hidden" name="no_kpi_mat2" id="no_kpi_mat2" value="">
                                <div class="col-span-12">
                                    <label>Realisasi</label>
                                    <input type="text" class="input w-full border text-center" placeholder="100" name="realisasi" id="realisasi" required=""> 
                                </div>
                               
                            </div>
                            <div class="px-5 py-3 text-right border-t border-gray-200">
                                <button type="button" data-dismiss="modal" class="button w-24 border text-gray-700 mr-1">Batal</button>

                                <button type="submit" class="button w-24 bg-theme-1 text-white">Simpan</button>
                            </div>
                            </form> 

                            <div class="p-5 grid ">
                            <div class="preview" style="color: #2d3748">
                                <form data-single="true" action="action/file-upload" class="dropzone border-gray-200 border-dashed">
                                    <div class="fallback">
                                        <input name="file" type="file" />
                                    </div>
                                    <div class="dz-message" data-dz-message>
                                        <div class="text-lg font-medium">Drop files here or click to upload.</div>
                                        <div class="text-gray-600"> This is just a demo dropzone. Selected files are <span class="font-medium">not</span> actually uploaded. </div>
                                    </div>
                                    <input type="hidden" name="tahun" value="<?php echo $periode; ?>">
                                    <input type="hidden" name="nik" value="<?php echo $_SESSION['nik']; ?>">
                                    <input type="hidden" name="no_kpi_mat_dat" id="no_kpi_mat_dat" value="">
                                </form>
                            </div>
                            <input type="hidden" id="namafile" name="">

                            </div>
                        </div>
                        
                    </div>

                <?php if ($bobot==100) { ?>
                    <?php if ($cekstat['status']=='0') { ?>
                        <a onclick="return confirm('Anda yakin akan mengajukan?')" href="action/simpankpimatrixajukan?nik=<?php echo $_SESSION['nik'] ?>" class="button text-white bg-theme-1 shadow-md cursor-pointer shadow-md fixed bottom-0 right-0 box border rounded-full w-100 h-12 flex items-center justify-center z-50 mb-10 mr-10">Simpan & Ajukan &nbsp; <i data-feather="save"></i></a>
                    <?php } ?>
                <?php }else{ ?>
                    <a href="javascript:;" data-toggle="modal" data-target="#add-item-modal" class="button text-white bg-theme-1 shadow-md cursor-pointer shadow-md fixed bottom-0 right-0 box border rounded-full w-40 h-12 flex items-center justify-center z-50 mb-10 mr-10">Tambah KPI &nbsp; <i data-feather="plus"></i></a>
                <?php } ?>

                <div class="modal" id="add-item-modal">
            
                    <div class="modal__content">
                        <div class="flex items-center px-5 py-5 sm:py-3 border-b border-gray-200">
                            <h2 class="font-medium text-base mr-auto">
                                Tambah KPI Baru
                            </h2>
                        </div>
                        <form method="POST" action="action/simpankpimatrix">
                        <div class="p-5 grid grid-cols-12 gap-4 row-gap-3">
                
                            <div class="col-span-12">
                                <label>Rencana KPI</label>
                                <textarea class="input w-full border mt-2 flex-1" placeholder="KPI" name="kpi" required=""></textarea> 
                            </div>
                            <div class="col-span-4">
                                <label>Bobot %</label>
                                <input type="number" min="1" max="100" class="input w-full border text-center" placeholder="20" name="bobot" required="">
                            </div>
                            <div class="col-span-4">
                                <label>Target</label>
                                <input type="number" min="1" class="input w-full border text-center" placeholder="100" name="target" required="">
                            </div>
                            <div class="col-span-4">
                                <label>Jenis KPI</label>
                                <div class="sm:mt-2"> <select class="input input--sm border mr-2" name="jenis_target">
                                     <option value="MAX">KPI Max</option>
                                     <option value="MIN">KPI Min</option>
                                 </select> </div>
                            </div>
                            <div class="col-span-12">
                                <small><b>KPI MAX : </b>Semakin <b>TINGGI</b> realisasi dari targetnya semakin bagus</small><br>
                                <small>Contoh: Meningkatkan penjualan dari 70% ke 80%</small>
                                 <hr>
                                <small><b>KPI MIN : </b>Semakin <b>RENDAH</b> realisasi dari targetnya semakin bagus</small><br>
                                <small>Contoh: Mempercepat pengerjaan XX kurang dari 60 menit</small>

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
                        <form method="POST" action="action/simpankpimatrixupdate">
                        <div class="p-5 grid grid-cols-12 gap-4 row-gap-3">
                            <input type="hidden" id="no_kpi_mat" name="no_kpi_mat">
                            <div class="col-span-12">
                                <label>Rencana KPI</label>
                                <textarea class="input w-full border mt-2 flex-1" placeholder="KPI" name="kpi" required="" id="kpi"></textarea> 
                            </div>
                            <div class="col-span-4">
                                <label>Bobot %</label>
                                <input type="number" min="1" max="100" class="input w-full border text-center" placeholder="20" name="bobot" id="bobot" required="">
                            </div>
                            <div class="col-span-4">
                                <label>Target</label>
                                <input type="number" min="1" class="input w-full border text-center" placeholder="100" name="target" id="target" required="">
                            </div>
                            <div class="col-span-4">
                                <label>Jenis KPI</label>
                                <div class="sm:mt-2"> <select class="input input--sm border mr-2" name="jenis_target" id="jenis_target">
                                     <option value="MAX">KPI Max</option>
                                     <option value="MIN">KPI Min</option>
                                 </select> </div>
                            </div>
                            <div class="col-span-12">
                                <small><b>KPI MAX : </b>Semakin <b>TINGGI</b> realisasi dari targetnya semakin bagus</small><br>
                                <small>Contoh: Meningkatkan penjualan dari 70% ke 80%</small>
                                 <hr>
                                <small><b>KPI MIN : </b>Semakin <b>RENDAH</b> realisasi dari targetnya semakin bagus</small><br>
                                <small>Contoh: Mempercepat pengerjaan XX kurang dari 60 menit</small>

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
                    function update(no_kpi_mat){
                        $.ajax({
                            type:'GET',
                            url:'ajax/tampilkpi',
                            data:'no_kpi_mat='+no_kpi_mat,
                            success: function(res) { // Jika berhasil
                                var json = $.parseJSON(res);
                                document.getElementById('kpi').innerHTML=json.kpi;
                                document.getElementById('bobot').value=json.bobot;
                                document.getElementById('target').value=json.target;
                                document.getElementById('no_kpi_mat').value=no_kpi_mat;
                                $('#jenis_target option[value="'+json.jenis_target+'"]').prop('selected', true);
                                document.getElementById("hapuskpi").href="action/hapuskpi?id="+no_kpi_mat; 
                            }
                        }); 
                    }
                    function realisasi(no_kpi_mat){
                        $.ajax({
                            type:'GET',
                            url:'ajax/tampilkpi',
                            data:'no_kpi_mat='+no_kpi_mat,
                            success: function(res) { // Jika berhasil
                                var json = $.parseJSON(res);
                                document.getElementById('no_kpi_mat2').value=no_kpi_mat;
                                document.getElementById('no_kpi_mat_dat').value=no_kpi_mat;
                                document.getElementById('realisasi').value=json.realisasi;
                            }
                        }); 
                    }
                </script>