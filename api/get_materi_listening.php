<?php
require_once "config.php"; // Koneksi database dengan PDO

$sql = "SELECT * FROM datakosakata ORDER BY id_kosakata ASC";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$materi = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Kirim data dalam format JSON
echo json_encode($materi);
?>
