                <div class="intro-y flex items-center mt-8">
                    <h2 class="text-lg font-medium mr-auto">
                    Form Tambah Warehouse
                    </h2>
                </div>
                <div class="grid grid-cols-12 gap-6 mt-5">
                    <div class="intro-y col-span-12 lg:col-span-12">
                        <!-- BEGIN: Form Layout -->
                        <?php if (isset($_GET['id'])) {
                            $id = $_GET['id'];
                            $data = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * from warehouse where no_warehouse='$id'"));
                            $aksi = 'action/simpan_warehouse_update';
                            $inputid = '<input type="hidden" name="id" value="' . $id . '">';
                            $kode_warehouse = $data['kode_warehouse'];
                            $nama_warehouse = $data['nama_warehouse'];
                            $pt_warehouse = $data['pt_warehouse'];
                            $no_telp = $data['no_telp'];
                        }else{
                            $aksi = 'action/simpan_warehouse';
                            $inputid = '';
                            $kode_warehouse = '';
                            $nama_warehouse = '';
                            $pt_warehouse = '';
                            $no_telp = '';
                        } ?>
                        <form method="POST" action="<?php echo $aksi; ?>">
                            <?php echo $inputid; ?>
                           
                        <div class="intro-y box p-5">

                           
                            <div class="mt-3">
                                <label>Kode Warehouse</label>
                                <input type="text" name="kode_warehouse" class="input w-full border mt-2" placeholder="ABC" required="" value="<?php echo $kode_warehouse; ?>">
                            </div>
                            <div class="mt-3">
                                <label>Nama Warehouse</label>
                                <input type="text" name="nama_warehouse" class="input w-full border mt-2" placeholder="Nama warehouse" required="" value="<?php echo $nama_warehouse; ?>">
                            </div>
                            <div class="mt-3">
                                <label>Perusahaan</label>
                                <input type="text" name="pt_warehouse" class="input w-full border mt-2" placeholder="PT ABC" required="" value="<?php echo $pt_warehouse; ?>">
                            </div>
                            <div class="mt-3">
                                <label>Telepon</label>
                                <input type="text" name="no_telp" class="input w-full border mt-2" placeholder="0281 8282" required="" value="<?php echo $no_telp; ?>">
                            </div>
                            
            
                            <div class="text-right mt-5">
                                <button type="submit" class="button w-24 bg-theme-1 text-white">Save</button>
                                <button onclick="window.location='index?p=warehouse'" class="button w-24 border text-gray-700 mr-1">Cancel</button>
                                
                            </div>
                        </div>
                        <!-- END: Form Layout -->
                        </form>
                    </div>
                </div>