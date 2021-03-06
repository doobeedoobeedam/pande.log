<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?= base_url(); ?>/css/aos.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/css/style.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/css/auth.css">
    <link rel="icon" type="image/png" href="<?= base_url(); ?>/img/logop.png">
    <title><?= $title; ?></title>
</head>

<body class="auth text-center">
    <?= $this->include('templates/alerts'); ?>
    <?= $this->renderSection('main'); ?>
    <script src="<?= base_url(); ?>/js/jquery-3.4.1.min.js"></script>
    <script src="<?= base_url(); ?>/js/aos.js"></script>
    <script>
        AOS.init();
    </script>
</body>
</html>