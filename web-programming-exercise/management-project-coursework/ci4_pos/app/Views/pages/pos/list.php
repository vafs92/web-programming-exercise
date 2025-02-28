<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="card" style="border: 1px solid #8B0000; border-radius: 10px;">
    <div class="card-header">
        <div class="d-flex w-100 justify-content-between">
            <div class="col-auto">
                <div class="card-title h4 mb-0 fw-bolder">List of Transactions</div>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="container-fluid">
            <table class="table table-striped table-bordered">
                <colgroup>
                    <col width="5%">
                    <col width="15%">
                    <col width="15%">
                    <col width="25%">
                    <col width="10%">
                    <col width="20%">
                    <col width="10%">
                </colgroup>
                <thead>
                    <tr style="vertical-align: middle;">
                        <th class="p-1 text-center">No</th>
                        <th class="p-1 text-center">Date/Time</th>
                        <th class="p-1 text-center">Code</th>
                        <th class="p-1 text-center">Customer</th>
                        <th class="p-1 text-center">Items</th>
                        <th class="p-1 text-center">Total Amount</th>
                        <th class="p-1 text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $num = ($page - 1) * $perPage + 1;
                    foreach ($transactions as $row): ?>
                        <tr>
                            <th class="p-1 text-center align-middle"><?= $num ?></th>
                            <td class="px-2 py-1 align-middle"><?= date("Y-m-d h:i A", strtotime($row['created_at'])) ?></td>
                            <td class="px-2 py-1 align-middle"><?= $row['code'] ?></td>
                            <td class="px-2 py-1 align-middle"><?= $row['customer'] ?></td>
                            <td class="px-2 py-1 align-middle text-end"><?= number_format($row['total_items']) ?></td>
                            <td class="px-2 py-1 align-middle text-end"><?= number_format($row['total_amount'], 2) ?></td>
                            <td class="px-2 py-1 align-middle text-center">
                                <a href="<?= base_url('Main/transaction_view/' . $row['id']) ?>" class="mx-2 text-decoration-none text-dark"><i class="fa fa-eye"></i></a>
                                <a href="<?= base_url('Main/transaction_delete/' . $row['id']) ?>" class="mx-2 text-decoration-none text-danger" onclick="if(confirm('Are you sure to delete <?= $row['code'] ?> from list?') !== true) event.preventDefault()"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                    <?php
                        $num++;
                    endforeach; ?>
                    <?php if (count($transactions) <= 0): ?>
                        <tr>
                            <td class="p-1 text-center" colspan="7">No result found</td>
                        </tr>
                    <?php endif ?>
                </tbody>
            </table>
            <div>
                <?= $pager->makeLinks($page, $perPage, $total, 'custom_view') ?>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>