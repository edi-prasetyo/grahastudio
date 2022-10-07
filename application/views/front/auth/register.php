<?php
$meta = $this->meta_model->get_meta();
?>

<div class="container">


    <!-- Nested Row within Card Body -->
    <div class="col-md-5 mx-auto my-5 py-5">
        <div class="card shadow">
            <div class="card-body">
                <div class="text-muted">
                    <h1 class="h4 text-gray-900 mb-4"><i class="bi-person-check" style="font-size: 2rem;"></i> Daftar!</h1>
                </div>
                <?php
                echo form_open('auth/register')
                ?>

                <div class="form-group mb-3">
                    <label class="form-label">Nama</label>
                    <input type="text" class="form-control" name="user_name" placeholder="Nama Lengkap" value="<?php echo set_value('user_name'); ?>">
                    <?php echo form_error('user_name', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>

                <div class="form-group mb-3">
                    <label class="form-label">Email</label>
                    <input type="text" class="form-control" name="email" placeholder="Email Address" value="<?php echo set_value('email'); ?>" style="text-transform: lowercase">
                    <?php echo form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
                <div class="form-group row mb-3">
                    <div class="col-sm-6 mb-3 mb-sm-0">
                        <label class="form-label">Password</label>
                        <input type="password" class="form-control" name="password1" placeholder="Password">
                        <?php echo form_error('password1', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="col-sm-6">
                        <label class="form-label">Ulangi Password</label>
                        <input type="password" class="form-control" name="password2" placeholder="Repeat Password">
                        <?php echo form_error('password2', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                </div>
                <div class="d-flex justify-content-between align-items-start">
                    <button type="submit" class="btn btn-primary btn-block">
                        Daftar Sekarang
                    </button>
                    <div class="text-center">
                        <a class="text-muted" href="<?php echo base_url('auth/forgotpassword'); ?>">Lupa Password?</a>
                    </div>
                </div>

                <?php echo form_close() ?>



            </div>
            <div class="card-footer bg-white">
                <div class="text-center">
                    Sudah Punya Akun? <a class="text-muted" href="<?php echo base_url('auth') ?>"> Silahkan Login!</a>
                </div>
            </div>
        </div>
    </div>
</div>