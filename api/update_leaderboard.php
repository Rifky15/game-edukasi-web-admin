<?php
require_once "config.php"; // Pastikan file ini sudah konek dengan $pdo (PDO)

header('Content-Type: application/json');

// Validasi: pastikan semua data POST yang dibutuhkan tersedia
if (!isset($_POST['nisn'], $_POST['id_level'], $_POST['id_stage'], $_POST['skor'])) {
    echo json_encode([
        "status" => "error",
        "message" => "Data POST tidak lengkap"
    ]);
    exit;
}

$nisn = $_POST['nisn'];
$id_level = $_POST['id_level'];
$id_stage = $_POST['id_stage'];
$skor = $_POST['skor'];


try {
    error_log("NISN diterima: " . $nisn);

    // Cek apakah data sudah ada untuk nisn, level, dan stage
    $cek = "SELECT * FROM leaderboard WHERE nisn = ? AND id_level = ? AND id_stage = ?";
    $stmt = $pdo->prepare($cek);
    $stmt->execute([$nisn, $id_level, $id_stage]);

    if ($stmt->rowCount() > 0) {
        // Update skor (misalnya: jika skor baru lebih tinggi, bisa tambahkan logika)
        $update = "UPDATE leaderboard SET skor = ?, updated_at = NOW() 
                   WHERE nisn = ? AND id_level = ? AND id_stage = ?";
        $stmt = $pdo->prepare($update);
        $success = $stmt->execute([$skor, $nisn, $id_level, $id_stage]);
    } else {
        // Insert skor baru
        $insert = "INSERT INTO leaderboard (nisn, id_level, id_stage, skor) 
                   VALUES (?, ?, ?, ?)";
        $stmt = $pdo->prepare($insert);
        $success = $stmt->execute([$nisn, $id_level, $id_stage, $skor]);
    }

    if ($success) {
        echo json_encode(["status" => "success"]);
    } else {
        echo json_encode(["status" => "failed"]);
    }

} catch (PDOException $e) {
    echo json_encode(["status" => "error", "message" => $e->getMessage()]);
}
?>
