<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-name" content="<?= csrf_token() ?>">
    <meta name="csrf-hash" content="<?= csrf_hash() ?>">
    <title>TESLAR</title>
    <link rel="shortcut icon" type="image/png" href="/assets/images/backgrounds/hero.webp" />
    <!-- CSS BOOTSRAP 5 -->
    <link rel="stylesheet" href="/assets/css/styles.min.css" />
    <!-- My CSS -->
    <link rel="stylesheet" href="/assets/css/mycss.css">
    <!-- CSS SWIPER -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@12/swiper-bundle.min.css" />
</head>

<body>
    <?= $this->renderSection('content') ?>

    <!-- script js -->
    <script src="/assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@12/swiper-bundle.min.js"></script>
    <script src="/assets/js/myjs.js"></script>
</body>

</html>