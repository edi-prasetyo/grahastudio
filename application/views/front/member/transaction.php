<div class="breadcrumb">
    <div class="container">
        <ul class="breadcrumb my-3">
            <li class="breadcrumb-item"><a href="<?php echo base_url('member') ?>"><i class="ti ti-home"></i> Home</a></li>
            <li class="breadcrumb-item active"><?php echo $title ?></li>
        </ul>
    </div>
</div>

<div class="container mb-3">
    <div class="card shadow">
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
                        <th>Product</th>
                        <th>Harga</th>
                        <th>Status</th>
                        <th width="10%">Action</th>
                    </tr>
                </thead>
                <?php $no = 1;
                foreach ($transaction as $data) { ?>
                    <tr>
                        <td><?php echo $no; ?></td>
                        <td><?php echo date("j M Y", strtotime($data->created_at)); ?></td>
                        <td><?php echo $data->product_name; ?></td>
                        <td><?php echo number_format($data->total_price, 0, ",", "."); ?></td>

                        <td>
                            <a href="<?php echo base_url('member/detail_transaction/' . md5($data->id)); ?>">
                                <?php if ($data->payment_status == 'pending') : ?>
                                    <div class="badge bg-light-warning text-warning">Pending</div>
                                <?php elseif ($data->payment_status == 'success') : ?>
                                    <div class="badge bg-light-success text-success">Success</div>
                                <?php elseif ($data->payment_status == 'failed') : ?>
                                    <div class="badge bg-light-danger text-warning">Failed</div>
                                <?php else : ?>
                                    <div class="badge bg-light-danger">Expired</div>
                                <?php endif; ?>
                            </a>
                        </td>
                        <td>
                            <?php if ($data->payment_status == 'success') : ?>
                                <a href="<?php echo base_url('member/download/' . md5($data->id)) ?>" class="btn btn-success btn-sm text-white">Download</a>
                            <?php else : ?>
                                <a href="<?php echo base_url('member/transaction/download/') ?>" class="btn btn-success btn-sm text-white disabled">Download</a>
                            <?php endif; ?>
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

</div>