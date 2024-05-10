<?php

// Veritabanı bağlantısı oluşturun
$host = "localhost";
$dbname = "blog-db";
$username = "root";
$password = "";

try {
    $db = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
} catch (PDOException $e) {
    die("Veritabanı hatası: " . $e->getMessage());
}

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $kategori_id = $_GET['id'];

    // Kategoriyi veritabanından silin
    $sql = "DELETE FROM kategori WHERE kategori_id = :kategori_id";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':kategori_id', $kategori_id, PDO::PARAM_INT);

    if ($stmt->execute()) {
        // Kategori başarıyla silindi, yönlendirme yapabilirsiniz
        header("Location: kategori_ekle.php"); // Kategori listesinin bulunduğu sayfaya yönlendirme
        exit();
    } else {
        echo "Kategori silinemedi.";
    }
}
?>
