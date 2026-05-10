<?php
session_start();
if(!isset($_SESSION['user'])){ header('Location: login.php'); exit; }
$user = $_SESSION['user'];

// Demo riwayat (simpan di session agar bisa dihapus)
if(!isset($_SESSION['riwayat'])){
  $_SESSION['riwayat'] = [
    ['id'=>1,'nama'=>'Aromatherapy Massage','tanggal'=>'12 April 2026','durasi'=>'90 menit','harga'=>450000],
    ['id'=>2,'nama'=>'Body Scrub & Glow','tanggal'=>'02 April 2026','durasi'=>'60 menit','harga'=>320000],
    ['id'=>3,'nama'=>'Hot Stone Therapy','tanggal'=>'18 Maret 2026','durasi'=>'75 menit','harga'=>520000],
  ];
}

if(isset($_GET['hapus'])){
  $id = (int)$_GET['hapus'];
  $_SESSION['riwayat'] = array_values(array_filter($_SESSION['riwayat'],fn($r)=>$r['id']!==$id));
  header('Location: profil.php'); exit;
}
if(isset($_GET['hapus_semua'])){
  $_SESSION['riwayat'] = [];
  header('Location: profil.php'); exit;
}

$pageTitle='Profil'; $active='profil';
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
      <a href="logout.php" class="btn btn-ghost" style="border:1px solid var(--line);border-radius:999px;padding:10px 20px;font-size:14px">Keluar</a>
    </div>

    <div style="display:flex;justify-content:space-between;align-items:center">
      <h3 class="section-title">Riwayat Pemesanan</h3>
      <?php if(!empty($_SESSION['riwayat'])): ?>
        <a href="?hapus_semua=1" class="btn btn-danger" onclick="return confirm('Hapus semua riwayat?')">Hapus Semua</a>
      <?php endif; ?>
    </div>

    <div class="history">
      <?php if(empty($_SESSION['riwayat'])): ?>
        <div class="history-empty">Belum ada riwayat pemesanan.</div>
      <?php else: foreach($_SESSION['riwayat'] as $r): ?>
        <div class="history-item">
          <div>
            <h4><?= htmlspecialchars($r['nama']) ?></h4>
            <div class="sub"><?= htmlspecialchars($r['tanggal']) ?> · <?= htmlspecialchars($r['durasi']) ?></div>
          </div>
          <div style="display:flex;align-items:center">
            <span class="price">Rp <?= number_format($r['harga'],0,',','.') ?></span>
            <a href="?hapus=<?= $r['id'] ?>" class="btn btn-danger" onclick="return confirm('Hapus riwayat ini?')">Hapus</a>
          </div>
        </div>
      <?php endforeach; endif; ?>
    </div>

    <div class="row-actions" style="justify-content:flex-end">
      <a href="booking.php" class="btn btn--ghost" style="border:3px solid var(--line);border-radius:999px;padding:10px 20px;font-size:14px">Pesan Treatment Baru</a>
    </div>
  </div>
</div>
</body></html>
