                <div class="intro-y flex items-center mt-8">
                    <h2 class="text-lg font-medium mr-auto">
                    Form Tambah Carrier
                    </h2>
                </div>
                <div class="grid grid-cols-12 gap-6 mt-5">
                    <div class="intro-y col-span-12 lg:col-span-12">
                        <!-- BEGIN: Form Layout -->
                        <?php if (isset($_GET['id'])) {
                            $id = $_GET['id'];
                            $data = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * from carrier where no_carrier='$id'"));
                            $aksi = 'action/simpan_carrier_update';
                            $inputid = '<input type="hidden" name="id" value="' . $id . '">';
                            $carrier = $data['carrier'];
                        }else{
                            $aksi = 'action/simpan_carrier';
                            $inputid = '';
                            $carrier = '';
                        } ?>
                        <form method="POST" action="<?php echo $aksi; ?>">
                            <?php echo $inputid; ?>
                           
                        <div class="intro-y box p-5">

                           
                            <div class="mt-3">
                                <label>Carrier</label>
                                <input type="text" name="carrier" class="input w-full border mt-2" placeholder="Carrier" required="" value="<?php echo $carrier; ?>">
                            </div>
                            
            
                            <div class="text-right mt-5">
                                <button type="submit" class="button w-24 bg-theme-1 text-white">Save</button>
                                <button onclick="window.location='index?p=carrier'" class="button w-24 border text-gray-700 mr-1">Cancel</button>
                                
                            </div>
                        </div>
                        <!-- END: Form Layout -->
                        </form>
                    </div>
                </div>