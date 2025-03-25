                <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
                    <h2 class="text-lg font-medium mr-auto">
                        Warehouse
                    </h2>
                    <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
                        <a href="index?p=warehouse-tambah" class="button text-white bg-theme-1 shadow-md mr-2">Tambah Warehouse</a>
                    </div>
                </div>
                <!-- BEGIN: Datatable -->
                <div class="intro-y datatable-wrapper box p-5 mt-5">
                    <table class="table table-report table-report--bordered display datatable w-full">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th class="border-b-2 whitespace-no-wrap">Kode</th>
                                <th class="border-b-2 whitespace-no-wrap">Nama </th>
                                <th class="border-b-2 whitespace-no-wrap">Perusahaan</th>
                                <th class="border-b-2 whitespace-no-wrap">Telp</th>
                                <th class="border-b-2 text-center whitespace-no-wrap">Actions</th>
                                
                        </thead>
                        <tbody>
                            <?php 
                            $no=1;
                                $query = "SELECT * from warehouse order by no_warehouse DESC";
                                $data_query= mysqli_query($conn,$query);
                                while ($data = mysqli_fetch_assoc($data_query)) {
                             ?>
                            <tr> 
                                <td><?php echo $no++; ?></td>
                                <td><?php echo $data["kode_warehouse"]; ?></td>
                                <td><?php echo $data["nama_warehouse"]; ?></td>
                                <td><?php echo $data["pt_warehouse"]; ?></td>
                                <td><?php echo $data["no_telp"]; ?></td>
                                <td class="border-b w-4">
                                    <div class="flex sm:justify-center items-center">
                                        <a class="flex items-center text-theme-6" href="action/hapus_warehouse.php?id=<?php echo $data['no_warehouse']; ?>" onclick="return confirm('Anda yakin?')"> <i data-feather="trash-2" class="w-4 h-4 mr-1"></i> Delete </a>
                                    </div>
                                </td>   
                            </tr>
                        <?php } ?>


                        </tbody>
                    </table>
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