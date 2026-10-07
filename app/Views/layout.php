<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= esc($title ?? 'POS Accounts') ?></title>
    <link rel="stylesheet" href="<?= base_url('css/app.css') ?>">
</head>
<body>
<header class="site-header">
    <a class="brand" href="<?= site_url('/') ?>">POS Accounts</a>
    <nav aria-label="Main navigation">
        <a href="<?= site_url('/') ?>">Home</a>
        <a href="<?= site_url('customers') ?>">Customers</a>
        <a href="<?= site_url('users') ?>">Users</a>
        <a href="<?= site_url('about') ?>">About</a>
    </nav>
</header>

<main class="container">
    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert success" role="status"><?= esc(session()->getFlashdata('success')) ?></div>
    <?php endif; ?>

    <?= $this->renderSection('content') ?>
</main>
</body>
</html>
