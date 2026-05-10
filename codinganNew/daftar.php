<?php
session_start();
$error='';
if($_SERVER['REQUEST_METHOD']==='POST'){
  $nama = trim($_POST['nama']??'');
  $password = $_POST['password']??'';
  $telepon = trim($_POST['telepon']??'');
  if($nama===''||$password===''||$telepon===''){
    $error='Semua kolom wajib diisi.';
  } elseif(!preg_match('/^[0-9 +\-]{8,}$/',$telepon)){
    $error='Nomor telepon tidak valid.';
  } else {
    $_SESSION['user']=['nama'=>$nama,'telepon'=>$telepon];
    header('Location: profil.php'); exit;
  }
}
$pageTitle='Daftar';
?>
<link rel="stylesheet" href="style.css">
<div class="split">
  <div class="split-art">
    <img src="../assets/candle.jpg" alt="Lilin spa">
    <div class="quote">"Ritual baru dimulai dari sini."</div>
  </div>
  <div class="split-form">
    <div class="card">
      <div class="eyebrow">Bergabung dengan SpaGo</div>
      <h2 class="title" style="margin-top:10px">Buat <em style="font-style:italic;color:var(--gold)">akun</em> Anda</h2>
      <p class="lead">Beberapa langkah saja menuju ritual rumah Anda.</p>
      <?php if($error): ?><div class="error"><?= htmlspecialchars($error) ?></div><?php endif; ?>
      <form method="post" novalidate>
        <div class="field">
          <label for="nama">Nama Lengkap</label>
          <input id="nama" name="nama" type="text" placeholder="Mis. Anindya Putri" required>
        </div>
        <div class="field">
          <label for="telepon">Nomor Telepon</label>
          <input id="telepon" name="telepon" type="tel" placeholder="08xx-xxxx-xxxx" required>
        </div>
        <div class="field">
          <label for="password">Password</label>
          <input id="password" name="password" type="password" placeholder="Minimal 6 karakter" required>
        </div>
        <button class="btn btn-primary btn-block" type="submit">Daftar Sekarang</button>
      </form>
      <div class="divider">sudah punya akun?</div>
      <a href="login.php" class="btn btn-ghost btn-block" style="border:1px solid var(--line);border-radius:999px">Masuk ke Akun →</a>
    </div>
  </div>
</div>
</body></html>
