                <?php if ($_SESSION['jabatan']!='7' && $_SESSION['divisi']!='11') {
                    echo "<script>
                        location.href='index?p=matrix';
                      </script>";
                } 
                $conn2 = mysqli_connect('103.176.44.250','itjeeves','Welcome@2025#Jeeves','jeevesimtap');
                ?>

             

                <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
                    <h2 class="text-lg font-medium mr-auto">
                        Form KPI Self Developent Review <br>
                        
                    </h2>
                    <?php if (isset($_GET['nik'])) { ?>
                    <h1 class="text-2xl font-bold" style="text-transform:uppercase;"><?php $ceknama = mysqli_fetch_assoc(mysqli_query($conn2,"SELECT nama from karyawan where nik='$_GET[nik]'")) ?>
                        Nama : <?php echo $ceknama['nama']; ?></h1>
                    <?php 
                    $cekstat = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * from kpi_self_header where nik='$_GET[nik]' and YEAR(tahun)='$periode'"));
                    } ?>
                </div>
                <!-- BEGIN: Datatable -->
                <?php if (isset($_GET['nik'])) { ?>
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
                <?php } ?>
                <div class="intro-y datatable-wrapper box p-5 mt-5">
                    <?php if (isset($_GET['nik'])) { ?>
                        <table class="table table-report table-report--bordered display datatable w-full">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th class="border-b-2 whitespace-no-wrap">Key Performace Indicator</th>
                                    <th class="border-b-2 whitespace-no-wrap">Realisasi </th>
                                   
                            </thead>
                            <tbody>
                                <?php 
                                $no=1;
                               
                                    $query = "SELECT * from kpi_self where nik='$_GET[nik]' AND YEAR(tahun)='$periode' order by no_kpi_self DESC";
                                    $data_query= mysqli_query($conn,$query);
                                    while ($data = mysqli_fetch_assoc($data_query)) {
                                        
                                 ?>
                                <tr> 
                                    <td><?php echo $no++; ?></td>
                                    <td><?php echo $data['kpi']; ?></td>
                                    <td><?php echo $data['realisasi']; ?></td>
                                    
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
                                    $query = "SELECT * from kpi_self_header WHERE YEAR(tahun)='$periode' order by nama ASC";
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
                                            <a href="index?p=selfdevreview&nik=<?php echo $data['nik']; ?>" class="button w-50 bg-theme-1 text-white">REVIEW</a>
                                        </div>
                                    </td>   
                                </tr>
                            <?php } ?>


                            </tbody>
                        </table>
                    <?php } ?>

                </div>
                <?php if (isset($_GET['nik'])) { ?>
                    <?php if ($cekstat['status']=='1') {?>
                        <a onclick="return confirm('Apakah anda yakin?')" href="action/simpankpiselfapprove?nik=<?php echo $_GET['nik'] ?>" class="button text-white bg-theme-1 shadow-md cursor-pointer shadow-md fixed bottom-0 right-0 box border rounded-full w-100 h-12 flex items-center justify-center z-50 mb-10 mr-10">Approve KPI &nbsp; <i data-feather="send"></i></a>
                    <?php } ?>

                    <?php if ($cekstat['status']=='2') {?>
                        <a onclick="return confirm('Apakah anda yakin?')" href="action/simpankpiselfapprove?nik=<?php echo $_GET['nik'] ?>" class="button text-white bg-theme-6 shadow-md cursor-pointer shadow-md fixed bottom-0 right-0 box border rounded-full w-100 h-12 flex items-center justify-center z-50 mb-10 mr-10">Finalisasi KPI &nbsp; <i data-feather="send"></i></a>
                    <?php } ?>
                <?php } ?>
