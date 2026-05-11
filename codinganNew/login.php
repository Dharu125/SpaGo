<?php
// login.php — Login pelanggan (validasi dari database)
session_start();
require 'koneksi.php';

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $telepon  = trim($_POST['telepon']  ?? '');
    $password = $_POST['password'] ?? '';

    if ($telepon === '' || $password === '') {
        $error = 'Nomor telepon dan password wajib diisi.';
    } else {
        $stmt = $conn->prepare("SELECT id, nama, telepon, password FROM users WHERE telepon = ?");
        $stmt->bind_param('s', $telepon);
        $stmt->execute();
        $result = $stmt->get_result();
        $user   = $result->fetch_assoc();

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user'] = [
                'id'      => $user['id'],
                'nama'    => $user['nama'],
                'telepon' => $user['telepon'],
            ];
            header('Location: profil.php');
            exit;
        } else {
            $error = 'Nomor telepon atau password salah.';
        }
    }
}

$pageTitle = 'Masuk';
$active    = 'login';
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
      <?php if ($error): ?>
        <div class="error"><?= htmlspecialchars($error) ?></div>
      <?php endif; ?>
      <form method="post" novalidate>
        <div class="field">
          <label for="telepon">Nomor Telepon</label>
          <input id="telepon" name="telepon" type="tel" placeholder="08xx-xxxx-xxxx" required
                 value="<?= htmlspecialchars($_POST['telepon'] ?? '') ?>">
        </div>
        <div class="field">
          <label for="password">Password</label>
          <input id="password" name="password" type="password" placeholder="••••••••" required>
        </div>
        <button class="btn btn-primary btn-block" type="submit">Masuk</button>
      </form>
      <div class="divider">atau</div>
      <a href="daftar.php" class="btn btn-ghost btn-block"
         style="border:1px solid var(--line);border-radius:999px">Buat Akun Baru →</a>
    </div>
  </div>
</div>
</body>
</html>
