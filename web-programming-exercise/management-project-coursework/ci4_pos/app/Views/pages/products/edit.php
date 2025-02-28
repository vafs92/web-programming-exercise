<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="card rounded-0">
    <div class="card-header">
        <div class="d-flex w-100 justify-content-between">
            <div class="col-auto">
                <div class="card-title h4 mb-0 fw-bolder">Update Product Details</div>
            </div>
            <div class="col-auto">
                <a href="<?= base_url('Main/products') ?>" class="btn btn btn-secondary bg-gradient border rounded-0"><i class="fa fa-angle-left"></i> Back to List</a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="container-fluid">
            <form action="<?= base_url('Main/product_edit/' . (isset($product['id']) ? $product['id'] : '')) ?>" method="POST" enctype="multipart/form-data">
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
                    <label for="code" class="control-label">Code</label>
                    <input type="text" class="form-control rounded-0" id="code" name="code" autofocus placeholder="Company Code" value="<?= !empty($product['code']) ? $product['code'] : '' ?>" required="required">
                </div>
                <div class="mb-3">
                    <label for="name" class="control-label">Name</label>
                    <input type="text" class="form-control rounded-0" id="name" name="name" autofocus placeholder="John" value="<?= !empty($product['name']) ? $product['name'] : '' ?>" required="required">
                </div>
                <div class="mb-3">
                    <label for="description" class="control-label">Description</label>
                    <textarea rows="3" class="form-control rounded-0" id="description" name="description" autofocus placeholder="(optional)"><?= !empty($product['description']) ? $product['description'] : '' ?></textarea>
                </div>
                <div class="mb-3">
                    <label for="image" class="control-label">Upload Image</label>
                    <input type="file" name="foto_product" class="form-control" accept="image/*">
                    <!-- Menampilkan gambar yang sudah ada (jika ada) -->
                    <?php if (!empty($product['foto_product'])): ?>
                        <div class="mt-3">
                            <img src="<?= base_url('uploads/' . $product['foto_product']) ?>" alt="Product Image" class="img-thumbnail" style="max-width: 200px;">
                            <p class="mt-2">Current Image</p>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="mb-3">
                    <label for="price" class="control-label">Price</label>
                    <input type="number" step="any" class="form-control rounded-0" id="price" name="price" autofocus placeholder="Price" value="<?= !empty($product['price']) ? $product['price'] : '' ?>" required="required">
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

                <div class="d-grid gap-1">
                    <button class="btn rounded-0 btn-primary bg-gradient" style="background-color: #8B0000;">Update</button>
                    <a href="<?= base_url('Main/products'); ?>" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection() ?>