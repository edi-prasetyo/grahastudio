<div class="breadcrumb pt-5">
    <div class="container">
        <div class="col-md-7 mx-auto">
            <ul class="breadcrumb my-auto">
                <li class="breadcrumb-item"><a href="<?php echo base_url('') ?>" class="text-muted"><i class="ti ti-home"></i> Home</a></li>
                <li class="breadcrumb-item text-muted active"><?php echo $title ?></li>
            </ul>
        </div>
    </div>
</div>

<div class="container">
    <div class="col-md-7 mx-auto">
        <div class="card">
            <div class="card-header bg-white">
                Detail Pemesan
            </div>
            <div class="card-body">
                <?php echo form_open('offer/custom',  array('class' => 'needs-validation', 'novalidate' => 'novalidate')); ?>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="basic-url" class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control" name="name" value="" aria-describedby="basic-addon3" required>
                        <div class="invalid-feedback">Harus Di isi</div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="basic-url" class="form-label">Nomor Whatsapp</label>
                        <input type="text" class="form-control" name="whatsapp" value="" aria-describedby="basic-addon3" required>
                        <div class="invalid-feedback">Harus Di isi</div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="basic-url" class="form-label">Email</label>
                        <input type="text" class="form-control" name="email" value="" aria-describedby="basic-addon3" required>
                        <div class="invalid-feedback">Harus Di isi</div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="basic-url" class="form-label">Type</label>
                        <select class="form-select" name="type" aria-label="Default select example" required>
                            <option value="">Pilih Type pengguna</option>
                            <option value="personal">Perorangan</option>
                            <option value="company">Perusahaan</option>
                        </select>
                        <div class="invalid-feedback">Harus Di isi</div>
                    </div>

                    <div class="col-md-12 mb-3">
                        <label for="basic-url" class="form-label">Nama Usaha / Brand</label>
                        <input type="text" class="form-control" name="business_name" value="" aria-describedby="basic-addon3" required>
                        <div class="invalid-feedback">Harus Di isi</div>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="basic-url" class="form-label">Bidang Usaha</label>
                        <input type="text" class="form-control" name="business_fields" value="" aria-describedby="basic-addon3" required>
                        <div class="invalid-feedback">Harus Di isi</div>
                    </div>

                    <div class="col-md-12 mb-3">
                        <label class="form-label">Keterangan Aplikasi yang ingin anda buat<span class="text-danger">*</span>
                        </label>
                        <textarea class="form-control" id="summernote" name="app_description" placeholder="Deskripsi" required><?php echo set_value('product_description'); ?></textarea>
                        <div class="invalid-feedback">Harus Di isi</div>
                    </div>

                    <div class="col-md-12 mb-3">
                        <label class="form-label">Fitur Apa Saja yang di perlukan<span class="text-danger">*</span>
                        </label>
                        <textarea class="form-control" id="summernote2" name="app_featured" placeholder="Fitur" required><?php echo set_value('product_description'); ?></textarea>
                        <div class="invalid-feedback">Harus Di isi</div>
                    </div>

                    <div class="col-md-12 mb-3">
                        <button type="submit" class="btn btn-primary">Kirim Penawaran</button>
                    </div>

                </div>

                <?php echo form_close(); ?>

            </div>
        </div>

    </div>