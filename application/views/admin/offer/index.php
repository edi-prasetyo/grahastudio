<div class="card">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <?php echo $title; ?>
    </div>

    <?php
    if ($this->session->flashdata('message')) {
        echo $this->session->flashdata('message');
        unset($_SESSION['message']);
    }
    ?>

    <div class="table-responsive">
        <table class="table">
            <thead class="thead-light">
                <tr>
                    <th>No</th>
                    <th></th>
                    <th>Nama</th>
                    <th>Type</th>
                    <th>Nama Bisnis</th>
                    <th>Email</th>
                    <th>Whatsapp</th>
                    <th width="20%">Action</th>
                </tr>
            </thead>
            <?php $no = 1;
            foreach ($offer as $data) { ?>
                <tr>
                    <td><?php echo $no; ?></td>
                    <td><?php if ($data->status_read == 0) : ?>
                            <i class="fa-solid fa-circle-exclamation text-danger"></i>
                        <?php else : ?>
                            <i class="fa-solid fa-circle-check text-success"></i>
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php echo $data->name; ?>
                    </td>
                    <td><?php echo $data->type; ?></td>
                    <td><?php echo $data->business_name; ?></td>
                    <td><?php echo $data->email; ?></td>
                    <td><?php echo $data->whatsapp; ?></td>
                    <td>
                        <a href="<?php echo base_url('admin/offer/detail/' . $data->id); ?>" class="btn btn-info btn-sm text-white"><i class="ti-pencil-alt"></i> View</a>

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