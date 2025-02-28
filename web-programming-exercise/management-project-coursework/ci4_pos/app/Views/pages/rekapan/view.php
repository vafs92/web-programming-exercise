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
    <!-- <div class="card rounded-0">
        <div class="card-header">
            <div class="d-flex w-100 justify-content-between">
                <div class="col-auto">
                    <div class="card-title h4 mb-0 fw-bolder">Sales Report</div>
                </div>
            </div>
        </div> -->
    <div class="card" style="border: 1px solid #8B0000; border-radius: 10px;">
        <div class="card-header">
            <div class="d-flex w-100 justify-content-between">
                <div class="col-auto">
                    <div class="card-title h4 mb-0 fw-bolder">Sales Reports</div>
                </div>
            </div>
        </div>
        <!-- Date Range Filter Form -->
        <div class="card-body">
            <div class="container-fluid">

                <form method="GET" action="<?= base_url('Main/report') ?>" class="row g-3 mb-4">
                    <div class="col-md-4">
                        <label for="start_date" class="form-label">Start Date</label>
                        <input type="date" class="form-control" id="start_date" name="start_date" value="<?= $start_date ?? '' ?>" required>
                    </div>
                    <div class="col-md-4">
                        <label for="end_date" class="form-label">End Date</label>
                        <input type="date" class="form-control" id="end_date" name="end_date" value="<?= $end_date ?? '' ?>" required>
                    </div>
                    <!-- <div class="col-md-4"> -->
                    <div class="col-md-4 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary" style="background-color: #8B0000;">Filter</button>
                        <!-- </div> -->
                    </div>
                </form>

                <!-- Summary Statistics -->
                <div class="row mb-4">
                    <div class="col-lg-3 col-md-6 col-sm-12 mb-2">
                        <div class="card bg-light">
                            <div class="card-body">
                                <h6>Total Quantity Sold</h6>
                                <h4><?= $total_qty ?? 0 ?></h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12 mb-2">
                        <div class="card bg-light">
                            <div class="card-body">
                                <h6>Total Income</h6>
                                <h4>Rp <?= number_format($total_income ?? 0, 2, ',', '.') ?></h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12 mb-2">
                        <div class="card bg-light">
                            <div class="card-body">
                                <h6>Best-Selling Item</h6>
                                <h4><?= $most_sold_item->product_name ?? '-' ?> (<?= $most_sold_item->total_qty ?? 0 ?>)</h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12 mb-2">
                        <div class="card bg-light">
                            <div class="card-body">
                                <h6>Average Sales per Day</h6>
                                <h4>Rp <?= number_format($avg_sales_per_day ?? 0, 2, ',', '.') ?></h4>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Transaction Items Table -->
                <table id="tabelRekapan" class="table table-stripped table-bordered">
                    <colgroup>
                        <col width="5%">
                        <col width="15%">
                        <col width="15%">
                        <col width="25%">
                        <col width="10%">
                        <col width="20%">
                    </colgroup>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr style="vertical-align: middle;">
                                    <th class="p-1 text-center">No</th>
                                    <th class="p-1 text-center">Transaction Code</th>
                                    <th class="p-1 text-center">Product</th>
                                    <th class="p-1 text-center">Quantity</th>
                                    <th class="p-1 text-center">Unit Price</th>
                                    <th class="p-1 text-center">Total</th>
                                    <th class="p-1 text-center">Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($transactions_item)): ?>
                                    <?php $no = 1 + ($perPage * ($page - 1)); ?>
                                    <?php foreach ($transactions_item as $item): ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= esc($item['transaction_code']) ?></td>
                                            <td><?= esc($item['product']) ?></td>
                                            <td><?= esc($item['quantity']) ?></td>
                                            <td>Rp <?= number_format($item['price'], 2, ',', '.') ?></td>
                                            <td>Rp <?= number_format($item['total'], 2, ',', '.') ?></td>
                                            <td><?= date('d-m-Y', strtotime($item['created_at'])) ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="7" class="text-center">No data available for this period.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <!-- <div class="d-flex justify-content-center"> -->
                    <?= $pager->makeLinks($page, $perPage, $total, 'custom_view') ?>
                    <!-- </div> -->
                </table>
            </div>
        </div>
    </div>
</body>
<?= $this->endSection() ?>