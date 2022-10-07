<?php $meta = $this->meta_model->get_meta(); ?>


<section>
    <div class="container py-5">
        <div class="col-md-10 mx-auto">
            <div class="row flex-lg-row-reverse align-items-center g-5 py-5">
                <div class="col-10 col-sm-8 col-lg-5">
                    <img src="<?php echo base_url('assets/img/galery/bg-hero.svg'); ?>" class="d-block mx-lg-auto img-fluid" alt="Bootstrap Themes" width="700" height="500" loading="lazy">
                </div>
                <div class="col-lg-7">
                    <h1 class="display-5 fw-bold lh-1 mb-3">Kembangkan Bisnis Bersama Graha Studio</h1>
                    <p class="lead">Kami Siap membantu anda untuk menyediakan material Promosi secara Digital.</p>
                    <div class="d-grid gap-2 d-md-flex justify-content-md-start">
                        <a href="<?php echo base_url('offer/custom'); ?>" class="btn btn-primary btn-lg px-4 me-md-2">Minta Penawaran</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- <section>
    <div id="myCarousel" class="carousel slide" data-bs-ride="carousel">

        <div class="carousel-inner bg-dark" style="min-height: 400px; background-size: cover; background-image: linear-gradient(rgba(0,143,215,.2), rgba(0,0,0,.2));background-attachment: fixed;
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;">

            <?php $i = 1;
            foreach ($popular_product as $popular_product) : ?>
                <div class="carousel-item <?php if ($i == 1) {
                                                echo 'active';
                                            } ?>">
                    <div class="container">
                        <div class="row gx-5 align-items-center justify-content-center col-10 mx-auto">
                            <div class="col-md-9 col-xl-7 col-xxl-6">
                                <div class="my-5 text-center text-xl-start">
                                    <h1 class="display-5 fw-bolder text-white mb-2">
                                        <?php if ($this->session->userdata('language') == 'EN') : ?>
                                            <?php echo $popular_product->product_name; ?>
                                        <?php elseif ($this->session->userdata('language') == 'ID') : ?>
                                            <?php echo $popular_product->product_name; ?>
                                        <?php else : ?>
                                            <?php echo $popular_product->product_name; ?>
                                        <?php endif; ?>
                                    </h1>
                                    <p class="text-white mb-4">
                                        <?php if ($this->session->userdata('language') == 'EN') : ?>
                                            <?php echo substr($popular_product->product_description, 0, 195); ?>...
                                        <?php elseif ($this->session->userdata('language') == 'ID') : ?>
                                            <?php echo substr($popular_product->product_description, 0, 195); ?>...
                                        <?php else : ?>
                                            <?php echo substr($popular_product->product_description, 0, 195); ?>...
                                        <?php endif; ?>

                                    </p>
                                    <div class="text-white text-sm">
                                        <?php if ($this->session->userdata('language') == 'EN') : ?>
                                            Start From
                                        <?php elseif ($this->session->userdata('language') == 'ID') : ?>
                                            Harga Mulai
                                        <?php else : ?>
                                            Harga Mulai
                                        <?php endif; ?>

                                    </div>
                                    <span class="display-4 fw-bold text-white"> IDR <?php echo number_format($popular_product->product_price, 0, ",", "."); ?></span><span class="text-warning"></span>
                                    <div class="d-grid gap-3 d-sm-flex justify-content-sm-center justify-content-xl-start">
                                        <a class="btn btn-primary btn-lg px-4 me-sm-3 text-white mt-2" href="<?php echo base_url('product/detail/' . $popular_product->product_slug); ?>">
                                            <?php if ($this->session->userdata('language') == 'EN') : ?>
                                                View Schedule
                                            <?php elseif ($this->session->userdata('language') == 'ID') : ?>
                                                Lihat Jadwal
                                            <?php else : ?>
                                                Detail
                                            <?php endif; ?>

                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-xl-5 col-xxl-6 d-none d-xl-block text-center">
                                <div class="img-slide">
                                    <img class="img-fluid rounded-3 my-5" src="<?php echo base_url('assets/img/product/thumbs/' . $popular_product->product_image) ?>" alt="<?php echo $popular_product->product_name; ?>" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php $i++;
            endforeach; ?>
        </div>


        <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</section> -->


<section class="py-5 my-5 bg-white border-top shadow-sm" id="features">
    <div class="container px-5 my-5">
        <div class="col-md-10 mx-auto">
            <div class="row gx-5">
                <div class="col-lg-3 mb-5 mb-lg-0">
                    <h3 class="mb-0 fw-bold">
                        Aplikasi Instan
                    </h3>
                    <p class="lead">
                        Aplikasi siap Pakai sesuai Kebutuhan jenis bisnis Anda. Lihat detail aplikasi
                    </p>
                    <a href="<?php echo base_url('product'); ?>" class="btn btn-primary">Lihat Semua</a>
                </div>
                <div class="col-lg-9">
                    <div class="row g-4 row-cols-1 row-cols-lg-3">
                        <?php foreach ($product as $product) : ?>
                            <div class="col-md-4">
                                <a class="text-muted" href="<?php echo base_url('product/detail/' . $product->product_slug); ?>">
                                    <div class="card card-transition">
                                        <div class="product-img-frame">
                                            <img src="<?php echo base_url('assets/img/product/thumbs/' . $product->product_image); ?>" class="card-img-top" alt="<?php echo $product->product_name; ?>">
                                        </div>
                                        <div class="card-body">
                                            <h4 class="card-title"><?php echo $product->product_name; ?> <i class="fa-solid fa-circle-check text-success"></i> </h4>

                                            <h4>IDR. <?php echo number_format($product->product_price, 0, ",", "."); ?> </h4>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<section class="py-5 bg-light border-top shadow-sm" id="features">
    <div class="container px-5 my-5">
        <div class="col-md-10 mx-auto">
            <div class="row gx-5">
                <div class="col-lg-3 mb-5 mb-lg-0">
                    <h3 class="mb-0 fw-bold">
                        <?php if ($this->session->userdata('language') == 'EN') : ?>
                            <?php echo $homepage->service_title_en; ?>
                        <?php elseif ($this->session->userdata('language') == 'ID') : ?>
                            <?php echo $homepage->service_title_id; ?>
                        <?php else : ?>
                            <?php echo $homepage->service_title_id; ?>
                        <?php endif; ?>
                    </h3>
                    <p class="lead">
                        <?php if ($this->session->userdata('language') == 'EN') : ?>
                            <?php echo $homepage->service_desc_en; ?>
                        <?php elseif ($this->session->userdata('language') == 'ID') : ?>
                            <?php echo $homepage->service_desc_id; ?>
                        <?php else : ?>
                            <?php echo $homepage->service_desc_id; ?>
                        <?php endif; ?>
                    </p>
                </div>
                <div class="col-lg-9">
                    <div class="row g-4 py-5 row-cols-1 row-cols-lg-3">
                        <?php foreach ($service as $service) : ?>
                            <div class="col-md-4">
                                <div class="card text-center shadow my-3 card-transition">
                                    <div class="card-image-overflow rounded bg-light-primary text-center py-4">
                                        <span class="display-6 p-5 text-primary"> <?php echo $service->service_icon; ?></span>
                                    </div>
                                    <div class="card-body">
                                        <h3 class="fw-bold">
                                            <?php if ($this->session->userdata('language') == 'EN') : ?>
                                                <?php echo $service->service_name_en; ?>
                                            <?php elseif ($this->session->userdata('language') == 'ID') : ?>
                                                <?php echo $service->service_name_id; ?>
                                            <?php else : ?>
                                                <?php echo $service->service_name_id; ?>
                                            <?php endif; ?>
                                        </h3>
                                        <p>
                                            <?php if ($this->session->userdata('language') == 'EN') : ?>
                                                <?php echo $service->service_desc_en; ?>
                                            <?php elseif ($this->session->userdata('language') == 'ID') : ?>
                                                <?php echo $service->service_desc_id; ?>
                                            <?php else : ?>
                                                <?php echo $service->service_desc_id; ?>
                                            <?php endif; ?>
                                        </p>
                                    </div>
                                </div>

                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<section class="col-md-9 mx-auto py-5">
    <div class="container px-4 my-5 card-transition">
        <div class="row flex-lg-row-reverse align-items-center">
            <div class="col-10 col-sm-8 col-lg-6">
                <img class="rounded" src="<?php echo base_url('assets/img/galery/3.svg'); ?>" class="d-block mx-lg-auto img-fluid" loading="lazy">
            </div>
            <div class="col-lg-6">
                <h2 class="fw-bold lh-1 mb-3">Custom aplikasi web</h2>
                <p class="lead">Anda dapat merancang aplikasi web sesuai dengan kebutuhan role bisnis anda seperti aplikasi stok barang, aplikasi pembayaran spp sekolah online, aplikasi Point of Sales, aplikasi pendataan dll.
                </p>
                <div class="d-grid gap-2 d-md-flex justify-content-md-start">
                    <a href="<?php echo base_url('offer/custom'); ?>" class="btn btn-primary btn-lg px-4 me-md-2 text-white">Minta Penawaran</a>
                </div>
            </div>
        </div>
    </div>
    <div class="container px-4 card-transition">
        <div class="row align-items-center">
            <div class="col-10 col-sm-8 col-lg-6">
                <img src="<?php echo base_url('assets/img/galery/2.svg'); ?>" class="d-block mx-lg-auto img-fluid" loading="lazy">
            </div>
            <div class="col-lg-6">
                <h2 class="fw-bold lh-1 mb-3">Aplikasi web Instan</h2>
                <p class="lead">Jika perusahaan anda membutuhkan website instan siap pakai kami telah menyediakan dari berbagai jenis bidang usaha seperti booking rental mobil online, booking tiket wisata, web sekolah, web toko online, web company profile dll.</p>
                <div class="d-grid gap-2 d-md-flex justify-content-md-start">
                    <a href="<?php echo base_url('product'); ?>" class="btn btn-primary btn-lg px-4 me-md-2 text-white">Lihat Produk</a>
                </div>
            </div>
        </div>
    </div>
    <div class="container px-4 card-transition">
        <div class="row flex-lg-row-reverse align-items-center">
            <div class="col-10 col-sm-8 col-lg-6">
                <img src="<?php echo base_url('assets/img/galery/4.svg'); ?>" class="d-block mx-lg-auto img-fluid" loading="lazy">
            </div>
            <div class="col-lg-6">
                <h2 class="fw-bold lh-1 mb-3">Jasa Pembuatan Website</h2>
                <p class="lead">Jika Anda tidak paham tentang website dan tidak tahu cara maintanance kami siap membantu anda untuk pembuatan website. dengan maintanance secara berkala dan.
                </p>
                <div class="d-grid gap-2 d-md-flex justify-content-md-start">
                    <a href="<?php echo base_url('offer/website'); ?>" class="btn btn-primary btn-lg px-4 me-md-2">Minta Penawaran</a>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="my-5 mt-5 col-md-9 mx-auto">
    <div class="container">
        <h2 class="fw-bold text-center pt-5">
            Artikel Terbaru
        </h2>
        <p class="text-center">
            Kumpulan Artikel dan review Wisata
        </p>

        <div class="row my-3">
            <?php foreach ($post as $post) : ?>
                <div class="col-md-4 col-12">
                    <div class="card-body border-0 my-5 card-transition">
                        <div class="">
                            <div class="img-frame mb-2">
                                <img src="<?php echo base_url('assets/img/post/thumbs/' . $post->post_image); ?>" alt="">
                            </div>
                            <h3 class="card-title mt-3 ">
                                <a class="text-dark" href="<?php echo base_url('post/detail/' . $post->post_slug); ?>">
                                    <?php echo substr($post->post_title, 0, 35); ?></a>
                            </h3>
                            <p class="card-text">
                                <?php echo substr($post->post_description, 0, 95); ?>
                            </p>
                        </div>
                        <i class="fa fa-long-arrow-right"></i>
                        <a href="<?php echo base_url('post/detail/' . $post->post_slug); ?>" class="text-muted">

                            Selengkapnya

                        </a>
                    </div>
                </div>

            <?php endforeach; ?>

            <!-- Card Info -->
            <div class="col-md-4 mx-auto">
                <div class="text-center">
                    <a class="btn btn-outline-white" href="<?php echo base_url('post'); ?>">
                        Tampilkan Lebih banyak? Klik disini <span class="fa fa-chevron-right small ms-1"></span>
                    </a>

                </div>
            </div>
            <!-- End Card Info -->
        </div>
    </div>
</section>