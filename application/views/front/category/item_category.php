<div class="breadcrumb">
    <div class="container">
        <ul class="breadcrumb my-3">
            <li class="breadcrumb-item"><a href="<?php echo base_url('') ?>"><i class="ti ti-home"></i> Home</a></li>
            <li class="breadcrumb-item active"><?php echo $title ?></li>
        </ul>
    </div>
</div>

<section class="boot-elemant-bg" style="background-image: linear-gradient(rgba(0,0,0,.0), rgba(0,0,0,.0)), url('assets/img/galery/bg.jpg');">
    <div class="container">

        <div class="row">
            <?php $i = 1;
            foreach ($post_featured as $post_featured) : ?>
                <div class="<?php if ($i == 1) {
                                echo 'col-md-6';
                            } else {
                                echo 'col-md-3';
                            } ?>">

                    <a href="<?php echo base_url('post/detail/' . $post_featured->post_slug); ?>" class="card mb-2 bg-dark text-white shadow-sm border-0 bg-overlay">
                        <div class="home-img-frame">
                            <img class="card-img" src="<?php echo base_url('assets/img/post/thumbs/' . $post_featured->post_image); ?>" alt="Card image">
                        </div>
                        <div class="card-img-overlay d-flex flex-column align-items-start" style="background-image: linear-gradient(to bottom, rgba(0,0,0,0), rgba(0,0,0,0.8))">
                            <h3 class="card-title mt-auto text-white"><?php echo substr($post_featured->post_title, 0, 135); ?>..</h3>
                            <p class="card-text"><i class="bi-clock"></i> <?php echo date_time_ago($post_featured->created_at); ?></p>
                            <span class="badge bg-light-success text-success mr-2"><?php echo $post_featured->category_name; ?></span>
                        </div>
                    </a>
                </div>

            <?php $i++;
            endforeach; ?>

        </div>

    </div>
    <div class="elemant-bg-overlay black"></div>
</section>

<section>
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <h3 class="my-3 fw-bold"> <span class="text-warning"><i class="fa-solid fa-square-rss me-2"></i></span> Artikel Terbaru</h3>
                <div class="row">
                    <div class="col-md-12">

                        <?php foreach ($post as $post) : ?>
                            <div class="mb-3 bg-transparent border-0">
                                <div class="row no-gutters">
                                    <div class="col-md-4">
                                        <div class="home3-img-frame">
                                            <img src="<?php echo base_url('assets/img/post/thumbs/' . $post->post_image); ?>" alt="..." class="img-fluid">
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="card-body">
                                            <p class="badge bg-success text-white"><?php echo $post->category_name; ?></p>
                                            <h2 class="card-title"><a class="text-muted" href="<?php echo base_url('post/detail/' . $post->post_slug); ?>"> <?php echo substr($post->post_title, 0, 80); ?>..</a></h2>

                                            <span class="text-muted mr-3"><i class="bi-clock"></i> <?php echo date_time_ago($post->created_at); ?></span> <span class="mr-3"><i class="bi-chat"></i> 2 </span> <span class="mr-3"><i class="ri-fire-line"></i> <?php echo $post->post_views; ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        <?php endforeach; ?>
                        <div class="pagination col-md-12 text-center">
                            <?php if (isset($paginasi)) {
                                echo $paginasi;
                            } ?>
                        </div>
                    </div>

                </div>
            </div>

            <div class="col-md-4">
                <?php include "sidebar.php"; ?>
            </div>
        </div>

    </div>
    </div>

</section>





<div class="pagination col-md-12 text-center">
    <?php if (isset($paginasi)) {
        echo $paginasi;
    } ?>
</div>
</div>