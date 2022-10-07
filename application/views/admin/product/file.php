<div class="row">
    <div class="col-md-5">
        <div class="card mb-4">
            <div class="card-header bg-white py-3">
                <?php echo $title; ?>
            </div>
            <div class="card-body">
                <div class="text-center">
                    <?php
                    echo $this->session->flashdata('message');
                    if (isset($errors_upload)) {
                        echo '<div class="alert alert-warning">' . $errors_upload . '</div>';
                    }
                    ?>
                </div>
                <?php
                echo form_open_multipart('admin/product/upload_files/' . $product->id,  array('class' => 'needs-validation', 'novalidate' => 'novalidate'));
                ?>

                <div class="row">
                    <div class="col-md-4">
                        <img class="img-fluid" src="<?php echo base_url('assets/img/product/thumbs/' . $product->product_image); ?> ">
                    </div>
                    <div class="col-md-8">

                        <label class="col-form-label">Judul <span class="text-danger">*</span>
                        </label>

                        <input type="text" class="form-control" name="file_title" placeholder="Judul" value="<?php echo set_value('file_title'); ?>" required>
                        <div class="invalid-feedback">Judul Harus Di isi</div>



                        <label class="col-form-label">Upload Gambar <span class="text-danger">*</span></label>
                        <div class="input-group mb-3">
                            <input type="file" name="product_file" required>
                            <div class="invalid-feedback">Silahkan pilih image</div>
                        </div>

                        <div class="mt-5">
                            <button type="submit" class="btn btn-primary btn-lg btn-block">
                                Upload
                            </button>
                        </div>

                    </div>
                </div>



                <?php echo form_close() ?>
            </div>
        </div>
    </div>
    <div class="col-md-7">
        <div class="card">
            <div class="card-header bg-white py-3">
                Data Gambar
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>

                            <th scope="col">Title</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <?php foreach ($files as $data) : ?>
                        <tr>

                            <td><?php echo $data->file_title; ?> </td>
                            <td>
                                <a class="btn btn-success" href="<?php echo base_url('assets/files/' . $data->file); ?>"> <i class="fa-solid fa-file-zipper"></i> Download</a>
                                <?php include "delete_file.php"; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>

                </table>
            </div>
        </div>
    </div>
</div>