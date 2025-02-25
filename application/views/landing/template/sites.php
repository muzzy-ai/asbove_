<?php $url = $this->uri->segment(1); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title><?= $title ?></title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="<?= base_url('assets/landing/') ?>img/logoHOM.png" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Playfair+Display:wght@700;900&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="<?= base_url('assets/landing/') ?>lib/animate/animate.min.css" rel="stylesheet">
    <link href="<?= base_url('assets/landing/') ?>lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="<?= base_url('assets/landing/') ?>css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="<?= base_url('assets/landing/') ?>css/style.css" rel="stylesheet">
</head>

<body>
    <!-- Spinner Start -->
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" role="status" style="width: 3rem; height: 3rem;"></div>
    </div>
    <!-- Spinner End -->

    <!-- Navbar Start -->
    <div class="container-fluid bg-white sticky-top">
        <div class="container">
            <nav class="navbar navbar-expand-lg bg-white navbar-light py-2 py-lg-0">
                <a href="index.html" class="navbar-brand">
                    <img class="img-fluid" src="<?= base_url('assets/landing/') ?>img/LOGOASBOVE.jpeg" alt="Logo" style="border-radius: 50%; width: 80px; height: auto;">
                </a>
                <button type="button" class="navbar-toggler ms-auto me-0" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <div class="navbar-nav ms-auto"> <!-- Navbar menu ke kanan -->
                        <a href="<?= base_url('') ?>" class="nav-item nav-link <?= ($url == '' || $url == 'Beranda') ? 'active' : ''; ?>" style="font-size: 1.2rem;">Home</a>
                        <a href="<?= base_url('About') ?>" class="nav-item nav-link <?= $url == 'About' ? 'active' : ''; ?>" style="font-size: 1.2rem;">About</a>
                        <?php if ($this->session->userdata('username')): ?>
                            <a href="#" class="nav-item nav-link" style="font-size: 1.2rem;">Hello, <?= $this->session->userdata('username'); ?></a>
                            <a href="<?= base_url('login/logout') ?>" class="nav-item nav-link text-danger" style="font-size: 1.2rem;">Logout</a>
                        <?php else: ?>
                            <a href="<?= base_url('Login') ?>" class="nav-item nav-link" style="font-size: 1.2rem;">Login</a>
                        <?php endif; ?>

                        <!-- Keranjang -->
                        <a href="<?= base_url('Cart/detail_keranjang') ?>" class="nav-item nav-link position-relative" style="font-size: 1.2rem;">
                            <i class="bi bi-cart3" style="position: relative; font-size: 1.5rem;"></i>
                            <span id="cart-count" class="position-absolute badge rounded-pill bg-danger"
                                style="top: 10px; right: -8px; transform: translate(0, 50%); font-size: 0.75rem; padding: 4px 6px;">
                                <?php echo $this->cart->total_items(); ?>
                            </span>
                        </a>


                    </div>
                </div>
            </nav>
        </div>
    </div>
    <!-- Navbar End -->

    <?php $this->load->view($page); ?>

    <!-- Footer Start -->
    <div class="container-fluid bg-dark footer mt-5 py-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-lg-3 col-md-6">
                    <h4 class="text-primary mb-4">Our Office</h4>
                    <p class="mb-2"><i class="fa fa-map-marker-alt text-primary me-3"></i>Bekasi, Indonesia</p>
                    <p class="mb-2"><i class="fa fa-phone-alt text-primary me-3"></i>0123456789</p>
                    <p class="mb-2"><i class="fa fa-envelope text-primary me-3"></i>himtiug@gmail.com</p>
                    <div class="d-flex pt-3">
                        <a class="btn btn-square btn-primary rounded-circle me-2" href=""><i class="fab fa-twitter"></i></a>
                        <a class="btn btn-square btn-primary rounded-circle me-2" href=""><i class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-square btn-primary rounded-circle me-2" href=""><i class="fab fa-youtube"></i></a>
                        <a class="btn btn-square btn-primary rounded-circle me-2" href=""><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->

    <!-- Copyright Start -->
    <div class="container-fluid copyright py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                    &copy; <a class="fw-medium" href="#"> ASBOVE</a>, All Right Reserved.
                </div>
            </div>
        </div>
    </div>
    <!-- Copyright End -->

    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square rounded-circle back-to-top"><i class="bi bi-arrow-up"></i></a>

    <!-- JavaScript Libraries -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url('assets/landing/') ?>lib/wow/wow.min.js"></script>
    <script src="<?= base_url('assets/landing/') ?>lib/easing/easing.min.js"></script>
    <script src="<?= base_url('assets/landing/') ?>lib/waypoints/waypoints.min.js"></script>
    <script src="<?= base_url('assets/landing/') ?>lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="<?= base_url('assets/landing/') ?>js/main.js"></script>

    <!-- Update Cart Count -->
    <script>
        $(document).ready(function() {
            // Ambil jumlah item di keranjang dari server secara real-time
            function updateCartCount() {
                $.get("<?= base_url('Cart/getCartCount') ?>", function(data) {
                    $("#cart-count").text(data);
                });
            }

            updateCartCount();
        });
    </script>
</body>

</html>
