<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="row">
                <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                    <h3 class="font-weight-bold">Detail Pesanan</h3>
                    <h6 class="font-weight-normal mb-0">HIMTI Official Merchandise</h6>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Informasi Pesanan</h4>

                <table class="table table-bordered">
                    <tr>
                        <th>ID Pesanan</th>
                        <td><?= $order['id']; ?></td>
                    </tr>
                    <tr>
                        <th>Nama Pelanggan</th>
                        <td><?= $order['nama_pelanggan']; ?></td>
                    </tr>
                    <tr>
                        <th>Alamat</th>
                        <td><?= $order['alamat']; ?></td>
                    </tr>
                    <tr>
                        <th>Metode Pengiriman</th>
                        <td><?= $order['metode_pengiriman']; ?></td>
                    </tr>
                    <tr>
                        <th>Total Pembelian</th>
                        <td>Rp<?= number_format($order['total_pembelian'], 0, ',', '.'); ?></td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td class="text-center">
                            <?php if ($order['status'] == 'requested') { ?>
                                <div class="badge badge-primary">Menunggu Konfirmasi</div>
                            <?php } elseif ($order['status'] == 'approved') { ?>
                                <div class="badge badge-success">Pesanan Diterima</div>
                            <?php } else { ?>
                                <div class="badge badge-danger">Dibatalkan</div>
                            <?php } ?>
                        </td>
                    </tr>
                </table>

                <h4 class="mt-4">Produk yang Dibeli</h4>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr class="text-center">
                                <th>Nama Produk</th>
                                <th>Jumlah</th>
                                <th>Harga</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($items as $item) { ?>
                                <tr>
                                    <td><?= $item['product_name']; ?></td>
                                    <td class="text-center"><?= $item['quantity']; ?></td>
                                    <td>Rp<?= number_format($item['price'], 0, ',', '.'); ?></td>
                                    <td>Rp<?= number_format($item['subtotal'], 0, ',', '.'); ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>

                <div class="mt-3">
                    <a href="<?= base_url('pesanan/orders'); ?>" class="btn btn-secondary">Kembali</a>
                </div>
            </div>
        </div>
    </div>
</div>
