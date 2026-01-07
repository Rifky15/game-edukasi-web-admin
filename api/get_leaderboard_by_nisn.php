<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
header('Content-Type: application/json; charset=utf-8');

require_once 'config.php'; // Pastikan file ini mengembalikan objek $pdo (PDO connection)

if (!isset($_GET['nisn'])) {
    echo json_encode(["error" => "Parameter 'nisn' tidak ditemukan."]);
    exit;
}

$nisn = $_GET['nisn'];

try {
    $stmt = $pdo->prepare("SELECT id_level, id_stage, skor, updated_at 
                           FROM leaderboard 
                           WHERE nisn = :nisn 
                           ORDER BY id_level, id_stage");
    $stmt->execute(['nisn' => $nisn]);
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($data, JSON_PRETTY_PRINT);
} catch (PDOException $e) {
    echo json_encode(["error" => $e->getMessage()]);
}
?>
