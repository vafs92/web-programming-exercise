<head>
    <!-- Menambahkan favicon -->
    <link rel="icon" href="<?= base_url('public/gambar/logo.jpg') ?>" type="image/jpeg">
</head>

<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="card" style="border: 1px solid #8B0000; border-radius: 10px;">
    <div class="card-header">
        <div class="d-flex w-100 justify-content-between">
            <div class="col-auto">
                <div class="card-title h4 mb-0 fw-bolder">List of Products</div>
            </div>
            <?php if (session()->get('role') == "Manager"): ?>
                <div class="col-auto">
                    <a href="<?= base_url('Main/product_add') ?>" class="btn btn-primary" style="background-color: #8B0000;"><i
                            class="fa fa-plus-square"></i> Add Product</a>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <div class="card-body">
        <div class="container-fluid">
            <table class="table table-striped table-bordered">
                <colgroup>
                    <col width="5%">
                    <col width="10%">
                    <col width="10%">
                    <col width="20%">
                    <col width="10%">
                    <col width="10%"><!-- photo -->
                    <col width="15%">
                    <col width="10%">

                </colgroup>
                <thead>
                    <tr style="vertical-align: middle;">
                        <th class="p-1 text-center">No</th>
                        <th class="p-1 text-center">Code</th>
                        <th class="p-1 text-center">Product Name</th>
                        <th class="p-1 text-center">Description</th>
                        <th class="p-1 text-center">Price</th>
                        <th class="p-1 text-center">Product Photo</th>
                        <th class="p-1 text-center">Availability</th>
                        <th class="p-1 text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $num = ($page - 1) * $perPage + 1;
                    foreach ($products as $row): ?>
                        <tr>
                            <th class="p-1 text-center align-middle"><?= $num ?></th>
                            <td class="px-2 py-1 text-center align-middle"><?= $row['code'] ?></td>
                            <td class="px-2 py-1 text-center align-middle"><?= $row['name'] ?></td>
                            <td class="px-2 py-1 text-center align-middle"><?= $row['description'] ?></td>
                            <td class="px-2 py-1 text-center align-middle text-end"><?= number_format($row['price'], 2) ?></td>
                            <td class="px-2 py-1 text-center align-middle">
                                <img src="<?= base_url('uploads/' . $row['foto_product']) ?>" alt="Product Image"
                                    class="img-thumbnail" style="width: 50px;">
                            </td>
                            
                            <td class="px-2 py-1 text-center align-middle"><?= $row['avail'] ?></td>
                            <td class="px-2 py-1 align-middle text-center">
                                <?php if (session()->get('role') == "Manager"): ?>
                                    <a href="<?= base_url('Main/product_edit/' . $row['id']) ?>"
                                        class="mx-2 text-decoration-none text-primary"><i class="fa fa-edit"></i></a>
                                    <a href="<?= base_url('Main/product_delete/' . $row['id']) ?>"
                                        class="mx-2 text-decoration-none text-danger"
                                        onclick="if(confirm('Are you sure to delete <?= $row['code'] ?> - <?= $row['name'] ?> from list?') !== true) event.preventDefault()"><i
                                            class="fa fa-trash"></i></a>
                                <?php endif; ?>
                                <a href="<?= base_url('Main/product_detail/' . $row['id']) ?>"
                                    class="mx-2 text-decoration-none text-dark"><i class="fa fa-eye"></i></a>
                            </td>
                        </tr>
                    <?php
                        $num++;
                    endforeach; ?>
                    <?php if (count($products) <= 0): ?>
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

<div class="modal fade" id="modalProduct" tabindex="-1" aria-labelledby="modalProductLabel" aria-hidden="true"
    data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalProductLabel"><i class="bi bi-box"></i> Detail Produk</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <img id="productImage" src="" alt="Product Image" class="img-fluid rounded shadow">
                    </div>
                    <div class="col-md-6">
                        <table class="table table-striped">
                            <tr>
                                <th>No</th>
                                <td id="productNo"></td>
                            </tr>
                            <tr>
                                <th>Code</th>
                                <td id="productCode"></td>
                            </tr>
                            <tr>
                                <th>Product</th>
                                <td id="productName"></td>
                            </tr>
                            <tr>
                                <th>Description</th>
                                <td id="productDescription"></td>
                            </tr>
                            <tr>
                                <th>Price</th>
                                <td id="productPrice"></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <a href="#" id="learnMoreLink" class="btn btn-primary" target="_blank">Pelajari Lebih Lanjut</a>
            </div>
        </div>
    </div>
</div>

</script>
<?= $this->endSection() ?>

<style>
    /* Modal di tengah */
    .modal-dialog-centered {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        /* Mengatur tinggi modal untuk 100% viewport */
        margin: 0;
        /* Menghilangkan margin default */
    }

    .modal-content {
        width: 80%;
        /* Ukuran modal lebih besar, bisa disesuaikan */
        max-width: 600px;
        /* Membatasi ukuran maksimal modal */
        margin: auto;
        /* Mengatur margin otomatis untuk sentris */
    }
</style>