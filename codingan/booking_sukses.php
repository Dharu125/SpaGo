<?php
session_start();

// Ambil data dari POST
$nama = $_POST['name'] ?? 'Tamu SpaGo';
$services = $_POST['service'] ?? [];
$sesion = $_POST['sesion'] ?? '';
$date = $_POST['date'] ?? '';
$address = $_POST['address'] ?? '';
$phone = $_POST['phone'] ?? '';

// Mapping harga layanan
$servicePrices = [
    'Aromatherapy Massage' => 300000,
    'Glow Facial' => 250000,
    'Body Scrub Ritual' => 350000,
    'Body Treatment' => 400000,
    'Facial Treatment' => 280000,
    'Reflexology' => 300000,
];

// Hitung total harga berdasarkan layanan yang dipilih
$total = 0;
$selectedServices = [];
foreach ($services as $service) {
    if (isset($servicePrices[$service])) {
        $total += $servicePrices[$service];
        $selectedServices[] = $service;
    }
}

// Generate kode booking
$kode = 'SPG-' . strtoupper(substr(md5($nama . time()), 0, 6));

$pageTitle = 'Booking Berhasil';
$active = 'booking';
include 'header.php';
?>
<div class="container">
  <div class="card success-card" style="max-width:560px;margin:0 auto">
    <div class="success-mark">✓</div>
    <div class="eyebrow">Booking Dikonfirmasi</div>
    <h2 class="title" style="margin-top:10px">Terima kasih, <em style="font-style:italic;color:var(--gold)"><?= htmlspecialchars($nama) ?></em></h2>
    <p class="lead">Tim terapis kami akan tiba di rumah Anda sesuai jadwal. Bersantailah, kami yang urus sisanya.</p>
    <div class="summary">
      <div class="row"><span>Kode Booking</span><span><?= $kode ?></span></div>
      <div class="row"><span>Nama Pelanggan</span><span><?= htmlspecialchars($nama) ?></span></div>
      <div class="row"><span>Layanan yang Dipilih</span><span><?= htmlspecialchars(implode(', ', $selectedServices)) ?></span></div>
      <div class="row"><span>Total Pembayaran</span><span>Rp <?= number_format($total, 0, ',', '.') ?></span></div>
      <div class="row"><span>Sesi</span><span><?= htmlspecialchars($sesion) ?></span></div>
      <div class="row"><span>Tanggal</span><span><?= htmlspecialchars($date) ?></span></div>

    <div class="row-actions" style="justify-content:center">
      <a href="profil.php" class="btn btn-primary">Lihat di Profil</a>
      <a href="index.php" class="btn btn-ghost">Kembali ke Beranda</a>
    </div>
  </div>
</div>
</body></html>
