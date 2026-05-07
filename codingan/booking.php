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
        <form class="booking__form" action="booking_sukses.php" method="POST">
          <div class="field">
            <label for="name">Nama Lengkap</label>
            <input name="name" id="name" type="text" required placeholder="Nama Anda" />
          </div>
          <div class="field">
            <label for="phone">Nomor WhatsApp</label>
            <input name="phone" id="phone" type="tel" required placeholder="+62 ..." />
          </div>
            <div class="field">
              <label>Pilih Layanan</label>
              <div class="checkbox-group">
                <label>
                  <input type="checkbox" name="service[]" value="Aromatherapy Massage">
                  Aromatherapy Massage — Rp 300.000
                </label><br>
                <label>
                  <input type="checkbox" name="service[]" value="Glow Facial">
                  Glow Facial — Rp 250.000
                </label><br>
                <label>
                  <input type="checkbox" name="service[]" value="Body Scrub Ritual">
                  Body Scrub Ritual — Rp 350.000
                </label><br>
                <label>
                  <input type="checkbox" name="service[]" value="Body Treatment">
                  Body Treatment — Rp 400.000
                </label><br>
                <label>
                  <input type="checkbox" name="service[]" value="Facial Treatment">
                  Facial Treatment — Rp 280.000
                </label><br>
                <label>
                  <input type="checkbox" name="service[]" value="Reflexology">
                  Reflexology — Rp 300.000
                </label>
              </div>
            </div>
          <input type="hidden" name="price" id="price" value="0" />
          <div class="field-row">
            <div class="field">
              <label for="date">Tanggal</label>
              <input name="date" id="date" type="date" required />
            </div>
            <div class="field">
              <label for="sesion">pilih Sesi</label>
              <select name="sesion" id="sesion" required>
                <option value="">Pilih Sesi</option>
                <option value="09:00">09:00-12:00</option>
                <option value="10:00">12:00-15:00</option>
                <option value="11:00">15:00-18:00</option>
                <option value="14:00">18:00-21:00</option>
              </select>
            </div>
          </div>
          <div class="field">
            <label for="address">Alamat</label>
            <textarea
              name="address"
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