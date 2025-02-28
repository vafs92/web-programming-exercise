<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="card rounded-0">
    <div class="card-header">
        <div class="d-flex w-100 justify-content-between">
            <div class="col-auto">
                <div class="card-title h4 mb-0 fw-bolder">Product Details</div>
            </div>
            <div class="col-auto">
                <a href="<?= base_url('Main/products') ?>" class="btn btn-secondary rounded-0">Back to Products</a>
            </div>
        </div>
    </div>

    <!-- Display Product Details -->
    <div class="row mt-5">
        <div class="col-md-6">
            <h5>Product Information</h5>
            <table class="table table-striped">
                <tr>
                    <th>Product Code</th>
                    <td><?= $details['code'] ?></td>
                </tr>
                <tr>
                    <th>Name</th>
                    <td><?= $details['name'] ?></td>
                </tr>
                <tr>
                    <th>Description</th>
                    <td><?= $details['description'] ?></td>
                </tr>
                <tr>
                    <th>Price</th>
                    <td><?= number_format($details['price'], 2) ?></td>
                </tr>
                <tr>
                    <th>Availability</th>
                    <td><?= $details['avail'] ?></td>
                </tr>
            </table>
        </div>
        <div class="col-md-6">
            <?php if (!empty($details['foto_product'])): ?>
                <!-- Menampilkan gambar produk jika kolom foto_product tidak kosong -->
                <img src="<?= base_url('uploads/' . $details['foto_product']) ?>" alt="Product Image" class="img-fluid rounded-0">
            <?php else: ?>
                <p>No image available.</p>
            <?php endif; ?>
        </div>
    </div>
</div>

<?= $this->endSection() ?>