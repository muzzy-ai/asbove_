<div class="container mt-5" style="max-width: 900px; background: white; padding: 20px; border-radius: 10px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">
    <h2 style="font-weight: bold; color: #333; text-align: center;">Detail Keranjang</h2>
    <table class="table" style="width: 100%; border-collapse: collapse; margin-top: 20px;">
        <thead>
            <tr style="background-color: #f8f9fa; text-align: left;">
                <th style="padding: 10px; border-bottom: 2px solid #ddd;">Nama Produk</th>
                <th style="padding: 10px; border-bottom: 2px solid #ddd;">Harga</th>
                <th style="padding: 10px; border-bottom: 2px solid #ddd;">Jumlah</th>
                <th style="padding: 10px; border-bottom: 2px solid #ddd;">Subtotal</th>
                <th style="padding: 10px; border-bottom: 2px solid #ddd;"></th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $total = 0;
            if (!empty($cart_items)) { 
                foreach ($cart_items as $item) { 
                    $total += $item['subtotal'];
            ?>
                    <tr style="border-bottom: 1px solid #ddd;">
                        <td style="padding: 10px;"><?= $item['name']; ?></td>
                        <td style="padding: 10px;">Rp<?= number_format($item['price'], 0, ',', '.'); ?></td>
                        <td style="padding: 10px; text-align: center;"><?= $item['qty']; ?></td>
                        <td style="padding: 10px;">Rp<?= number_format($item['subtotal'], 0, ',', '.'); ?></td>
                        <td style="padding: 10px;">
                            <a href="<?= base_url('Cart/hapus_item/' . $item['rowid']) ?>" style="text-decoration: none; background-color: #dc3545; color: white; padding: 6px 12px; border-radius: 5px; display: inline-block;">Hapus</a>
                        </td>
                    </tr>
            <?php 
                } 
            } else { 
            ?>
                <tr>
                    <td colspan="5" style="padding: 15px; text-align: center; font-size: 18px; color: #666;">Keranjang masih kosong</td>
                </tr>
            <?php } ?>
        </tbody>
        <?php if (!empty($cart_items)) { ?>
        <tfoot>
            <tr style="background-color: #f8f9fa; font-weight: bold;">
                <td colspan="3" style="padding: 10px; text-align: right;">Total Pesanan:</td>
                <td style="padding: 10px;">Rp<?= number_format($total, 0, ',', '.'); ?></td>
                <td></td>
            </tr>
        </tfoot>
        <?php } ?>
    </table>

    <div style="display: flex; justify-content: space-between; margin-top: 20px;">
        <a href="<?= base_url('Cart/kosongkan_keranjang') ?>" style="text-decoration: none; background-color: #f0ad4e; color: white; padding: 10px 20px; border-radius: 5px; font-weight: bold;">Kosongkan Keranjang</a>
        <a href="<?= base_url('Checkout?total=' . $total) ?>" style="text-decoration: none; background-color: #8cbf50; color: white; padding: 10px 20px; border-radius: 5px; font-weight: bold;">Checkout</a>
        </div>
</div>
