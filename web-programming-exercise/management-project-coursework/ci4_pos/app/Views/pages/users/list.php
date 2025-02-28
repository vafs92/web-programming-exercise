<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="card" style="border: 1px solid #8B0000; border-radius: 10px;">
    <div class="card-header">
        <div class="d-flex w-100 justify-content-between">
            <div class="col-auto">
                <div class="card-title h4 mb-0 fw-bolder">List of Users</div>
            </div>
            <?php if (session()->get('role') == "Manager"): ?>
            <div class="col-auto">
                <a href="<?= base_url('Main/user_add') ?>" class="btn btn-primary" style="background-color: #8B0000;"><i
                        class="fa fa-plus-square"></i> Add User</a>
            </div>
            <?php endif; ?>
        </div>
    </div>
    <div class="card-body">
        <div class="container-fluid">
            <table class="table table-striped table-bordered">
                <colgroup>
                    <col width="5%">
                    <col width="25%">
                    <col width="25%">
                    <col width="30%">
                    <col width="15%">
                </colgroup>
                <thead>
                    <tr style="vertical-align: middle;">
                        <th class="p-1 text-center">No</th>
                        <th class="p-1 text-center">Name</th>
                        <th class="p-1 text-center">Email</th>
                        <th class="p-1 text-center">Role</th>
                        <th class="p-1 text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $num = ($page - 1) * $perPage + 1;
                    foreach ($users as $row): ?>
                        <tr>
                            <th class="p-1 text-center align-middle"><?= $num ?></th>
                            <td class="px-2 py-1 align-middle"><?= $row['name'] ?></td>
                            <td class="px-2 py-1 align-middle"><?= $row['email'] ?></td>
                            <td class="px-2 py-1 text-center align-middle"><?= $row['role'] ?></td>
                            <td class="px-2 py-1 align-middle text-center">
                                <a href="<?= base_url('Main/user_edit/' . $row['id']) ?>" class="mx-2 text-decoration-none text-primary"><i class="fa fa-edit"></i></a>
                                <a href="<?= base_url('Main/user_delete/' . $row['id']) ?>" class="mx-2 text-decoration-none text-danger" onclick="if(confirm('Are you sure to delete <?= $row['email'] ?> from list?') !== true) event.preventDefault()"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                    <?php
                        $num++;
                    endforeach; ?>
                    <?php if (count($users) <= 0): ?>
                        <tr>
                            <td class="p-1 text-center" colspan="4">No result found</td>
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