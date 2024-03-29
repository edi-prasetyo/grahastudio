<div class="container d-grid gap-2 d-sm-flex justify-content-sm-center my-5 py-5 text-muted">
    <div class="col-md-4">
        <div class="card shadow m-3">
            <div class="card-body p-5">
                <div class="text-muted">
                    <h1 class="h4 mb-4"><i class="feather-arrow-right"></i> Silahkan Login!</h1>
                    <?php
                    echo $this->session->flashdata('message');
                    unset($_SESSION['message']); ?>
                </div>
                <?php
                echo form_open('auth',  array('class' => 'needs-validation', 'novalidate' => 'novalidate'))
                ?>
                <div class="form-group mb-4">
                    <label class="form-label">Email</label>
                    <input type="text" class="form-control form-control-user" name="email" placeholder="Email..." value="<?php echo set_value('email'); ?>" style="text-transform: lowercase" required>
                    <div class="invalid-feedback">Silahkan masukan Email</div>
                </div>
                <div class="form-group mb-4">
                    <label class="form-label">Password</label>
                    <input type="password" class="form-control form-control-user" name="password" placeholder="Password" required>
                    <div class="invalid-feedback">Silahkan masukan Password</div>
                </div>
                <div class="d-flex justify-content-between align-items-start">
                    <button type="submit" class="btn btn-primary">
                        <i class="feather-arrow-right"></i> Login
                    </button>
                    <a class="text-muted my-auto" href="<?php echo base_url('auth/forgotpassword'); ?>">Lupa Password?</a>
                </div>
                <?php echo form_close() ?>
            </div>
            <div class="card-footer bg-white">
                <div class="text-center">
                    Belum Punya Akun? <a class="text-muted" href="<?php echo base_url('auth/register') ?>"> Silahkan Daftar!</a>
                </div>
            </div>
        </div>
    </div>
</div>