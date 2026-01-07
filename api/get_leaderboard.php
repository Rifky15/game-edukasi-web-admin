<?php
require_once "config.php"; // Koneksi ke database

header('Content-Type: application/json');

try {
   $query = "SELECT l.nisn, s.nama, SUM(l.skor) AS total_skor 
          FROM leaderboard l 
          JOIN siswa s ON l.nisn = s.nisn 
          GROUP BY l.nisn 
          ORDER BY total_skor DESC 
          LIMIT 75";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    
    $leaderboardData = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode(["status" => "success", "data" => $leaderboardData]);
} catch (PDOException $e) {
    echo json_encode(["status" => "error", "message" => $e->getMessage()]);
}
?>