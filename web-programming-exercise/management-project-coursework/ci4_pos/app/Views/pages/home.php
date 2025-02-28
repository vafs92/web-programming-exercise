<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="welcome-container">
    <div class="welcome-box">
        <h1 class="fw-bold">Welcome, <?= $session->get('login_name') ?>!</h1>
    </div>
</div>


<?= $this->endSection() ?>