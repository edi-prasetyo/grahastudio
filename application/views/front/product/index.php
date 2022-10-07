<div class="breadcrumb">
    <div class="container">
        <ul class="breadcrumb my-3">
            <li class="breadcrumb-item"><a href="<?php echo base_url('') ?>"><i class="ti ti-home"></i> Home</a></li>
            <li class="breadcrumb-item active"><?php echo $title ?></li>
        </ul>
    </div>
</div>

<div class="container mb-3">

    <div class="row">

        <div class="col-md-9">
            <div class="row">

                <?php foreach ($product as $product) : ?>
                    <div class="col-md-4">
                        <a class="text-muted" href="<?php echo base_url('product/detail/' . $product->product_slug); ?>">
                            <div class="card card-transition">
                                <div class="product-img-frame">
                                    <img src="<?php echo base_url('assets/img/product/thumbs/' . $product->product_image); ?>" class="card-img-top" alt="<?php echo $product->product_name; ?>">
                                </div>
                                <div class="card-body">
                                    <h4 class="card-title"><?php echo $product->product_name; ?> <i class="fa-solid fa-circle-check text-success"></i> </h4>
                                    <p class="card-text"><?php echo substr($product->product_description, 0, 95); ?></p>
                                    <h4>IDR. <?php echo number_format($product->product_price, 0, ",", "."); ?> </h4>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php endforeach; ?>

            </div>
            <div class="pagination col-md-12 text-center">
                <?php if (isset($pagination)) {
                    echo $pagination;
                } ?>
            </div>
        </div>
        <!-- <div class="col-md-3">
            <?php include "sidebar.php"; ?>
        </div> -->
    </div>
</div>