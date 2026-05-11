<?php
// updateprofile.php — Update profil pelanggan ke database
session_start();
if (!isset($_SESSION['user'])) { header('Location: login.php'); exit; }
require 'koneksi.php';

$user    = $_SESSION['user'];
$user_id = $user['id'];

$message = '';
$error   = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama            = trim($_POST['nama']             ?? $user['nama']);
    $telepon         = trim($_POST['telepon']          ?? ($user['telepon'] ?? ''));
    $password        = trim($_POST['password']         ?? '');
    $passwordConfirm = trim($_POST['password_confirm'] ?? '');

    if ($nama === '') {
        $error = 'Nama tidak boleh kosong.';
    } elseif ($password !== '' && $password !== $passwordConfirm) {
        $error = 'Password dan konfirmasi password tidak cocok.';
    } elseif ($password !== '' && strlen($password) < 6) {
        $error = 'Password minimal 6 karakter.';
    } else {
        if ($password !== '') {
            // Update nama, telepon, dan password
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $conn->prepare("UPDATE users SET nama = ?, telepon = ?, password = ? WHERE id = ?");
            $stmt->bind_param('sssi', $nama, $telepon, $hash, $user_id);
        } else {
            // Update nama dan telepon saja
            $stmt = $conn->prepare("UPDATE users SET nama = ?, telepon = ? WHERE id = ?");
            $stmt->bind_param('ssi', $nama, $telepon, $user_id);
        }

        if ($stmt->execute()) {
            // Perbarui session
            $_SESSION['user']['nama']    = $nama;
            $_SESSION['user']['telepon'] = $telepon;
            $user                        = $_SESSION['user'];
            $message                     = 'Profil berhasil diperbarui.';
        } else {
            $error = 'Gagal memperbarui profil, coba lagi.';
        }
    }
}

$pageTitle = 'Update Profil';
$active    = 'profil';
include 'header.php';
?>
<div class="container" style="max-width:720px;padding:40px 0">
  <div class="card card-wide">
    <div class="profile-head">
      <img src="../assets/profile.jpg" class="avatar" alt="Foto profil">
      <div style="flex:1">
        <div class="eyebrow">Edit Profil</div>
        <h2><?= htmlspecialchars($user['nama']) ?></h2>
        <div class="meta"><?= htmlspecialchars($user['telepon'] ?? 'Tambahkan nomor telepon') ?></div>
      </div>
      <a href="profil.php" class="btn btn-ghost"
         style="border:1px solid var(--line);border-radius:999px;padding:10px 20px;font-size:14px">Kembali</a>
    </div>

    <?php if ($message): ?>
      <div class="success"
           style="margin:16px 0;padding:14px 18px;border:1px solid #3e8e41;color:#214b24;background:#e6f4ea;border-radius:12px">
        <?= htmlspecialchars($message) ?>
      </div>
    <?php endif; ?>
    <?php if ($error): ?>
      <div class="error"
           style="margin:16px 0;padding:14px 18px;border:1px solid #d0383b;color:#7f1d1d;background:#fee2e2;border-radius:12px">
        <?= htmlspecialchars($error) ?>
      </div>
    <?php endif; ?>

    <h3>Edit Profil</h3>
    <form action="updateprofile.php" method="post" style="display:grid;gap:20px">
      <div class="field">
        <label for="nama">Nama Lengkap</label>
        <input id="nama" name="nama" type="text" required
               value="<?= htmlspecialchars($user['nama']) ?>" placeholder="Nama Anda">
      </div>
      <div class="field">
        <label for="telepon">Nomor Telepon</label>
        <input id="telepon" name="telepon" type="tel"
               value="<?= htmlspecialchars($user['telepon'] ?? '') ?>" placeholder="08xxxxxxx">
      </div>
      <div class="field">
        <label for="password">Password Baru</label>
        <input id="password" name="password" type="password"
               placeholder="Kosongkan jika tidak ingin ubah">
      </div>
      <div class="field">
        <label for="password_confirm">Konfirmasi Password</label>
        <input id="password_confirm" name="password_confirm" type="password"
               placeholder="Ulangi password baru">
      </div>
      <button type="submit" class="btn btn--primary"
              style="padding:12px 24px;max-width:240px">Simpan Perubahan</button>
    </form>
  </div>
</div>
</body>
</html>
