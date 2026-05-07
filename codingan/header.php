<?php if(session_status()===PHP_SESSION_NONE) session_start(); ?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?= isset($pageTitle)?$pageTitle.' — SpaGo':'SpaGo — Home Spa Experience' ?></title>
<link rel="stylesheet" href="../css/style.css">
</head>
<body>
<nav class="nav">
  <a href="index.php" class="brand">SpaGo</a>
  <div class="nav-links">
    <a href="profil.php" class="<?= ($active??'')==='profil'?'active':'' ?>">Profil</a>
    <a href="layanan.html">Layanan</a>
    <a href="tentang.html">Tentang</a>
    <a href="booking.php">Booking</a>
    <a href="kontak.php">Kontak</a>
  </div>
</nav>
