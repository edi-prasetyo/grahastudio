<div class="card">
    <div class="card-header bg-white d-flex flex-row align-items-center justify-content-between">
        <?php echo $title; ?>
        <a href="<?php echo base_url('admin/product/create'); ?>" class="btn btn-outline-white">Buat Data</a>
    </div>

    <?php
    if ($this->session->flashdata('message')) {
        echo $this->session->flashdata('message');
        unset($_SESSION['message']);
    }
    ?>


    <div class="table-responsive">
        <table class="table table-flush">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Harga</th>
                    <th>Views</th>
                    <th width="35%">Action</th>
                </tr>
            </thead>
            <?php $no = 1;
            foreach ($product as $data) { ?>
                <tr>
                    <td><?php echo $no; ?></td>
                    <td><?php echo $data->product_name; ?></td>
                    <td><?php echo $data->product_price; ?></td>
                    <td><?php echo $data->product_views; ?></td>
                    <td>
                        <a href="<?php echo base_url('admin/product/upload_files/' . $data->id); ?>" class="btn btn-info btn-sm text-white"> Add Files</a>
                        <a href="<?php echo base_url('admin/product/upload_image/' . $data->id); ?>" class="btn btn-warning btn-sm text-muted"> Add Image</a>
                        <a href="<?php echo base_url('product/detail/' . $data->product_slug); ?>" class="btn btn-primary btn-sm text-white"><i class="ti-eye"></i> Lihat</a>
                        <a href="<?php echo base_url('admin/product/update/' . $data->id); ?>" class="btn btn-success btn-sm text-white"><i class="ti-pencil-alt"></i> Edit</a>
                        <?php include "delete.php"; ?>
                    </td>
                </tr>

            <?php $no++;
            }; ?>
        </table>

        <div class="pagination col-md-12 text-center">
            <?php if (isset($pagination)) {
                echo $pagination;
            } ?>
        </div>

    </div>

</div>