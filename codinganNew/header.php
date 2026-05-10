<?php if(session_status()===PHP_SESSION_NONE) session_start(); ?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?= isset($pageTitle)?$pageTitle.' — SpaGo':'SpaGo — Home Spa Experience' ?></title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
      rel="stylesheet"
      />
<link rel="stylesheet" href="style.css">
</head>
<body>
  <header class="nav">
    <div class="container nav__inner">
      <a href="index.php" class="brand">SpaGo</a>
      <nav class="nav__links">
        <a href="profil.php" class="<?= ($active??'')==='profile'?'active':'' ?>">Profil</a>
        <a href="layanan.php">Layanan</a>
        <a href="tentang.php">Tentang</a>
        <a href="booking.php">Booking</a>
        <a href="#contact">Kontak</a>
      </nav>
    </div>
  </header>
</body>

