<?php
require_once "config.php";
header('Content-Type: application/json');

try {
    // Validasi parameter NISN
    if (empty($_GET['nisn'])) {
        echo json_encode([
            "status" => "error",
            "message" => "Parameter NISN tidak diberikan."
        ]);
        exit();
    }

    $nisn = $_GET['nisn'];

    // Ambil total skor dari semua level dan stage
    $queryTotalSkor = "SELECT SUM(skor) AS total_skor FROM leaderboard WHERE nisn = :nisn";
    $stmtTotal = $pdo->prepare($queryTotalSkor);
    $stmtTotal->execute([':nisn' => $nisn]);
    $totalSkor = (int)($stmtTotal->fetch(PDO::FETCH_ASSOC)['total_skor'] ?? 0);

    // Ambil level dan stage terakhir berdasarkan waktu update terbaru
    $queryLastProgress = "
        SELECT id_level, id_stage
        FROM leaderboard
        WHERE nisn = :nisn
        ORDER BY updated_at DESC
        LIMIT 1
    ";
    $stmtLast = $pdo->prepare($queryLastProgress);
    $stmtLast->execute([':nisn' => $nisn]);
    $lastProgress = $stmtLast->fetch(PDO::FETCH_ASSOC);

    // Ambil highest stage untuk tiap level
    $queryHighestStages = "
        SELECT id_level, MAX(id_stage) AS highest_stage
        FROM leaderboard
        WHERE nisn = :nisn
        GROUP BY id_level
    ";
    $stmtHighest = $pdo->prepare($queryHighestStages);
    $stmtHighest->execute([':nisn' => $nisn]);
    $highestStages = $stmtHighest->fetchAll(PDO::FETCH_ASSOC);

    // Format highest_stages ke bentuk key-value
    $highestStagesFormatted = new stdClass(); // Buat objek kosong
    foreach ($highestStages as $row) {
        $highestStagesFormatted->{$row['id_level']} = (int)$row['highest_stage'];
    }


    // Bangun response akhir
    $response = [
        "status" => "success",
        "id_level" => isset($lastProgress['id_level']) ? (int)$lastProgress['id_level'] : 1,
        "id_stage" => isset($lastProgress['id_stage']) ? (int)$lastProgress['id_stage'] : 1,
        "total_skor" => $totalSkor,
        "highest_stages" => $highestStagesFormatted
    ];

    echo json_encode($response);

} catch (PDOException $e) {
    echo json_encode([
        "status" => "error",
        "message" => "Terjadi kesalahan database: " . $e->getMessage()
    ]);
}
?>
