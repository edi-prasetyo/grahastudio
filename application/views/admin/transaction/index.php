<div class="card">
    <div class="card-header bg-white d-flex justify-content-between">
        <h4 class="card-title my-auto"><?php echo $title; ?></h4>
    </div>

    <?php
    if ($this->session->flashdata('message')) {
        echo $this->session->flashdata('message');
        unset($_SESSION['message']);
    }
    ?>

    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th width="3%">No</th>
                    <th>tanggal</th>
                    <th>Customer</th>
                    <th>Product</th>
                    <th>Qty</th>
                    <th>Harga</th>
                    <th>Total Harga</th>
                    <th>Status</th>
                    <th width="10%">Action</th>
                </tr>
            </thead>
            <?php $no = 1;
            foreach ($transaction as $data) { ?>
                <tr>
                    <td><?php echo $no; ?></td>
                    <td>
                        <?php echo date("j M Y", strtotime($data->created_at)); ?>
                        <?php if ($data->status_read == 0) : ?>
                            <i class="fa-solid fa-circle-exclamation text-danger"></i>
                        <?php else : ?>
                            <i class="fa-solid fa-circle-check text-success"></i>
                        <?php endif; ?>
                    </td>
                    <td><?php echo $data->fullname; ?></td>
                    <td><?php echo $data->product_name; ?></td>
                    <td><?php echo $data->quantity; ?></td>
                    <td><?php echo number_format($data->price, 0, ",", "."); ?></td>
                    <td><?php echo number_format($data->total_price, 0, ",", "."); ?></td>
                    <td>
                        <?php if ($data->payment_status == 'pending') : ?>
                            <div class="badge bg-light-warning text-warning">Pending</div>
                        <?php elseif ($data->payment_status == 'success') : ?>
                            <div class="badge bg-light-success text-success">Success</div>
                        <?php elseif ($data->payment_status == 'failed') : ?>
                            <div class="badge bg-light-danger text-warning">Failed</div>
                        <?php else : ?>
                            <div class="badge bg-light-danger">Expired</div>
                        <?php endif; ?>
                    </td>
                    <td>
                        <a href="<?php echo base_url('admin/transaction/detail/') . $data->id; ?>" class="btn btn-primary btn-sm text-white"><i class="feather-eye"></i></a>

                    </td>
                </tr>

            <?php $no++;
            }; ?>
        </table>
    </div>
    <div class="card-footer bg-white p-0 m-0 pt-3 ps-5">
        <div class="pagination col-md-12 text-center">
            <?php if (isset($pagination)) {
                echo $pagination;
            } ?>
        </div>
    </div>
</div>