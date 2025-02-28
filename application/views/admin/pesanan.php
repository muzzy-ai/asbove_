<div class="container mt-4">
    <h2 class="mb-4">Daftar Pesanan</h2>

    <?= $this->session->flashdata('message'); ?>

    <div class="table-responsive">
        <table class="table table-hover table-striped align-middle">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nama Pelanggan</th>
                    <th>Email</th>
                    <th>Alamat</th>
                    <th>Metode Pengiriman</th>
                    <th>Total Harga</th>
                    <th>Status</th>
                    <th>Tanggal</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($getAllPesanan)) : ?>
                    <?php foreach ($getAllPesanan as $pesanan) : ?>
                        <tr>
                            <td><?= $pesanan->id; ?></td>
                            <td><?= $pesanan->nama_pelanggan; ?></td>
                            <td><?= $pesanan->email; ?></td>
                            <td><?= $pesanan->alamat; ?></td>
                            <td><?= $pesanan->metode_pengiriman; ?></td>
                            <td><strong class="text-success">Rp<?= number_format($pesanan->total_pembelian, 0, ',', '.'); ?></strong></td>
                            <td>
                                <span class="badge <?= ($pesanan->status == 'pending') ? 'bg-warning text-dark' : 'bg-success'; ?>">
                                    <?= ucfirst($pesanan->status); ?>
                                </span>
                            </td>
                            <td><?= date('d-m-Y H:i', strtotime($pesanan->created_at)); ?></td>
                            <td class="text-center">
                                <a href="<?= base_url('admin/pesanan_detail?id=' . $pesanan->id); ?>" class="btn btn-primary btn-sm">
                                    <i class="bi bi-eye"></i> Detail
                                </a>
                                <a href="<?= base_url('admin/delete?id=' . $pesanan->id); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Hapus pesanan ini?');">
                                    <i class="bi bi-trash"></i> Hapus
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="9" class="text-center text-muted">Tidak ada pesanan.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
