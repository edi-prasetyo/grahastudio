<style>
    .inputGroup {
        background-color: #fff;
        display: block;
        margin: 10px 0;
        position: relative;

    }

    .inputGroup label {
        padding: 12px 30px;
        width: 100%;
        display: block;
        text-align: left;
        color: #3C454C;
        cursor: pointer;
        position: relative;
        z-index: 2;
        transition: color 200ms ease-in;
        overflow: hidden;
        border: 1px solid #ddd;
        border-radius: 3px;

    }

    .inputGroup label:before {
        width: 10px;
        height: 10px;
        border-radius: 50%;
        content: "";
        background-color: #ececec;
        position: absolute;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%) scale3d(1, 1, 1);
        transition: all 300ms cubic-bezier(0.4, 0, 0.2, 1);
        opacity: 0;
        z-index: -1;
        box-shadow: 0 20px 50px rgba(0, 0, 0, .1);

    }

    .inputGroup label:after {
        width: 32px;
        height: 32px;
        content: "";
        border: 2px solid #D1D7DC;
        background-color: #fff;
        background-image: url("data:image/svg+xml,%3Csvg width='32' height='32' viewBox='0 0 32 32' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M5.414 11L4 12.414l5.414 5.414L20.828 6.414 19.414 5l-10 10z' fill='%23fff' fill-rule='nonzero'/%3E%3C/svg%3E ");
        background-repeat: no-repeat;
        background-position: 2px 3px;
        border-radius: 50%;
        z-index: 2;
        position: absolute;
        right: 30px;
        top: 50%;
        transform: translateY(-50%);
        cursor: pointer;
        transition: all 200ms ease-in;
        border: 1px solid #005d46;

    }

    .inputGroup input:checked~label {
        color: #fff;
    }

    .inputGroup input:checked~label:before {
        transform: translate(-50%, -50%) scale3d(56, 56, 1);
        opacity: 1;

    }

    .inputGroup input:checked~label:after {
        background-color: #008463;
        border-color: #005d46;

    }

    .inputGroup input {
        width: 32px;
        height: 32px;
        order: 1;
        z-index: 2;
        position: absolute;
        right: 30px;
        top: 50%;
        transform: translateY(-50%);
        cursor: pointer;
        visibility: hidden;
    }
</style>


<div class="breadcrumb pt-5">
    <div class="container">
        <div class="col-md-8 mx-auto">
            <ul class="breadcrumb my-auto">
                <li class="breadcrumb-item"><a href="<?php echo base_url('') ?>" class="text-muted"><i class="ti ti-home"></i> Home</a></li>
                <li class="breadcrumb-item text-muted active"><?php echo $title ?></li>
            </ul>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">

        <div class="col-md-9 mx-auto">
            <div class="row">

                <div class="col-md-5">
                    <div class="card shadow border-0">
                        <div class="card-header bg-white">
                            Order Detail
                        </div>

                        <div class="card-body">
                            <h5 class="card-title">
                                <?php if ($this->session->userdata('language') == 'EN') : ?>
                                    <?php echo $product->product_name_en; ?>
                                <?php elseif ($this->session->userdata('language') == 'ID') : ?>
                                    <?php echo $product->product_name; ?>
                                <?php else : ?>
                                    <?php echo $product->product_name; ?>
                                <?php endif; ?>
                            </h5>

                            <h2>IDR. <?php echo number_format($product->product_price, 0, ",", "."); ?> </h2>
                            <p class="card-text">
                                <?php echo $product->product_description; ?>
                            </p>

                        </div>
                    </div>
                </div>

                <div class="col-md-7">
                    <div class="card">
                        <div class="card-header bg-white">
                            Detail Pemesan
                        </div>
                        <div class="card-body">
                            <?php echo form_open('order/create'); ?>
                            <input type="hidden" name="user_id" value="<?php echo $user->id; ?>">
                            <input type="hidden" name="product_id" value="<?php echo $product->id; ?>">
                            <input type="hidden" name="product_name" value="<?php echo $product->product_name; ?>">
                            <input type="hidden" name="price" value="<?php echo $product->product_price; ?>">


                            <label for="basic-url" class="form-label">Nama Lengkap</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon3"><i class="feather-user"></i></span>
                                <input type="text" class="form-control" name="fullname" value="<?php echo $user->user_name; ?>" aria-describedby="basic-addon3" required>
                            </div>

                            <label for="basic-url" class="form-label">Nomor Whatsapp</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon3"><i class="feather-phone"></i></span>
                                <input type="text" class="form-control" name="phone" value="<?php echo $user->user_phone; ?>" aria-describedby="basic-addon3" required>
                            </div>


                            <label for="basic-url" class="form-label">Email</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon3"><i class="feather-mail"></i></span>
                                <input type="text" class="form-control" name="email" value="<?php echo $user->email; ?>" aria-describedby="basic-addon3" required>
                            </div>


                            <div class="row">
                                <?php foreach ($bank as $bank) : ?>
                                    <div class="col-6">
                                        <div class="inputGroup">
                                            <input id="radio<?php echo $bank->id; ?>" name="bank_id" value="<?php echo $bank->id; ?>" type="radio">
                                            <label for="radio<?php echo $bank->id; ?>">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <img class="img-fluid" src="<?php echo base_url('assets/img/bank/' . $bank->bank_logo); ?>">
                                                    </div>
                                                    <div class="col-4">
                                                        <?php //echo $bank->bank_name; 
                                                        ?>
                                                    </div>
                                                </div>
                                            </label>
                                            <?php echo form_error('bank_id', '<small class="text-danger pl-3">', '</small>'); ?>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>




                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary">Proses Checkout</button>
                            </div>

                            <?php echo form_close(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>