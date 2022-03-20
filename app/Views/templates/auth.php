<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://unpkg.com/aos@2.3.1/dist/aos.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/css/style.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/css/auth.css">
    <title><?= $title; ?></title>
</head>

<body class="auth text-center">
    <?= $this->include('templates/alerts'); ?>
    <?= $this->renderSection('main'); ?>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
</body>
</html>