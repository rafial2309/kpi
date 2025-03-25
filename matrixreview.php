                <?php if ($_SESSION['jabatan']!='7' && $_SESSION['divisi']!='11') {
                    echo "<script>
                        location.href='index?p=matrix';
                      </script>";
                } 
                $conn2 = mysqli_connect('103.176.44.250','itjeeves','Welcome@2025#Jeeves','jeevesimtap');
                ?>

             

                <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
                    <h2 class="text-lg font-medium mr-auto">
                        Form KPI Matrix Review <br>
                        
                    </h2>
                    <?php if (isset($_GET['nik'])) { ?>
                    <h1 class="text-2xl font-bold" style="text-transform:uppercase;"><?php $ceknama = mysqli_fetch_assoc(mysqli_query($conn2,"SELECT nama from karyawan where nik='$_GET[nik]'")) ?>
                        Nama : <?php echo $ceknama['nama']; ?></h1>
                    <?php 
                    $cekstat = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * from kpi_matrix_header where nik='$_GET[nik]' AND YEAR(tahun)='$periode'"));
                    } ?>
                </div>
                <!-- BEGIN: Datatable -->
                <?php if (isset($_GET['nik'])) { ?>
                <?php if ($cekstat['status']=='0') { ?>
                    <div class="rounded-md flex items-center px-5 py-4 mb-2 mt-2 bg-theme-1 text-white" style="width: 100%"> <i data-feather="alert-circle" class="w-6 h-6 mr-2"></i> STATUS OPEN : BELUM MENGUNCI KPI </div>
                <?php } ?>

                <?php if ($cekstat['status']=='1') { ?>
                    <div class="rounded-md flex items-center px-5 py-4 mb-2 mt-2 bg-theme-11 text-white" style="width: 100%"> <i data-feather="alert-circle" class="w-6 h-6 mr-2"></i> STATUS LOCK : SEDANG DALAM PENGAJUAN 
                        <a onclick="return confirm('Apakah anda yakin UNLOCK KPI?')" href="action/simpankpimatrixunlock?nik=<?php echo $_GET['nik'] ?>" class="button w-32 flex items-center justify-center bg-theme-1 text-white" style="margin-left: 20px;"> <i data-feather="unlock" class="w-4 h-4 mr-2"></i> UNLOCK KPI </a>
                    </div>
                <?php } ?>

                <?php if ($cekstat['status']=='2') { ?>
                    <div class="rounded-md flex items-center px-5 py-4 mb-2 mt-2 bg-theme-9 text-white" style="width: 100%"> <i data-feather="alert-circle" class="w-6 h-6 mr-2"></i> STATUS APPROVED : KPI DISETUJUI </div>
                <?php } ?>

                <?php if ($cekstat['status']=='3') { ?>
                    <div class="rounded-md flex items-center px-5 py-4 mb-2 mt-2 bg-theme-11 text-white" style="width: 100%"> <i data-feather="alert-circle" class="w-6 h-6 mr-2"></i> STATUS FINAL : KPI SELESAI </div>
                <?php } ?>
                <?php } ?>
                <div class="intro-y datatable-wrapper box p-5 mt-5">
                    <?php if (isset($_GET['nik'])) { ?>

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
                                   
                            </thead>
                            <tbody>
                                <?php 
                                $no=1;
                                $bobot=0;
                                $totalscore=0;
                                    $query = "SELECT * from kpi_matrix where nik='$_GET[nik]' AND YEAR(tahun)='$periode' order by no_kpi_mat ASC";
                                    $data_query= mysqli_query($conn,$query);
                                    while ($data = mysqli_fetch_assoc($data_query)) {
                                        $bobot = $bobot+$data['bobot'];
                                        $totalscore = $totalscore + $data['score_akhir'];
                                 ?>
                                <tr> 
                                    <td><?php echo $no++; ?></td>
                                    <td><?php echo $data['kpi']; ?></td>
                                    <td><?php echo $data['bobot']; ?></td>
                                    <td><?php echo $data['target']; ?></td>
                                    <td style="background-color: coral; border: 1px solid rgba(237, 242, 247, var(--bg-opacity))"><?php echo $data['realisasi']; ?></td>
                                    <td style="background-color: yellow; border: 1px solid rgba(237, 242, 247, var(--bg-opacity))"><?php echo $data['score']; ?></td>
                                    <td style="background-color: cadetblue; border: 1px solid rgba(237, 242, 247, var(--bg-opacity))"><?php echo $data['score_akhir']; ?></td>
                                    
                                </tr>
                            <?php } ?>


                            </tbody>
                        </table>
                    <?php }else{ ?>
                        <table class="table table-report table-report--bordered display datatable w-full">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th class="border-b-2 whitespace-no-wrap">NIK</th>
                                    <th class="border-b-2 whitespace-no-wrap">Nama</th>
                                    <th class="border-b-2 whitespace-no-wrap">Tanggal</th>
                                    <th class="border-b-2 whitespace-no-wrap">Status </th>
                                    <th class="border-b-2 text-center whitespace-no-wrap">Review</th>
                                    
                            </thead>
                            <tbody>
                                <?php 
                                $no=1;
                                    $query = "SELECT * from kpi_matrix_header WHERE YEAR(tahun)='$periode' order by nama ASC";
                                    $data_query= mysqli_query($conn,$query);
                                    while ($data = mysqli_fetch_assoc($data_query)) {
                                       
                                 ?>
                                <tr> 
                                    <td><?php echo $no++; ?></td>
                                    <td><?php echo $data['nik']; ?></td>
                                    <td><?php echo $data['nama']; ?></td>
                                    <td><?php echo date("d F Y H:i", strtotime($data['tgl_submit'])); ?></td>
                                    <td>
                                        <?php if ($data['status']=='0') { ?>
                                            <div class="py-1 px-2 rounded-full text-xs bg-theme-1 text-white cursor-pointer font-medium" style="text-align:center;">OPEN</div>
                                        <?php } ?>
                                        <?php if ($data['status']=='1') { ?>
                                            <div class="py-1 px-2 rounded-full text-xs bg-theme-11 text-white cursor-pointer font-medium" style="text-align:center;">LOCK</div>
                                        <?php } ?>
                                        <?php if ($data['status']=='2') { ?>
                                            <div class="py-1 px-2 rounded-full text-xs bg-theme-9 text-white cursor-pointer font-medium" style="text-align:center;">APPROVED</div>
                                        <?php } ?>
                                        <?php if ($data['status']=='3') { ?>
                                            <div class="py-1 px-2 rounded-full text-xs bg-theme-1 text-white cursor-pointer font-medium" style="text-align:center;">FINAL SCORE</div>
                                        <?php } ?>
                                        
                                    </td>
                                    <td class="border-b w-4">
                                        <div class="flex sm:justify-center items-center">
                                            <a href="index?p=matrixreview&nik=<?php echo $data['nik']; ?>" class="button w-50 bg-theme-1 text-white">REVIEW</a>
                                        </div>
                                    </td>   
                                </tr>
                            <?php } ?>


                            </tbody>
                        </table>
                    <?php } ?>

                    <?php if (isset($_GET['nik'])) { ?>
                    <?php if ($cekstat['status']>=2) { ?>
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
                    <?php } ?>
                </div>

                <?php if (isset($_GET['nik'])) { ?>
                <div class="col-span-12 md:col-span-6 2xl:col-span-12 mt-3 2xl:mt-6">
                        <div class="intro-x flex items-center h-10">
                            <h2 class="text-lg font-medium truncate mr-5">Panel Diskusi</h2>
                        </div>
                        <div class="mt-5 relative before:block before:absolute before:w-px before:h-[85%] before:bg-slate-200 before:dark:bg-darkmode-400 before:ml-5 before:mt-5">
                            <?php 
                            $query = mysqli_query($conn,"SELECT * from kpi_diskusi where (nik_from='$_SESSION[nik]' AND nik_to='$_GET[nik]') OR (nik_from='$_GET[nik]' AND nik_to='$_SESSION[nik]')");
                            while($data=mysqli_fetch_assoc($query)){
                                if($data['tahun']==$periode){
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
                            <?php }} ?>
                        </div>
                    </div>
                    <!-- END: Recent Activities -->

                    <?php if ($cekstat['status']=='1') {?>
                        <a onclick="return confirm('Apakah anda yakin?')" href="action/simpankpimatrixapprove?nik=<?php echo $_GET['nik'] ?>" class="button text-white bg-theme-1 shadow-md cursor-pointer shadow-md fixed bottom-0 right-0 box border rounded-full w-100 h-12 flex items-center justify-center z-50 mb-10 mr-10">Approve KPI &nbsp; <i data-feather="send"></i></a>
                    <?php } ?>

                    <?php if ($cekstat['status']=='2') {?>
                        <a onclick="return confirm('Apakah anda yakin?')" href="action/simpankpimatrixapprove?nik=<?php echo $_GET['nik'] ?>" class="button text-white bg-theme-6 shadow-md cursor-pointer shadow-md fixed bottom-0 right-0 box border rounded-full w-100 h-12 flex items-center justify-center z-50 mb-10 mr-10">Finalisasi KPI &nbsp; <i data-feather="send"></i></a>
                    <?php } ?>

                    <a href="javascript:;" data-toggle="modal" data-target="#diskusi-item-modal" class="button text-white bg-theme-1 shadow-md cursor-pointer shadow-md fixed bottom-0 right-0 box border rounded-full w-100 h-12 flex items-center justify-center z-50 mb-10" style="margin-right: 180px">Tulis Diskusi &nbsp; <i data-feather="edit"></i></a>
            
                    <div class="modal" id="diskusi-item-modal">
            
                    <div class="modal__content">
                        <div class="flex items-center px-5 py-5 sm:py-3 border-b border-gray-200">
                            <h2 class="font-medium text-base mr-auto">
                                Tulis Diskusi
                            </h2>
                        </div>
                        <form method="POST" action="action/simpandiskusi">
                        <div class="p-5 grid grid-cols-12 gap-4 row-gap-3">
                            <input type="hidden" name="nik_to" value="<?php echo $_GET['nik']; ?>">
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
                <?php } ?>

                