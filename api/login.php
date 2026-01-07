<?php
require_once "config.php"; // Menggunakan koneksi dari config.php

// Ambil data dari Unity
$nisn = $_POST['nisn'] ?? '';
$pass = $_POST['password'] ?? '';

// Cek username (NISN) di database
$sql = "SELECT * FROM siswa WHERE nisn = :nisn";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(":nisn", $nisn, PDO::PARAM_STR);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($user) {
    // Bandingkan password langsung tanpa hash
    if ($pass === $user['password']) {
        echo json_encode(["status" => "success", "message" => "Login berhasil"]);
    } else {
        echo json_encode(["status" => "failed", "message" => "Password salah"]);
    }
} else {
    echo json_encode(["status" => "failed", "message" => "NISN tidak ditemukan"]);
}
?>
