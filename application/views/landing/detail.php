<!-- Page Header Start -->
<div class="container-fluid page-header py-5 mb-5 wow fadeIn" data-wow-delay="0.1s">
    <div class="container text-center py-5">
        <h1 class="display-2 text-dark mb-4 animated slideInDown">Detail Paket</h1>
        <nav aria-label="breadcrumb animated slideInDown">
            <ol class="breadcrumb justify-content-center mb-0">
                <li class="breadcrumb-item"><a href="<?= base_url(''); ?>">Home</a></li>
                <li class="breadcrumb-item text-dark" aria-current="page">Detail</li>
            </ol>
        </nav>
    </div>
</div>
<!-- Page Header End -->

<div class="container-xxl py-5">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-5 wow fadeIn" data-wow-delay="0.1s">
                <img class="img-fluid" src="<?= base_url('assets/files/katalog/') . $katalog->image; ?>" alt="">
            </div>
            <div class="col-lg-7 wow fadeIn" data-wow-delay="0.5s">
                <div class="section-title">
                    <p class="fs-5 fw-medium fst-italic text-primary">ASBOVE</p>
                    <?= $this->session->flashdata('message'); ?>
                    <h1 class="display-6"><?= $katalog->nama_paket; ?></h1>
                </div>
                <p><?= $katalog->deskripsi; ?></p>
                <h3 class="text-primary">Rp. <?= number_format($katalog->harga, 2, ",", "."); ?></h3>

                <!-- Form Tambah ke Keranjang -->
                <?= form_open('Beranda/tambah_ke_keranjang'); ?>
                    <input type="hidden" name="id_katalog" value="<?= $katalog->id_katalog; ?>">
                    <input type="hidden" name="nama_paket" value="<?= $katalog->nama_paket; ?>">
                    <input type="hidden" name="harga" value="<?= $katalog->harga; ?>">

                    <label for="qty">Jumlah:</label>
                    <input type="number" name="qty" id="qty" value="1" min="1" class="form-control mb-3" style="width: 100px;">

                    <button type="submit" class="btn btn-primary btn-sm">Tambah ke Keranjang</button>
                <?= form_close(); ?>
            </div>
        </div>
    </div>
</div>
