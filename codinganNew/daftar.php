<?php
// daftar.php — Registrasi pelanggan baru (simpan ke database)
session_start();
require 'koneksi.php';

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama    = trim($_POST['nama']     ?? '');
    $telepon = trim($_POST['telepon']  ?? '');
    $password = $_POST['password']     ?? '';

    if ($nama === '' || $password === '' || $telepon === '') {
        $error = 'Semua kolom wajib diisi.';
    } elseif (!preg_match('/^[0-9 +\-]{8,}$/', $telepon)) {
        $error = 'Nomor telepon tidak valid.';
    } elseif (strlen($password) < 6) {
        $error = 'Password minimal 6 karakter.';
    } else {
        // Cek apakah nomor telepon sudah terdaftar
        $cek = $conn->prepare("SELECT id FROM users WHERE telepon = ?");
        $cek->bind_param('s', $telepon);
        $cek->execute();
        $cek->store_result();

        if ($cek->num_rows > 0) {
            $error = 'Nomor telepon sudah terdaftar. Silakan login.';
        } else {
            // Simpan user baru ke database
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $conn->prepare("INSERT INTO users (nama, telepon, password) VALUES (?, ?, ?)");
            $stmt->bind_param('sss', $nama, $telepon, $hash);

            if ($stmt->execute()) {
                $user_id = $conn->insert_id;
                $_SESSION['user'] = [
                    'id'      => $user_id,
                    'nama'    => $nama,
                    'telepon' => $telepon,
                ];
                header('Location: profil.php');
                exit;
            } else {
                $error = 'Gagal mendaftar, coba lagi.';
            }
        }
    }
}

$pageTitle = 'Daftar';
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
      <?php if ($error): ?>
        <div class="error"><?= htmlspecialchars($error) ?></div>
      <?php endif; ?>
      <form method="post" novalidate>
        <div class="field">
          <label for="nama">Nama Lengkap</label>
          <input id="nama" name="nama" type="text" placeholder="Anindya Putri" required
                 value="<?= htmlspecialchars($_POST['nama'] ?? '') ?>">
        </div>
        <div class="field">
          <label for="telepon">Nomor Telepon</label>
          <input id="telepon" name="telepon" type="tel" placeholder="08xx-xxxx-xxxx" required
                 value="<?= htmlspecialchars($_POST['telepon'] ?? '') ?>">
        </div>
        <div class="field">
          <label for="password">Password</label>
          <input id="password" name="password" type="password" placeholder="Minimal 6 karakter" required>
        </div>
        <button class="btn btn-primary btn-block" type="submit">Daftar Sekarang</button>
      </form>
      <div class="divider">sudah punya akun?</div>
      <a href="login.php" class="btn btn-ghost btn-block"
         style="border:1px solid var(--line);border-radius:999px">Masuk ke Akun →</a>
    </div>
  </div>
</div>
</body>
</html>
