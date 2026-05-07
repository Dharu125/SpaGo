<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SpaGo — Buat Akun</title>
    <link rel="stylesheet" href="styles.css" />
  </head>
  <header class="nav">
    <div class="container nav__inner">
      <a href="index.html" class="brand">SpaGo</a>
      <nav class="nav__links">
        <a href="login.php">Login</a>
        <a href="layanan.html">Layanan</a>
        <a href="tentang.html">Tentang</a>
        <a href="booking.php">Booking</a>
        <a href="#contact">Kontak</a>
      </nav>
    </div>
  </header>
  <body>
    <form class="booking__form" action="submit_booking.php" method="POST">
          <div class="field">
            <label for="name">Username</label>
            <input name="name" id="username" type="text" required placeholder="Username" />
          </div>
          <div class="field">
            <label for="name">Password</label>
            <input name="password" id="password" type="password" required placeholder="Password" />
          </div>
          <button type="submit" class="btn btn--primary btn--full">
            Buat Akun
          </button>
        </form>
  </body>