<?php
$meta = $this->meta_model->get_meta();
$id             = $this->session->userdata('id');
$user           = $this->user_model->user_detail($id);
$menu           = $this->menu_model->get_menu();
$menu_footer           = $this->menu_model->get_menu();
$setting        = $this->setting_model->detail();
$page           = $this->page_model->get_page();
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?php echo $meta->title ?> | <?php echo $meta->tagline ?></title>
    <link rel="shortcut icon" href="<?php echo base_url('assets/img/logo/' . $meta->favicon); ?>">
    <meta name="description" content="<?php echo $deskripsi ?>">
    <meta name="keywords" content="<?php echo $product->meta_keywords; ?>">
    <meta name="author" content="<?php echo $product->user_name; ?>">
    <meta name="google-site-verification" content="<?php echo $meta->google_meta ?>" />
    <meta name="msvalidate.01" content="<?php echo $meta->bing_meta ?>" />

    <link rel="canonical" href="<?php echo base_url(); ?>" />
    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="<?php echo $product->product_name; ?>" />
    <meta property="og:description" content="<?php echo $product->product_name; ?>" />
    <meta property="og:url" content="<?php echo base_url(); ?>" />
    <meta property="og:image" content="<?php echo base_url('assets/img/product/' . $product->product_image); ?>" />
    <meta property="og:site_name" content="<?php echo $meta->title; ?>" />
    <meta name="twitter:description" content="<?php echo $deskripsi; ?>" />
    <meta name="twitter:title" content="<?php echo $meta->title; ?>" />

    <!-- Vendor CSS Files -->
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/template/web/vendor/offcanvas/offcanvas.css">
    <link href="<?php echo base_url('assets/template/web/vendor/icons/feather-icons/feather.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/template/web/vendor/icons/fontawesome/css/all.min.css'); ?>" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url('assets/template/web/vendor/bootstrap-icons/bootstrap-icons.css'); ?>">
    <!-- flag-icon-css -->
    <link rel="stylesheet" href="<?php echo base_url('assets/template/web/vendor/flag-icon-css/css/flag-icon.min.css'); ?>">
    <!-- Custom CSS File -->
    <link href="<?php echo base_url('assets/template/web/css/style.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/template/web/css/custom.css'); ?>" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url('assets/template/web/vendor/date-time-picker-bootstrap-4/css/bootstrap-datetimepicker.min.css'); ?>" />
    <!-- Font CSS File -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/template/web/vendor/fonts/poppins/styles.css">
</head>

<body class="d-flex flex-column min-vh-100">
    <nav class="navbar navbar-expand-lg fixed-top navbar-light bg-white shadow-sm" aria-label="Main navigation">
        <div class="container">

            <a class="navbar-brand" href="<?php echo base_url(); ?>"><img style="width:200px;" src="<?php echo base_url('assets/img/logo/' . $meta->logo); ?>"></a>
            <button class="navbar-toggler p-0 border-0" type="button" id="navbarSideCollapse" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="navbar-collapse offcanvas-collapse" id="navbarsExampleDefault">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <?php foreach ($menu as $menu) : ?>
                        <li class="nav-item">
                            <?php if ($this->session->userdata('language') == 'EN') : ?>
                                <a class="nav-link" aria-current="page" href="<?php echo base_url() . $menu->url; ?>"><?php echo $menu->name_en; ?></a>
                            <?php elseif ($this->session->userdata('language') == 'ID') : ?>
                                <a class="nav-link" aria-current="page" href="<?php echo base_url() . $menu->url; ?>"><?php echo $menu->name_id; ?></a>
                            <?php else : ?>
                                <a class="nav-link" aria-current="page" href="<?php echo base_url() . $menu->url; ?>"><?php echo $menu->name_id; ?></a>
                            <?php endif; ?>
                        </li>
                    <?php endforeach; ?>

                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="<?php echo base_url('contact'); ?>">
                            <?php if ($this->session->userdata('language') == 'EN') : ?>
                                contact Us
                            <?php elseif ($this->session->userdata('language') == 'ID') : ?>
                                Hubungi Kami
                            <?php else : ?>
                                Hubungi Kami
                            <?php endif; ?>
                        </a>
                    </li>
                </ul>
                <ul class="nav">
                    <?php if ($setting->language == 1) : ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <?php if ($this->session->userdata('language') == 'EN') : ?>
                                    <i class="flag-icon flag-icon-us mr-2 border"></i> <?php echo $this->session->userdata('language', 'EN'); ?> <i class="feather-chevron-down"></i>
                                <?php elseif ($this->session->userdata('language') == 'ID') : ?>
                                    <i class="flag-icon flag-icon-id mr-2 border"></i> <?php echo $this->session->userdata('language', 'ID'); ?> <i class="feather-chevron-down"></i>
                                <?php else : ?>
                                    <i class="flag-icon flag-icon-id mr-2 border"></i> ID <i class="feather-chevron-down"></i>
                                <?php endif; ?>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="dropdown01">
                                <li><a class="dropdown-item" href="<?php echo base_url('language/translate/ID'); ?>">Indonesia</a></li>
                                <li><a class="dropdown-item" href="<?php echo base_url('language/translate/EN'); ?>">English</a></li>
                            </ul>
                        </li>
                    <?php else : ?>
                    <?php endif; ?>
                    <?php if ($this->session->userdata('id')) : ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                                <i class="fa-regular fa-user"></i> <?php echo $user->user_name; ?> <i class="feather-chevron-down"></i>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="dropdown01">
                                <li><a class="dropdown-item" href="<?php echo base_url('admin/dashboard') ?>"> <i class="ri-user-line"></i> Dashboard</a></li>
                                <li><a class="dropdown-item" href="<?php echo base_url('auth/logout'); ?>">Logout</a></li>
                            </ul>
                        </li>
                    <?php else : ?>
                        <li class="nav-item"><a class="nav-link text-muted" href="<?php echo base_url('auth') ?>"> Masuk</a></li>
                        <span class="border-end mr-3"></span>
                        <li class="nav-item"><a class="nav-link text-muted" href="<?php echo base_url('auth/register') ?>"> Daftar</a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>
    <main class="my-5 mt-5">
        <div class="breadcrumb">
            <div class="container">
                <div class="col-md-10 mx-auto">
                    <ul class="breadcrumb my-3 navigation-tab">
                        <li class="breadcrumb-item"><a href="<?php echo base_url('') ?>"><i class="ti ti-home"></i> Home</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo base_url('product') ?>"> Product</a></li>
                        <li class="breadcrumb-item active"><?php echo $product->product_name; ?></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="container mb-3">
            <div class="col-md-10 mx-auto">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="mb-5 fw-bold"><?php echo $product->product_name; ?></h1>
                    </div>
                    <p class="fst-italic"><?php echo $product->meta_description; ?></p>

                    <div class="post-header pb-3">
                        <div class="d-flex">
                            <div class="img-avatar ">
                                <img width="20%" class="img-fluid me-3" src="<?php echo base_url('assets/img/avatars/' . $product->user_image); ?>">
                            </div>
                            <span class="me-5 my-auto"><?php echo $product->user_name; ?></span>
                            <span class="border-end ms-2"></span>
                            <span class="ms-3 my-auto">Published <?php echo date('j, F Y', strtotime($product->created_at)); ?>
                        </div>
                    </div>

                    <div class="col-md-8">
                        <div class="mb-3">

                            <img class="img-fluid rounded" src="<?php echo base_url('assets/img/product/' . $product->product_image); ?>">
                            <div class="col-md-5 mx-auto mt-5">
                                <div class="d-grid gap-2">
                                    <a href="<?php echo $product->product_link; ?>" class="btn btn-success" type="button">Live Preview</a>
                                </div>
                            </div>
                            <div class="card-body mt-3">
                                <div class="row">
                                    <?php foreach ($images as $data) : ?>

                                        <div class="col-md-3 col-6">
                                            <a href="" data-bs-toggle="modal" data-bs-target="#exampleModal<?php echo $data->id; ?>">
                                                <img class="img-fluid rounded img-thumbnail" src="<?php echo base_url('assets/img/product/thumbs/' . $data->image); ?>">
                                            </a>
                                        </div>

                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModal<?php echo $data->id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <img class="img-fluid" src="<?php echo base_url('assets/img/product/' . $data->image); ?>">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end image modal -->

                                    <?php endforeach; ?>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        Share <i class="fa-solid fa-square-share-nodes"></i>
                                    </div>
                                    <div class="col-md-3 col-6 my-2">
                                        <div class="d-grid gap-2">
                                            <button class="btn btn-primary btn-sm" onclick="_fb();" alt="facebook"><i class="fa-brands fa-facebook"></i> Facebook</button>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-6 my-2">
                                        <div class="d-grid gap-2">
                                            <button class="btn btn-info btn-sm text-white" onclick="_twitter();" alt="twitter"><i class="fa-brands fa-twitter"></i> Twitter</button>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-6 my-2">
                                        <div class="d-grid gap-2">
                                            <button class="btn btn-success btn-sm" onclick="_whatsapp();" alt="whatsapp"><i class="fa-brands fa-whatsapp"></i> Whatsapp</button>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-6 my-2">
                                        <div class="d-grid gap-2">
                                            <button class="btn btn-danger btn-sm" onclick="_pinterest();" alt="pinterest"><i class="fa-brands fa-pinterest"></i> Pinterest</button>
                                        </div>
                                    </div>
                                </div>

                                <?php echo $product->product_description; ?>
                                <?php echo $product->product_featured; ?>
                            </div>

                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <h3>IDR <?php echo number_format($product->product_price, 0, ",", "."); ?></h3>
                                <h4>Ketentuan</h4>
                                <ul>
                                    <li>Free Instalasi</li>
                                    <li>Harga Belum termasuk Hosting/Server dan Domain</li>
                                    <li>Penambahan Fitur akan di kenakan biaya</li>
                                    <li>Garansi 2 Bulan</li>
                                </ul>
                                <h4>Framework</h4>
                                <p><?php echo $product->product_framework; ?></p>
                                <div class="d-grid gap-2">
                                    <a href="<?php echo base_url('order/item/' . md5($product->id)); ?>" class="btn btn-primary" type="button">Order</a>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <footer class="bg-white mt-auto">
        <div class="bg-primary py-md-3">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 text-light display-6 fw-bold">
                        <?php if ($this->session->userdata('language') == 'EN') : ?>
                            Need help ? Contact us
                        <?php elseif ($this->session->userdata('language') == 'ID') : ?>
                            Butuh Bantuan ? Hubungi Kami
                        <?php else : ?>
                            Butuh Bantuan ? Hubungi Kami
                        <?php endif; ?>

                    </div>
                    <div class="col-md-4 text-light"><span style="font-size:30px;font-weight:700;"><i class="fab fa-whatsapp"></i> <?php echo $meta->whatsapp; ?></span></div>
                </div>
            </div>
        </div>
        <div class="container pt-4 pt-md-5 pb-md-5 border-top ">
            <div class="row">
                <div class="col-12 col-md-3 contact">
                    <h4 class="fw-bold">Contact</h4>
                    <i class="fa fa-phone"></i> <?php echo $meta->telepon ?><br>
                    <i class="far fa-envelope"></i> <?php echo $meta->email ?>
                </div>
                <div class="col-8 col-md footer">
                    <h4 class="fw-bold">Menu</h4>
                    <ul class="list-unstyled">
                        <?php foreach ($menu_footer as $menu_footer) : ?>
                            <li> <a class="text-muted nav-item" href="<?php echo base_url() . $menu_footer->url; ?>">
                                    <?php if ($this->session->userdata('language') == 'EN') : ?>
                                        <?php echo $menu_footer->name_en; ?>
                                    <?php elseif ($this->session->userdata('language') == 'ID') : ?>
                                        <?php echo $menu_footer->name_id; ?>
                                    <?php else : ?>
                                        <?php echo $menu_footer->name_id; ?>
                                    <?php endif; ?>
                                </a>
                            </li>
                        <?php endforeach; ?>
                        <li> <a class="text-muted nav-item" href="#">
                                FAQ
                            </a>
                        </li>
                        <li> <a class="text-muted nav-item" href="#">
                                Ketentuan
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="col-12 col-md-5">
                    <h4 class="fw-bold">Tentang Kami</h4>
                    <?php echo $meta->description; ?>
                </div>
            </div>
        </div>
        <div class="credit border-top py-3">
            <div class="container">
                <div class="credit bg-white text-muted py-md-3">Copyright &copy; <?php echo date('Y') ?> - <?php echo $meta->title ?> - <?php echo $meta->tagline ?></div>
            </div>
        </div>
    </footer>
    <!-- Load javascript Jquery -->
    <script src="<?php echo base_url() ?>assets/template/web/vendor/jquery/jquery.min.js"></script>
    <script src="<?php echo base_url() ?>assets/template/web/vendor/bootstrap/js/bootstrap.min.js"></script>
    <!-- <script src="<?php echo base_url() ?>assets/template/web/vendor/popper/popper.min.js"></script> -->
    <script src="<?php echo base_url() ?>assets/template/web/vendor/offcanvas/offcanvas.js" type="text/javascript"></script>
    <script src="<?php echo base_url() ?>assets/template/web/vendor/date-time-picker-bootstrap-4/js/moment.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url() ?>assets/template/web/vendor/date-time-picker-bootstrap-4/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
    <!-- Color Picker JS -->
    <script>
        $(function() {
            var minDate = new Date();
            minDate.setDate(minDate.getDate() + 1);
            $('#id_tanggal').datetimepicker({
                locale: 'id',
                format: 'YYYY-MM-DD',
                minDate: minDate
            });
            $('#startDate').datetimepicker({
                locale: 'id',
                format: 'YYYY-MM-DD',
                minDate: minDate
            });
            $('#endDate').datetimepicker({
                locale: 'id',
                format: 'YYYY-MM-DD',
                minDate: minDate
            });
        });
        $("#id_tanggal").keydown(false);
    </script>
    <!-- Share -->
    <script>
        var title = "";
        var deskripsi = "";
        var currentLocation = window.location;
        var top = (screen.height - 570) / 2;
        var left = (screen.width - 570) / 2;
        var params = "menubar=no,toolbar=no,status=no,width=570,height=570,top=" + top + ",left=" + left;
        console.log(encodeURI(title + deskripsi));

        function _fb() {
            var url = "https://web.facebook.com/sharer.php?u=" + encodeURI(currentLocation);
            window.open(url, 'NewWindow', params);
        }

        function _twitter() {
            var url = "https://twitter.com/intent/tweet?url=" + encodeURI(currentLocation) + "&text=" + encodeURI(deskripsi);
            window.open(url, 'NewWindow', params);
        }

        function _whatsapp() {
            var url = "https://api.whatsapp.com/send?phone=&text=" + encodeURI(title + " " + deskripsi);
            window.open(url, 'NewWindow', params);
        }

        function _pinterest() {
            var url = "http://pinterest.com/pin/create/button/?url=" + encodeURI(currentLocation);
            window.open(url, 'NewWindow', params);
        }
    </script>
    <script>
        // Example starter JavaScript for disabling form submissions if there are invalid fields
        (function() {
            'use strict';
            window.addEventListener('load', function() {
                // Fetch all the forms we want to apply custom Bootstrap validation styles to
                var forms = document.getElementsByClassName('needs-validation');
                // Loop over them and prevent submission
                var validation = Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener('submit', function(event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();
    </script>
</body>

</html>