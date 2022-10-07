<div class="breadcrumb">
    <div class="container">
        <ul class="breadcrumb my-3">
            <li class="breadcrumb-item"><a href="<?php echo base_url('member') ?>"><i class="ti ti-home"></i> Home</a></li>
            <li class="breadcrumb-item active"><?php echo $title ?></li>
        </ul>
    </div>
</div>

<div class="container mb-3">
    <h4>Haloo.. <?php echo $user->user_name; ?></h4>
    <div class="row">
        <div class="col-md-7">
            <a href="<?php echo base_url('member/transaction'); ?>">
                <div class="card mb-4 mb-xl-0 border-0 shadow">
                    <div class="card-body d-flex w-100 justify-content-between">
                        <div class="col">
                            <h5 class="card-title text-muted mb-0">Total Transaksi</h5>
                            <span class="h4 font-weight-bold mb-0"><?php echo count($total_transaction); ?></span>
                        </div>
                        <div class="icon icon-shape bg-light-success text-success rounded-circle">
                            <i class="feather-shopping-cart"></i>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>