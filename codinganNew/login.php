<?php
session_start();
$error = '';
if($_SERVER['REQUEST_METHOD']==='POST'){
  $nama = trim($_POST['nama']??'');
  $password = $_POST['password']??'';
  if($nama==='' || $password===''){
    $error = 'Nama dan password wajib diisi.';
  } else {
    // Demo: accept any non-empty credential
    $_SESSION['user'] = ['nama'=>$nama];
    header('Location: profil.php'); exit;
  }
}
$pageTitle='Masuk'; $active='login';
?>
<link rel="stylesheet" href="style.css">
<div class="split">
  <div class="split-art">
    <img src="../assets/spa-hero.jpg" alt="Suasana home spa">
    <div class="quote">"Ketenangan yang datang ke rumah Anda."</div>
  </div>
  <div class="split-form">
    <div class="card">
      <div class="eyebrow">Selamat datang kembali</div>
      <h2 class="title" style="margin-top:10px">Masuk ke <em style="font-style:italic;color:var(--gold)">SpaGo</em></h2>
      <p class="lead">Lanjutkan ritual ketenangan Anda.</p>
      <?php if($error): ?><div class="error"><?= htmlspecialchars($error) ?></div><?php endif; ?>
      <form action="profil.php" method="post" novalidate>
        <div class="field">
          <label for="nama">Nama</label>
          <input id="nama" name="nama" type="text" placeholder="Nama Anda" required>
        </div>
        <div class="field">
          <label for="password">Password</label>
          <input id="password" name="password" type="password" placeholder="••••••••" required>
        </div>
        <button class="btn btn-primary btn-block" type="submit">Masuk</button>
      </form>
      <div class="divider">atau</div>
      <a href="daftar.php" class="btn btn-ghost btn-block" style="border:1px solid var(--line);border-radius:999px">Buat Akun Baru →</a>
    </div>
  </div>
</div>
</body></html>
