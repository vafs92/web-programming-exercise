<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<!-- <style>
    body {
        background-image: url('<?= base_url('public/gambar/home2.jpeg') ?>');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
    }
</style> -->

<body>
    <div class="card rounded-0">
        <div class="card-header">
            <div class="d-flex w-100 justify-content-between">
                <div class="col-auto">
                    <div class="card-title h4 mb-0 fw-bolder">Add New User</div>
                </div>
                <div class="col-auto">
                    <a href="<?= base_url('Main/users') ?>" class="btn btn btn-secondary bg-gradient border rounded-0"><i class="fa fa-angle-left"></i> Back to List</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="container-fluid">
                <form action="<?= base_url('Main/user_add/') ?>" method="POST">
                    <?php if ($session->getFlashdata('error')): ?>
                        <div class="alert alert-danger rounded-0">
                            <?= $session->getFlashdata('error') ?>
                        </div>
                    <?php endif; ?>
                    <?php if ($session->getFlashdata('success')): ?>
                        <div class="alert alert-success rounded-0">
                            <?= $session->getFlashdata('success') ?>
                        </div>
                    <?php endif; ?>
                    <div class="mb-3">
                        <label for="email" class="control-label">Name</label>
                        <div class="input-group rounded-0">
                            <input type="text" class="form-control rounded-0" id="name" name="name" autofocus placeholder="John Smith" value="<?= !empty($request->getPost('name')) ? $request->getPost('name') : '' ?>" required="required">
                            <div class="input-group-text bg-light bg-gradient rounded-0"><i class="fa fa-user"></i></div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="control-label">Email</label>
                        <div class="input-group rounded-0">
                            <input type="email" class="form-control rounded-0" id="email" name="email" placeholder="jsmith@mail.com" value="<?= !empty($request->getPost('email')) ? $request->getPost('email') : '' ?>" required="required">
                            <div class="input-group-text bg-light bg-gradient rounded-0"><i class="fa fa-at"></i></div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="control-label">Password</label>
                        <div class="input-group rounded-0">
                            <input type="password" class="form-control rounded-0" id="password" name="password" placeholder="**********" required>
                            <div class="input-group-text bg-light bg-gradient rounded-0"><i class="fa fa-key"></i></div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="control-label">Confirm Password</label>
                        <div class="input-group rounded-0">
                            <input type="password" class="form-control rounded-0" id="cpassword" name="cpassword" placeholder="**********" required>
                            <div class="input-group-text bg-light bg-gradient rounded-0"><i class="fa fa-key"></i></div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="role" class="control-label">Role</label>
                        <div class="input-group rounded-0">
                            <select class="form-select rounded-0" id="role" name="role" required>
                                <option value="" disabled selected>Select Role</option>
                                <option value="Manager" <?= $request->getPost('role') === 'Manager' ? 'selected' : '' ?>>Manager</option>
                                <option value="Cashier" <?= $request->getPost('role') === 'Cashier' ? 'selected' : '' ?>>Cashier</option>
                            </select>
                            <div class="input-group-text bg-light bg-gradient rounded-0"><i class="fa fa-user"></i></div>
                        </div>
                    </div>
                    <div class="d-grid gap-1">
                        <button class="btn rounded-0 btn-primary bg-gradient" style="background-color: #8B0000;">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
<?= $this->endSection() ?>