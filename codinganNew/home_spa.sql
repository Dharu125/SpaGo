-- ============================================================
--  HOME SPA (SpaGo) — Database Schema + Sample Data
--  Import ke XAMPP: phpMyAdmin → Import → pilih file ini
-- ============================================================

-- Buat database
CREATE DATABASE IF NOT EXISTS `home_spa`
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;

USE `home_spa`;

-- ============================================================
-- Tabel: users
-- Menyimpan data akun pelanggan
-- ============================================================
CREATE TABLE IF NOT EXISTS `users` (
  `id`         INT UNSIGNED    NOT NULL AUTO_INCREMENT,
  `nama`       VARCHAR(100)    NOT NULL,
  `telepon`    VARCHAR(20)     NOT NULL,
  `password`   VARCHAR(255)    NOT NULL,  -- disimpan dengan password_hash()
  `created_at` DATETIME        NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_telepon` (`telepon`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================================
-- Tabel: bookings
-- Menyimpan riwayat pemesanan layanan spa
-- ============================================================
CREATE TABLE IF NOT EXISTS `bookings` (
  `id`         INT UNSIGNED    NOT NULL AUTO_INCREMENT,
  `user_id`    INT UNSIGNED    NOT NULL,
  `kode`       VARCHAR(20)     NOT NULL,
  `nama`       VARCHAR(100)    NOT NULL,
  `phone`      VARCHAR(20)     NOT NULL,
  `layanan`    TEXT            NOT NULL,  -- layanan yang dipilih (dipisah koma)
  `tanggal`    DATE            NOT NULL,
  `sesi`       VARCHAR(20)     NOT NULL,
  `alamat`     TEXT            NOT NULL,
  `total`      INT UNSIGNED    NOT NULL DEFAULT 0,
  `created_at` DATETIME        NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_kode` (`kode`),
  CONSTRAINT `fk_booking_user`
    FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
    ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================================
-- Contoh data user (password: "password123")
-- Hash dibuat dengan: password_hash('password123', PASSWORD_DEFAULT)
-- ============================================================
INSERT INTO `users` (`nama`, `telepon`, `password`) VALUES
('Anindya Putri',   '081234567890', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'),
('Budi Santoso',    '082345678901', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'),
('Citra Dewi',      '083456789012', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi');

-- ============================================================
-- Contoh data booking
-- ============================================================
INSERT INTO `bookings` (`user_id`, `kode`, `nama`, `phone`, `layanan`, `tanggal`, `sesi`, `alamat`, `total`) VALUES
(1, 'SPG-A1B2C3', 'Anindya Putri', '081234567890', 'Aromatherapy Massage', '2026-04-12', '09:00', 'Jl. Melati No. 10, Semarang', 300000),
(1, 'SPG-D4E5F6', 'Anindya Putri', '081234567890', 'Body Scrub Ritual,Glow Facial', '2026-04-02', '12:00', 'Jl. Melati No. 10, Semarang', 600000),
(2, 'SPG-G7H8I9', 'Budi Santoso',  '082345678901', 'Reflexology', '2026-03-18', '15:00', 'Jl. Kenanga No. 5, Semarang', 300000);
