<?php
// profil.php — Profil pelanggan & riwayat booking dari database
session_start();
if (!isset($_SESSION['user'])) { header('Location: login.php'); exit; }
require 'koneksi.php';

$user    = $_SESSION['user'];
$user_id = $user['id'];

// Hapus satu riwayat
if (isset($_GET['hapus'])) {
    $id   = (int) $_GET['hapus'];
    $stmt = $conn->prepare("DELETE FROM bookings WHERE id = ? AND user_id = ?");
    $stmt->bind_param('ii', $id, $user_id);
    $stmt->execute();
    header('Location: profil.php');
    exit;
}

// Hapus semua riwayat milik user ini
if (isset($_GET['hapus_semua'])) {
    $stmt = $conn->prepare("DELETE FROM bookings WHERE user_id = ?");
    $stmt->bind_param('i', $user_id);
    $stmt->execute();
    header('Location: profil.php');
    exit;
}

// Ambil riwayat booking dari database
$stmt = $conn->prepare(
    "SELECT id, kode, layanan, tanggal, sesi, total
     FROM bookings
     WHERE user_id = ?
     ORDER BY created_at DESC"
);
$stmt->bind_param('i', $user_id);
$stmt->execute();
$result  = $stmt->get_result();
$riwayat = $result->fetch_all(MYSQLI_ASSOC);

$pageTitle = 'Profil';
$active    = 'profil';
include 'header.php';
?>
<div class="container">
  <div class="card card-wide">
    <div class="profile-head">
      <img src="../assets/profile.jpg" class="avatar" alt="Foto profil">
      <div style="flex:1">
        <div class="eyebrow">Profil Pelanggan</div>
        <h2><?= htmlspecialchars($user['nama']) ?></h2>
        <div class="meta"><?= htmlspecialchars($user['telepon'] ?? 'Anggota SpaGo') ?></div>
      </div>
      <a href="logout.php" class="btn btn-ghost"
         style="border:1px solid var(--line);border-radius:999px;padding:10px 20px;font-size:14px">Keluar</a>
    </div>

    <div style="display:flex;justify-content:space-between;align-items:center">
      <h3 class="section-title">Riwayat Pemesanan</h3>
      <?php if (!empty($riwayat)): ?>
        <a href="?hapus_semua=1" class="btn btn-danger"
           onclick="return confirm('Hapus semua riwayat?')">Hapus Semua</a>
      <?php endif; ?>
    </div>

    <div class="history">
      <?php if (empty($riwayat)): ?>
        <div class="history-empty">Belum ada riwayat pemesanan.</div>
      <?php else: ?>
        <?php foreach ($riwayat as $r): ?>
          <div class="history-item">
            <div>
              <h4><?= htmlspecialchars($r['layanan']) ?></h4>
              <div class="sub">
                <?= htmlspecialchars(date('d F Y', strtotime($r['tanggal']))) ?>
                &mdash; Sesi <?= htmlspecialchars($r['sesi']) ?>
              </div>
              <div class="sub" style="font-size:12px;color:#999">Kode: <?= htmlspecialchars($r['kode']) ?></div>
            </div>
            <div style="display:flex;align-items:center;gap:12px">
              <span class="price">Rp <?= number_format($r['total'], 0, ',', '.') ?></span>
              <a href="?hapus=<?= $r['id'] ?>" class="btn btn-danger"
                 onclick="return confirm('Hapus riwayat ini?')">Hapus</a>
            </div>
          </div>
        <?php endforeach; ?>
      <?php endif; ?>
    </div>

    <div class="row-actions" style="justify-content:flex-end;gap:12px">
      <a href="updateprofile.php" class="btn btn--primary"
         style="padding:10px 20px;font-size:14px">Ubah Profil</a>
      <a href="booking.php" class="btn btn--ghost"
         style="border:3px solid var(--line);border-radius:999px;padding:10px 20px;font-size:14px">Pesan Treatment Baru</a>
    </div>
  </div>
</div>
</body>
</html>
