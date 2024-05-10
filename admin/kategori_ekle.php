<?php

include "admin-panel.php";

// Veritabanı bağlantısı 
$host = "localhost";
$dbname = "blog-db";
$username = "root";
$password = "";

try {
    $db = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
} catch (PDOException $e) {
    die("Veritabanı hatası: " . $e->getMessage());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Formdan gelen veriler
    $kategori_ad = $_POST['title']; 

    // Veritabanına yeni kategori ekleyin
    $sql = "INSERT INTO kategori (kategori_ad) VALUES (:kategori_ad)";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':kategori_ad', $kategori_ad, PDO::PARAM_STR);
 
    if ($stmt->execute()) {
        echo "Yeni kategori başarıyla eklendi.";
        header("Location: kategori_ekle.php");
        exit;
    
    } else {
        echo "Kategori eklenirken bir hata oluştu.";
    }
}
// Kategorileri veritabanından çek
$kategoriler_sorgusu = $db->query('SELECT * FROM kategori');
$kategoriler = $kategoriler_sorgusu->fetchAll(PDO::FETCH_ASSOC);


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kategori Ekle</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" integrity="sha512-t4GWSVZO1eC8BM339Xd7Uphw5s17a86tIZIj8qRxhnKub6WoyhnrxeCIMeAqBPgdZGlCcG2PrZjMc+Wr78+5Xg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="css/styles.css">
</head>

<body>
    <main role="main">
        <section class="panel important">
            <h2>Kategori Ekle</h2>
            <form action="kategori_ekle.php" method="POST">
                <div class="twothirds">
                    Kategori Adı:<br />
                    <input type="text" name="title" size="40" /><br /><br />
                </div>
                <div>
                    <button type="submit" style="width:80px;margin-top:40px;margin-left:10px;" class="btn btn-success">Ekle</button>
                </div>
            </form>
        </section>
    </main>

    <table>
    <thead>
        <tr>
            <th scope="col">Kategori Adı</th>
            <th scope="col">İşlemler</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($kategoriler as $kategori) : ?>
            <tr>
                <td><?php echo $kategori['kategori_ad']; ?></td>
                <td>
                    <button type="button" style="width: 80px;" class="btn btn-danger" onclick="window.location.href='kategori_sil.php?id=<?php echo $kategori['kategori_id']; ?>'">Sil</button>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js" integrity="sha512-VK2zcvntEufaimc+efOYi622VN5ZacdnufnmX7zIhCPmjhKnOi9ZDMtg1/ug5l183f19gG1/cBstPO4D8N/Img==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

</body>

</html>

