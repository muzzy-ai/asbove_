<div class="container mt-4">
    <h2 class="mb-4">Detail Pesanan</h2>

    <div class="card shadow-sm">
        <div class="card-body">
            <h5 class="card-title mb-3">Informasi Pesanan</h5>
            <div class="row">
                <div class="col-md-6">
                    <p><strong>ID Pesanan:</strong> <?= $pesanan->id; ?></p>
                    <p><strong>Nama Pelanggan:</strong> <?= $pesanan->nama_pelanggan; ?></p>
                    <p><strong>Email:</strong> <?= $pesanan->email; ?></p>
                    <p><strong>Alamat:</strong> <?= $pesanan->alamat; ?></p>
                </div>
                <div class="col-md-6">
                    <p><strong>Metode Pengiriman:</strong> <?= $pesanan->metode_pengiriman; ?></p>
                    <p><strong>Total Harga:</strong> <span class="text-success">Rp<?= number_format($pesanan->total_pembelian, 0, ',', '.'); ?></span></p>
                    <p><strong>Status:</strong> 
                        <span class="badge <?= ($pesanan->status == 'pending') ? 'bg-warning text-dark' : 'bg-success'; ?>">
                            <?= ucfirst($pesanan->status); ?>
                        </span>
                    </p>
                    <p><strong>Tanggal Pemesanan:</strong> <?= date('d-m-Y H:i', strtotime($pesanan->created_at)); ?></p>
                </div>
            </div>
        </div>
    </div>

    <h5 class="mt-4">Produk dalam Pesanan</h5>
    <div class="table-responsive">
        <table class="table table-striped align-middle">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nama Produk</th>
                    <th>Jumlah</th>
                    <th>Harga Satuan</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($produk_pesanan)) : ?>
                    <?php foreach ($produk_pesanan as $produk) : ?>
                        <tr>
                            <td><?= $produk->id; ?></td>
                            <td><?= $produk->nama_produk; ?></td>
                            <td><?= $produk->jumlah; ?></td>
                            <td>Rp<?= number_format($produk->harga_satuan, 0, ',', '.'); ?></td>
                            <td>Rp<?= number_format($produk->subtotal, 0, ',', '.'); ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="5" class="text-center text-muted">Tidak ada produk dalam pesanan ini.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        <a href="<?= base_url('admin/pesanan'); ?>" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
        <a href="<?= base_url('admin/proses_pesanan?id=' . $pesanan->id); ?>" class="btn btn-success">
            <i class="bi bi-check-circle"></i> Proses Pesanan
        </a>
        <a href="<?= base_url('admin/delete?id=' . $pesanan->id); ?>" class="btn btn-danger" onclick="return confirm('Hapus pesanan ini?');">
            <i class="bi bi-trash"></i> Hapus Pesanan
        </a>
    </div>
</div>
