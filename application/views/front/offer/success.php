<?php $meta = $this->meta_model->get_meta(); ?>
<div class="container my-5 pt-5">

    <div class="col-md-5 mx-auto">
        <div class="card">
            <div class="card-body text-center">

                <span class="display-3 text-success"> <i class="fa fa-check-circle"></i></span>
                <h3>Penawaran Berhasil Dikirim</h3>
                <h4 class="fw-bold">ID <?php echo $offer->id_offer; ?></h4>
                <div class="alert alert-info">
                    <p>Jika dalam waktu 1x24 jam belum di respon silahkan hubungi kami melalui chat wahatsapp</p>

                    <a href="https://wa.me/<?php echo $meta->whatsapp; ?>" class="btn btn-success btn-pill"> <?php echo $meta->whatsapp; ?></a>
                </div>
            </div>
        </div>
    </div>
</div>