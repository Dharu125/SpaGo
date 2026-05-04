<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SpaGo - Booking</title>
    <link rel="stylesheet" href="styles.css" />
</head>
<body>
    <section id="booking" class="section">
      <div class="container booking">
        <div class="booking__intro">
          <p class="eyebrow">Booking</p>
          <h2>Pesan sesi Anda</h2>
          <p>
            Isi formulir di samping dan tim kami akan menghubungi Anda untuk
            konfirmasi dalam 1 jam.
          </p>
        </div>
        <form
          class="booking__form"
          onsubmit="
            event.preventDefault();
            alert('Terima kasih! Booking Anda telah diterima.');
          "
        >
          <div class="field">
            <label for="name">Nama Lengkap</label>
            <input id="name" type="text" required placeholder="Nama Anda" />
          </div>
          <div class="field">
            <label for="phone">Nomor WhatsApp</label>
            <input id="phone" type="tel" required placeholder="+62 ..." />
          </div>
          <div class="field">
            <label for="service">Pilih Layanan</label>
            <select id="service" required>
              <option value="">Pilih layanan...</option>
              <option>Aromatherapy Massage</option>
              <option>Glow Facial</option>
              <option>Body Scrub Ritual</option>
            </select>
          </div>
          <div class="field-row">
            <div class="field">
              <label for="date">Tanggal</label>
              <input id="date" type="date" required />
            </div>
            <div class="field">
              <label for="time">Jam</label>
              <input id="time" type="time" required />
            </div>
          </div>
          <div class="field">
            <label for="address">Alamat</label>
            <textarea
              id="address"
              rows="3"
              required
              placeholder="Alamat lengkap..."
            ></textarea>
          </div>
          <button type="submit" class="btn btn--primary btn--full">
            Kirim Booking
          </button>
        </form>
      </div>
    </section>
</body>
</html>