<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<style>
    body {
        background-image: url('<?= base_url('public/gambar/home2.jpeg') ?>');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
    }
</style>

<body>
    <div class="card" style="border: 1px solid #8B0000; border-radius: 10px;">
        <div class="card-header">
            <div class="d-flex w-100 justify-content-between">
                <div class="col-auto">
                    <div class="card-title h4 mb-0 fw-bolder">Add New Product</div>
                </div>
                <div class="col-auto">
                    <a href="<?= base_url('Main/products') ?>" class="btn btn-secondary"><i
                            class="fa fa-angle-left"></i> Back to List</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="container-fluid">
                <!-- Formulir untuk menambahkan produk baru -->
                <form action="<?= base_url('Main/product_add') ?>" method="POST" enctype="multipart/form-data">

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

                    <!-- Input untuk Kode Produk -->
                    <div class="mb-3">
                        <label for="code" class="control-label">Code</label>
                        <input type="text" class="form-control rounded-0" id="code" name="code" autofocus placeholder="Code"
                            value="<?= !empty($request->getPost('code')) ? $request->getPost('code') : '' ?>"
                            required="required">
                    </div>

                    <!-- Input untuk Nama Produk -->
                    <div class="mb-3">
                        <label for="name" class="control-label">Name</label>
                        <input type="text" class="form-control rounded-0" id="name" name="name" placeholder="Product 101"
                            value="<?= !empty($request->getPost('name')) ? $request->getPost('name') : '' ?>"
                            required="required">
                    </div>

                    <!-- Input untuk Deskripsi Produk -->
                    <div class="mb-3">
                        <label for="description" class="control-label">Description</label>
                        <textarea rows="3" class="form-control rounded-0" id="description"
                            name="description"><?= !empty($request->getPost('description')) ? $request->getPost('description') : '' ?></textarea>
                    </div>

                    <!-- Input untuk Gambar Produk -->
                    <div class="mb-3">
                        <label for="image" class="control-label">Upload Image</label>
                        <input type="file" name="foto_product" class="form-control" accept="image/*" required>
                    </div>

                    <!-- Input untuk Harga Produk -->
                    <div class="mb-3">
                        <label for="price" class="control-label">Price</label>
                        <input type="number" step="any" class="form-control rounded-0 text-end" id="price" name="price"
                            value="<?= !empty($request->getPost('price')) ? $request->getPost('price') : '' ?>"
                            required="required">
                    </div>

                    <div class="mb-3">
                        <label for="avail" class="control-label">Availability</label>
                        <div class="input-group rounded-0">
                            <select class="form-select rounded-0" id="avail" name="avail" required>
                                <option value="Available" <?= $request->getPost('avail') === 'Available' ? 'selected' : '' ?>>Available</option>
                                <option value="Unavailable" <?= $request->getPost('avail') === 'Unavailable' ? 'selected' : '' ?>>Unavailable</option>
                            </select>
                        </div>
                    </div>

                    <!-- Tombol untuk menyimpan produk -->
                    <div class="d-grid gap-1">
                        <button class="btn rounded-0 btn-primary" style="background-color: #8B0000;">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
<?= $this->endSection() ?>