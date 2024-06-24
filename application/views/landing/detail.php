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
                    <p class="fs-5 fw-medium fst-italic text-primary">JeWePe Wedding Organizer</p>
                    <?= $this->session->flashdata('message'); ?>
                    <h1 class="display-6"><?= $katalog->nama_paket; ?></h1>
                </div>
                <?= $katalog->deskripsi; ?>
                <h3 class="text-primary">Rp. <?= number_format($katalog->harga, 2, ",", "."); ?></h3>
            </div>
            <div class="col-lg-7 ms-auto wow fadeInUp" data-wow-delay="0.1s">
                <h4 class="mb-4">Tertarik Paket Ini? Yuk Langsung Pesan</h4>
                <form action="<?= base_url('Beranda/pesan'); ?>" method="post">
                    <input type="hidden" name="id" value="<?= $this->input->get('id'); ?>">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="name" name="nama_pemesan" placeholder="Nama Anda" required>
                                <label for="name">Nama Anda</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="email" class="form-control" id="email" name="email_pemesan" placeholder="Email Anda" required>
                                <label for="email">Email Anda</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="date" class="form-control" id="subject" name="tanggal" placeholder="Tanggal Pernikahan" required>
                                <label for="subject">Tanggal Pernikahan</label>
                            </div>
                        </div>
                        <div class="col-12 text-end">
                            <button class="btn btn-primary rounded-pill py-3 px-5" type="submit">Pesan Paket</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>