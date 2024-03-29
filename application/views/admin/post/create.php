<div class="card mb-4">
    <div class="card-header bg-white">
        <h4> <?php echo $title; ?></h4>
    </div>
    <div class="card-body">
        <div class="text-center">
            <?php
            echo $this->session->flashdata('message');
            if (isset($errors_upload)) {
                echo '<div class="alert alert-warning">' . $error_upload . '</div>';
            }
            ?>
        </div>
        <?php
        echo form_open_multipart('admin/post/create',  array('class' => 'needs-validation', 'novalidate' => 'novalidate'));
        ?>

        <div class="form-group row mb-3">
            <label class="col-lg-3 col-form-label">Judul Post <span class="text-danger">*</span>
            </label>
            <div class="col-lg-9">
                <input type="text" class="form-control" name="post_title" placeholder="Judul Berita" value="<?php echo set_value('post_title'); ?>" required>
                <div class="invalid-feedback">Judul Harus Di isi</div>
            </div>
        </div>

        <div class="form-group row mb-3">
            <label class="col-lg-3 col-form-label">Kategori <span class="text-danger">*</span>
            </label>
            <div class="col-lg-9">
                <select name="category_id" class="form-control custom-select" required>
                    <option value="">Pilih Kategori</option>
                    <?php foreach ($category as $category) { ?>
                        <option value="<?php echo $category->id ?>">
                            <?php echo $category->category_name ?>
                        </option>
                    <?php } ?>
                </select>
                <div class="invalid-feedback">Anda harus memilih Kategori</div>
            </div>
        </div>
        <div class="form-group row mb-3">
            <label class="col-lg-3 col-form-label">Status Berita <span class="text-danger">*</span>
            </label>
            <div class="col-lg-9">
                <select name="post_status" class="form-control custom-select" required>
                    <option value="">Pilih Status</option>
                    <option value="publish">Publish</option>
                    <option value="draft">Draft</option>
                </select>
                <div class="invalid-feedback">Silahkan pilih status post</div>
            </div>
        </div>
        <div class="form-group row mb-3">
            <label class="col-lg-3 col-form-label">Upload Gambar <span class="text-danger">*</span>
            </label>
            <div class="col-lg-6">
                <div class="input-group mb-3">
                    <input type="file" name="post_image" required>
                    <div class="invalid-feedback">Silahkan pilih image</div>
                </div>
            </div>
        </div>
        <div class="form-group row mb-3">
            <label class="col-lg-3 col-form-label">Deskripsi Berita (ID) <span class="text-danger">*</span>
            </label>
            <div class="col-lg-9">

                <textarea class="form-control" id="summernote" name="post_description" placeholder="Deskripsi Berita" required></textarea>
                <div class="invalid-feedback">Silahkan Isi Deskripsi Berita</div>
            </div>
        </div>

        <div class="form-group row mb-3">
            <label class="col-lg-3 col-form-label">Keywords
            </label>
            <div class="col-lg-9">
                <input type="text" class="form-control" name="post_keywords" placeholder="Pisahkan dengan koma" value="<?php echo set_value('post_keywords'); ?>">
            </div>
        </div>

        <hr>
        <div class="form-group row mb-3">
            <label class="col-lg-3 col-form-label">Post Title (EN) <span class="text-danger">*</span>
            </label>
            <div class="col-lg-9">
                <input type="text" class="form-control" name="post_title_en" placeholder="News Title" value="<?php echo set_value('post_title_en'); ?>" required>
                <div class="invalid-feedback">Title must be fill</div>
            </div>
        </div>
        <div class="form-group row mb-3">
            <label class="col-lg-3 col-form-label">Post Description (EN) <span class="text-danger">*</span>
            </label>
            <div class="col-lg-9">

                <textarea class="form-control" id="summernote2" name="post_description_en" placeholder="Post Description"><?php echo set_value('post_description_en'); ?></textarea>
                <div class="invalid-feedback">Description must be fill</div>
            </div>
        </div>

        <div class="form-group row mb-3">
            <div class="col-lg-3"></div>
            <div class="col-lg-9">
                <button type="submit" class="btn btn-primary btn-lg btn-block">
                    Publish Berita
                </button>
            </div>
        </div>
        <?php echo form_close() ?>
    </div>
</div>