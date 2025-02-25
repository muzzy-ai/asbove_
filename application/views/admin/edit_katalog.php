<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="row">
                <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                    <h3 class="font-weight-bold">Manajemen Katalog</h3>
                    <h6 class="font-weight-normal mb-0">HIMTI Official Merchandise</h6>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Manajemen Katalog</h4>
                    <form action="<?= base_url('admin/Katalog/updateData'); ?>" method="post" enctype="multipart/form-data">
                        <input type="hidden" value="<?= $katalog->id_katalog; ?>" name="id">
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="form-group">
                                    <label for="exampleInputName1">Nama Barang</label>
                                    <input type="text" class="form-control" id="exampleInputName1" name="nama_barang" placeholder="Nama Barang" value="<?= $katalog->nama_paket; ?>" required>
                                </div>
                                <div class="form-group">
                                    <div class="editor-container">
                                        <label for="exampleInputName1">Deskripsi</label>
                                        <textarea class="form-control" id="editor" name="deskripsi" rows="4"><?= $katalog->deskripsi; ?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>Gambar</label>
                                    <input type="file" class="form-control" name="image" <?= empty($katalog->image) ?>required>
                                </div>
                                <div class="form-group">
                                    <img src="<?= base_url('assets/files/katalog/') . $katalog->image; ?>" class="img-thumbnail" style="max-width: 120px;" alt="">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputName1">Harga (Rp)</label>
                                    <input type="text" class="form-control" id="exampleInputName1" name="harga" placeholder="Harga Paket" value="<?= $katalog->harga; ?>" required>
                                </div>
                            </div>
                            <div class="col-lg-12 text-right">
                                <a href="<?= base_url('admin/Katalog'); ?>" class="btn btn-secondary mr-2">Kembali</a>
                                <button type="submit" class="btn btn-warning mr-2">Edit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>