<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="row">
                <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                    <h3 class="font-weight-bold">Manajemen Laporan</h3>
                    <h6 class="font-weight-normal mb-0">HIMTI Official Merchandise</span></h6>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6">
                        <h4 class="card-title">Data Laporan Pesanan Katalog Barang</h4>
                    </div>
                </div>
                <div class="table-responsive pt-3">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">Gambar</th>
                                <th class="text-center">Nama Barang</th>
                                <th class="text-center">Harga</th>
                                <th class="text-center">Total Harga</th>
                                <th class="text-center">Jumlah Pesanan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($getAllLaporan as $row) :
                            ?>
                                <tr>
                                    <td class="text-center">
                                        <?= $no++; ?>
                                    </td>
                                    <td class="text-center">
                                        <a href="<?= base_url('assets/files/katalog/') . $row->image; ?>" target="_blank">
                                            <img src="<?= base_url('assets/files/katalog/') . $row->image; ?>" class="img-fluid" style="border-radius: 10%;
                                width:60px;height:60px" alt="">
                                        </a>
                                    </td>
                                    <td><?= $row->nama_paket; ?></td>
                                    <td class="text-center">Rp. <?= number_format($row->harga, 2, ",", ".") ?></td>
                                    <td class="text-center">
                                        <?php
                                        $total = $row->harga * $row->jumlah_pesanan;
                                        echo 'Rp.' . number_format($total, 2, ",", ".");
                                        ?>
                                    </td>
                                    <td class="text-center"><?= $row->jumlah_pesanan; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>