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
        echo form_open_multipart('admin/product/create',  array('class' => 'needs-validation', 'novalidate' => 'novalidate'));
        ?>

        <div class="row">
            <div class="col-md-6">
                <label class="col-form-label">Judul <span class="text-danger">*</span>
                </label>

                <input type="text" class="form-control" name="product_name" placeholder="Judul" value="<?php echo set_value('product_name'); ?>" required>
                <div class="invalid-feedback">Judul Harus Di isi</div>
            </div>
            <div class="col-md-6">
                <label class="col-form-label">Harga <span class="text-danger">*</span>
                </label>
                <input type="text" class="form-control" name="product_price" placeholder="Harga" value="<?php echo set_value('product_price'); ?>">
            </div>
            <div class="col-md-6">
                <label class="col-form-label">Category <span class="text-danger">*</span>
                </label>
                <select name="category_id" class="form-select" required>
                    <option value="">Pilih Category</option>
                    <?php foreach ($category as $category) : ?>
                        <option value="<?php echo $category->id; ?>"><?php echo $category->category_name; ?> </option>
                    <?php endforeach; ?>

                </select>
                <div class="invalid-feedback">Silahkan pilih status product</div>
            </div>
            <div class="col-md-6">
                <label class="col-form-label">Status <span class="text-danger">*</span>
                </label>
                <select name="product_status" class="form-select" required>
                    <option value="">Pilih Status</option>
                    <option value="1">active</option>
                    <option value="0">inactive</option>
                </select>
                <div class="invalid-feedback">Silahkan pilih status product</div>
            </div>

            <div class="col-md-6">
                <label class="col-form-label">Url Demo <span class="text-danger">*</span>
                </label>
                <input type="text" class="form-control" name="product_link" placeholder="Url Demo" value="<?php echo set_value('product_link'); ?>">
            </div>

            <div class="col-md-6">
                <label class="col-form-label">Upload Gambar <span class="text-danger">*</span></label>
                <div class="input-group mb-3">
                    <input type="file" name="product_image" required>
                    <div class="invalid-feedback">Silahkan pilih image</div>
                </div>
            </div>

            <div class="col-md-6">
                <label class="col-form-label">Framework <span class="text-danger">*</span>
                </label>
                <input type="text" class="form-control" name="product_framework" placeholder="Framework" value="<?php echo set_value('product_framework'); ?>">
            </div>


        </div>



        <label class="col-lg-3 col-form-label">Deskripsi <span class="text-danger">*</span>
        </label>
        <textarea class="form-control" id="summernote" name="product_description" placeholder="Deskripsi" required><?php echo set_value('product_description'); ?></textarea>
        <div class="invalid-feedback">Silahkan Isi Deskripsi Berita</div>

        <label class="col-lg-3 col-form-label">Fasilitas <span class="text-danger">*</span></label>
        <textarea id="summernote3" class="form-control" name="product_featured" placeholder="Fitur" value="<?php echo set_value('product_featured'); ?>"></textarea>

        <h4 class="mt-5 fw-bold">Seo Setting</h4>

        <label class="col-form-label">Meta Title</label>
        <input type="text" class="form-control" name="meta_title" placeholder="Judul Seo" value="<?php echo set_value('meta_title'); ?>">

        <label class="col-lg-3 col-form-label">Meta Description <span class="text-danger">*</span></label>
        <textarea class="form-control" name="meta_description" placeholder="Meta Deskripsi" value="<?php echo set_value('meta_description'); ?>"></textarea>

        <label class="col-form-label">Keywords</label>
        <input type="text" class="form-control" name="meta_keywords" placeholder="Pisahkan dengan koma" value="<?php echo set_value('meta_keywords'); ?>">

        <div class="mt-5">
            <button type="submit" class="btn btn-primary btn-lg btn-block">
                Publish
            </button>
        </div>

        <?php echo form_close() ?>
    </div>
</div>