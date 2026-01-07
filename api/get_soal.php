<?php
require 'config.php'; // Pastikan file ini berisi koneksi PDO ke database

header("Content-Type: application/json");
// echo json_encode(["error" => "Tidak ada soal dalam database"]);
try {
    // Query untuk mengambil seluruh soal dari database
    $stmt = $pdo->query("SELECT * FROM `soal`");
    $soal = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Jika ada soal, kirim sebagai JSON
    if ($soal) {
        echo json_encode($soal);
    } else {
        echo json_encode(["error" => "Tidak ada soal dalam database"]);
    }
} catch (PDOException $e) {
    echo json_encode(["error" => "Database error: " . $e->getMessage()]);
}
?>
