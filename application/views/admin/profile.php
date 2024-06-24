<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="row">
                <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                    <h3 class="font-weight-bold">Setting Halaman About</h3>
                    <h6 class="font-weight-normal mb-0">JeWePe Wedding Organizer</h6>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Setting Halaman About</h4>
                <?= $this->session->flashdata('message'); ?>
                <form action="<?= base_url('admin/Profile/updateData'); ?>" method="post" enctype="multipart/form-data">
                    <input type="hidden" value="<?= $profile->id; ?>" name="id">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="exampleInputName1">Nama Website</label>
                                <input type="text" class="form-control" id="exampleInputName1" name="nama_website" placeholder="Nama Website" value="<?= $profile->nama_website; ?>" required>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="exampleInputName1">Logo Website</label>
                                <input type="file" class="form-control" id="exampleInputName1" name="logo" value="">
                            </div>
                            <div class="form-group">
                                <img src="<?= base_url('assets/files/') . $profile->logo; ?>" class="img-thumbnail" style="max-width: 120px;" alt="">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="exampleInputName1">Email Website</label>
                                <input type="email" class="form-control" id="exampleInputName1" name="email_website" placeholder="Email Website" value="<?= $profile->email_website; ?>" required>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="exampleInputName1">Nomor Telepon</label>
                                <input type="text" class="form-control" id="exampleInputName1" name="no_telp" placeholder="Nomor Telepon Website" value="<?= $profile->no_telp; ?>" required>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="exampleInputName1">Alamat</label>
                                <textarea class="form-control" id="exampleMaps1" name="alamat" rows="4"><?= $profile->alamat; ?></textarea>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="exampleInputName1">Maps</label>
                                <textarea class="form-control" id="exampleMaps1" name="maps" rows="4"><?= $profile->maps; ?></textarea>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="exampleInputName1">Deskripsi Website</label>
                                <textarea class="form-control" id="exampleMaps1" name="deskripsi_website" rows="4"><?= $profile->deskripsi_website; ?></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 text-right">
                        <button type="submit" class="btn btn-warning mr-2">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>