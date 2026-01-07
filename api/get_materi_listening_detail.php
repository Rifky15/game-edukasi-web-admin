<?php
include 'config.php'; // Pastikan file ini berisi konfigurasi koneksi database

header("Content-Type: application/json");

if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Pastikan ID berupa angka untuk keamanan
    
    try {
        $query = "SELECT * FROM datakosakata WHERE id_kosakata = :id";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($data) {
            echo json_encode($data);
        } else {
            echo json_encode(["error" => "Data tidak ditemukan untuk ID $id"]);
        }
    } catch (PDOException $e) {
        echo json_encode(["error" => "Gagal mengambil data: " . $e->getMessage()]);
    }
} else {
    echo json_encode(["error" => "ID tidak ditemukan"]);
}
?>