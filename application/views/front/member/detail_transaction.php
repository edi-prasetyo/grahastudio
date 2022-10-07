<?php $meta = $this->meta_model->get_meta(); ?>
<div class="container my-5 pt-5">

    <div class="col-md-5 mx-auto">
        <div class="card">
            <div class="card-body text-center">
                <?php if ($transaction->payment_status == 'pending') : ?>
                    <span class="display-3 text-warning"> <i class="fa-solid fa-circle-exclamation"></i></span>
                    <h3>Menunggu Pembayaran </h3>
                <?php elseif ($transaction->payment_status == 'success') : ?>
                    <span class="display-3 text-success"> <i class="fa fa-check-circle"></i></span>
                    <h3>Order Berhasil </h3>
                <?php endif; ?>
                INVOICE <b><?php echo $transaction->invoice_number; ?></b><br>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item d-flex justify-content-between align-items-start">
                        Produk <span><?php echo $transaction->product_name; ?> </span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-start">
                        Harga <span><?php echo number_format($transaction->total_price, 0, ",", "."); ?> </span>
                    </li>
                </ul>
                <div class="alert alert-success">
                    Silahkan Lakukan Pembayaran Ke Nomor Rekening di bawah ini untuk proses Order
                </div>

                <h4><img class="img-fluid" width="30%" src="<?php echo base_url('assets/img/bank/' . $transaction->bank_logo); ?>">
                </h4>
                <h2><?php echo $transaction->bank_number; ?></h2>
                <h5>A/n <?php echo $transaction->bank_account; ?></h5>
                <p>Informasi Lebih lanjut Hubungi</p>
                <a href="https://wa.me/<?php $meta->whatsapp; ?>" class="btn btn-success text-white"><i class="fab fa-whatsapp"></i> Chat Whatsapp</a>

            </div>
        </div>
    </div>
</div>