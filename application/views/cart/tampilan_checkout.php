<div class="container mt-5" style="max-width: 900px; background: white; padding: 20px; border-radius: 10px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">
    <h2 style="font-weight: bold; color: #333; text-align: center;">Checkout</h2>

    <table class="table" style="width: 100%; border-collapse: collapse; margin-top: 20px;">
        <thead>
            <tr style="background-color: #f8f9fa; text-align: left;">
                <th style="padding: 10px; border-bottom: 2px solid #ddd;">Nama Produk</th>
                <th style="padding: 10px; border-bottom: 2px solid #ddd;">Harga</th>
                <th style="padding: 10px; border-bottom: 2px solid #ddd;">Jumlah</th>
                <th style="padding: 10px; border-bottom: 2px solid #ddd;">Subtotal</th>
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
                    </tr>
            <?php 
                } 
            } else { 
            ?>
                <tr>
                    <td colspan="4" style="padding: 15px; text-align: center; font-size: 18px; color: #666;">Keranjang masih kosong</td>
                </tr>
            <?php } ?>
        </tbody>
        <?php if (!empty($cart_items)) { ?>
        <tfoot>
            <tr style="background-color: #f8f9fa; font-weight: bold;">
                <td colspan="3" style="padding: 10px; text-align: right;">Total Pembayaran:</td>
                <td style="padding: 10px;">Rp<?= number_format($total, 0, ',', '.'); ?></td>
            </tr>
        </tfoot>
        <?php } ?>
    </table>

    <?php if (!empty($cart_items)) { ?>
    <form action="<?= base_url('Checkout/process_payment') ?>" method="POST" style="margin-top: 20px;">
        <div class="form-group">
            <label for="name" style="font-weight: bold;">Nama Lengkap</label>
            <input type="text" id="name" name="name" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="email" style="font-weight: bold;">Email</label>
            <input type="email" id="email" name="email" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="address" style="font-weight: bold;">Alamat Lengkap</label>
            <textarea id="address" name="address" class="form-control" rows="3" required></textarea>
        </div>

        <div class="form-group">
            <label for="shipping" style="font-weight: bold;">Metode Pengiriman</label>
            <select id="shipping" name="shipping" class="form-control" required>
                <option value="JNE">JNE</option>
                <option value="J&T">J&T</option>
                <option value="SiCepat">SiCepat</option>
                <option value="POS Indonesia">POS Indonesia</option>
            </select>
        </div>

        <input type="hidden" name="total" value="<?= $total; ?>">

        <div style="display: flex; justify-content: space-between; margin-top: 20px;">
            <a href="<?= base_url('Cart/detail_keranjang') ?>" style="text-decoration: none; background-color: #f0ad4e; color: white; padding: 10px 20px; border-radius: 5px; font-weight: bold;">Kembali ke Keranjang</a>
            <button type="submit" style="background-color: #8cbf50; color: white; padding: 10px 20px; border-radius: 5px; border: none; font-weight: bold;">Bayar Sekarang</button>
        </div>
    </form>
    <?php } ?>
</div>
