<div class="container mt-5">
    <h2 class="text-center">Daftar Pesanan</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Pelanggan</th>
                <th>Alamat</th>
                <th>Metode Pengiriman</th>
                <th>Total Pembelian</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($orders as $order) { ?>
                <tr>
                    <td><?= $order['id']; ?></td>
                    <td><?= $order['nama_pelanggan']; ?></td>
                    <td><?= $order['alamat']; ?></td>
                    <td><?= $order['metode_pengiriman']; ?></td>
                    <td>Rp<?= number_format($order['total_pembelian'], 0, ',', '.'); ?></td>
                    <td><?= ucfirst($order['status']); ?></td>
                    <td>
                        <a href="<?= base_url('Pesanan/order_detail/' . $order['id']); ?>" class="btn btn-info">Detail</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
