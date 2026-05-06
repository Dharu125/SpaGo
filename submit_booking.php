<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SpaGo — Booking berhasil</title>
    <link rel="stylesheet" href="styles.css" />
  </head>
  <header class="nav">
    <div class="container nav__inner">
      <a href="index.html" class="brand">SpaGo</a>
      <nav class="nav__links">
        <a href="layanan.html">Layanan</a>
        <a href="tentang.html">Tentang</a>
        <a href="booking.php">Booking</a>
        <a href="#contact">Kontak</a>
      </nav>
    </div>
  </header>
<body>
    <?php
        $name = $_POST['name'] ?? '';
        $phone = $_POST['phone'] ?? '';
        $service = $_POST['service'] ?? '';
        $date = $_POST['date'] ?? '';
        $time = $_POST['time'] ?? '';
        $address = $_POST['address'] ?? '';

        $harga = [
            'Aromatherapy Massage' => 300000,
            'Glow Facial' => 250000,
            'Body Scrub Ritual' => 350000,
            'Body Treatment' => 400000,
            'Facial Treatment' => 280000,
            'Reflexology' => 300000,
        ];
        $services = $_POST['service'] ?? []; // array
        $total = 0;

        // hitung total
        foreach ($services as $service) {
            if (isset($harga[$service])) {
                $total += $harga[$service];
            }
        }

        // Simpan data ke file (atau database)
        // $bookingData = "Nama: $name\nNomor WhatsApp: $phone\nLayanan: $service\nHarga: Rp $formattedPrice\nTanggal: $date\nJam: $time\nAlamat: $address\n\n";
        // file_put_contents('bookings.txt', $bookingData, FILE_APPEND);

        echo "<h1>Booking berhasil!</h1>";
        echo "<p>Terima kasih, " . htmlspecialchars($name) . ". Tim kami akan menghubungi Anda untuk konfirmasi dalam 1 jam.</p>";
        echo "<p>Total harga: Rp " . number_format($total, 0, ',', '.') . "</p>";

    ?>
</body>
</html>