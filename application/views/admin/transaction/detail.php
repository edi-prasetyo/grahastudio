<div class="row mt-6">
    <div class="offset-xl-2 col-xl-8 offset-lg-1 col-lg-10 col-md-12
              col-12">
        <div class="row">
            <div class="col-12 mb-6">
                <!-- card  -->
                <div class="card">
                    <!-- card header  -->
                    <div class="card-header p-4 bg-white">
                        <h4 class="mb-0">Info Transaksi</h4>
                    </div>
                    <!-- card body  -->
                    <div class="card-body">
                        <?php
                        if ($this->session->flashdata('message')) {
                            echo $this->session->flashdata('message');
                            unset($_SESSION['message']);
                        }
                        ?>
                        <!-- row  -->
                        <div class="row">
                            <div class="col-xl-7 col-lg-6 col-md-12 col-12">
                                <div class="mb-2">
                                    <!-- content  -->
                                    <p class="text-muted mb-0">INV-<?php echo $transaction->invoice_number; ?></p>
                                    <h3 class="mt-2 mb-3 fw-bold"><?php echo $transaction->product_name; ?></h3>
                                    <i class="fa-solid fa-calendar"></i> <?php echo date('j M Y', strtotime($transaction->created_at)); ?>
                                </div>
                            </div>
                            <!-- col  -->
                            <div class="col-xl-5 col-lg-6 col-md-12 col-12">
                                <!-- content  -->
                                <div>
                                    <?php if ($transaction->payment_status == 'success') : ?>
                                        <small class="text-success">
                                            <?php echo $transaction->payment_status; ?>
                                        </small>
                                    <?php else : ?>
                                        <small class="text-danger">
                                            <?php echo $transaction->payment_status; ?>
                                        </small>
                                    <?php endif; ?>
                                    <p><?php echo $transaction->quantity; ?> x @<?php echo $transaction->price; ?></p>
                                    <h2 class="fw-bold text-primary">Rp. <?php echo number_format($transaction->total_price, 0, ",", "."); ?></h2>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 mb-6">
                <!-- card  -->
                <div class="card">
                    <!-- card header  -->
                    <div class="card-header p-4 bg-white">
                        <h4 class="mb-0">Info Customer</h4>
                    </div>
                    <!-- card body  -->
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-lg-6 col-md-12 col-12 mb-4 mb-lg-0">
                                <div class="mb-3 mb-lg-0">
                                    <span class="d-block text-dark fw-medium fs-4">
                                        <?php echo $transaction->fullname; ?>
                                    </span>
                                    <span class="d-block mb-4">
                                        <?php echo $transaction->address; ?>
                                    </span>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12 col-12 d-flex
                          justify-content-lg-end">
                                <!-- text  -->
                                <div class="mb-2">
                                    <p class="mb-1">E-mail: <a href="#"><?php echo $transaction->email; ?></a></p>
                                    <p class="mb-1">Phone: <?php echo $transaction->phone; ?></p>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>