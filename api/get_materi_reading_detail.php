<?php
include 'config.php';

header("Content-Type: application/json");

if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Pastikan ID berupa angka untuk keamanan
    
    try {
        $query = "SELECT * FROM datafrasa WHERE id_frasa = :i";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':i', $id, PDO::PARAM_INT);
        $stmt->execute();
        
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($data) {
            echo json_encode($data);
        } else {
            echo json_encode(["error" => "di id  $id Data tidak ditemukan"]);
        }
    } catch (PDOException $e) {
        echo json_encode(["error" => " $id Gagal mengambil data: " . $e->getMessage()]);
        echo $id;
    }
} else {
    echo json_encode(["error" => "ID tidak ditemukan"]);
}
?>
