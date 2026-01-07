# Web Admin Backend – Game Edukasi Susun Huruf & Kata

## Deskripsi
Repository ini berisi **backend logic dan database schema** untuk
Game Edukasi Susun Huruf & Kata Bahasa Inggris berbasis Unity.

Backend digunakan untuk:
- Autentikasi pengguna (siswa)
- Pengambilan soal (kosakata & frasa)
- Pengiriman jawaban dari game
- Manajemen progres belajar
- Leaderboard per level dan stage

Repository ini dibuat untuk **keperluan dokumentasi dan portofolio**.

---

## Peran Saya
- Backend Developer (PHP)
- Perancang Database (MySQL)
- Integrasi API dengan aplikasi Unity

---

## Teknologi
- PHP (PDO)
- MySQL / MariaDB
- REST API
- JSON

---

## Struktur Repository
game-edukasi-web-admin/
├── api/
│ ├── login.php
│ ├── get_soal.php
│ ├── kirim_jawaban.php
│ ├── get_progress.php
│ ├── get_leaderboard.php
│ └── update_leaderboard.php
├── database/
│ └── schema.sql
├── config.example.php
├── screenshots/
│ └── (akan ditambahkan)
├── .gitignore
└── README.md


## API Endpoint (Ringkasan)
| Endpoint | Fungsi |
|--------|-------|
| `login.php` | Autentikasi siswa |
| `get_soal.php` | Mengambil soal sesuai level & stage |
| `kirim_jawaban.php` | Mengirim jawaban dari game |
| `get_progress.php` | Mengambil progres belajar |
| `get_leaderboard.php` | Mengambil data leaderboard |
| `update_leaderboard.php` | Update skor leaderboard |


## Database Schema
File `schema.sql` **hanya berisi struktur tabel** (tanpa data),
meliputi:
- `siswa`
- `datakosakata`
- `datafrasa`
- `soal`
- `leaderboard`

Tidak ada data siswa, soal, maupun kredensial yang disertakan.


## Konfigurasi Database
Repository ini **tidak menyertakan file konfigurasi asli**.

Gunakan file berikut sebagai referensi:

config.example.php

File `config.php` asli **tidak di-commit** demi keamanan.


## Catatan Penting
- Tampilan web admin menggunakan **template pihak ketiga**
- File UI dan asset template **tidak disertakan** di repository ini
- Repository difokuskan pada **backend logic & database design**


## Keterkaitan Project
Aplikasi game (Unity) dapat dilihat di repository berikut:
👉 https://github.com/Rifky15/game-edukasi-susun-huruf-kata-bahasa-inggris.git



