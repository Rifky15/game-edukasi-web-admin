<?php
require 'config.php'; 

header("Content-Type: application/json");

if (!isset($_POST['nisn']) || !isset($_POST['id_soal']) || !isset($_POST['id_stage'])) {
    echo json_encode(["error" => "Parameter tidak lengkap"]);
    exit;
}

$nisn = $_POST['nisn'];
$id_soal = $_POST['id_soal'];
$id_stage = $_POST['id_stage'];

try {
    $stmt = $pdo->prepare("INSERT INTO jawaban_terpakai (nisn, id_soal, id_stage) VALUES (?, ?, ?)");
    $stmt->execute([$nisn, $id_soal, $id_stage]);

    echo json_encode(["success" => "Jawaban berhasil disimpan"]);
} catch (PDOException $e) {
    echo json_encode(["error" => "Database error: " . $e->getMessage()]);
}
?>
