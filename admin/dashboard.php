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

// Blog yazısı sayısını al
$query = "SELECT COUNT(*) AS blog_sayisi FROM blog_yazi";
$stmt = $db->query($query);
$result = $stmt->fetch(PDO::FETCH_ASSOC);

$blogSayisi = $result['blog_sayisi'];

// Kullanıcı sayısını al
$query = "SELECT COUNT(*) AS kullanici_sayisi FROM kullanici";
$stmt = $db->query($query);
$result = $stmt->fetch(PDO::FETCH_ASSOC);

$kullaniciSayisi = $result['kullanici_sayisi'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" integrity="sha512-t4GWSVZO1eC8BM339Xd7Uphw5s17a86tIZIj8qRxhnKub6WoyhnrxeCIMeAqBPgdZGlCcG2PrZjMc+Wr78+5Xg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>
<main role="main">
        
        <section class="panel important">
          <h2>Blogla.com</h2>
          <ul>
            <li>Hoşgeldiniz!</li>
          </ul>
        </section>
        
        <section class="panel important">
          <h2>İstatistikler</h2>
          <ul>
            <li>Yayımlanan Blog Sayısı <span class="badge text-bg-secondary bg-danger"> <?php echo $blogSayisi; ?></span></li>
            <li>Toplam Kullanıcı Sayısı <span class="badge text-bg-secondary bg-danger"> <?php echo $kullaniciSayisi; ?></span></li>
          </ul>
        </section>
        
        <a href="../index.php">
        <button type="button" style="width:150px;margin-top:40px;margin-left:27px;" class="btn btn-success">Siteyi Görüntüle</button>
        </a>
       
      </main> 

    
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js" integrity="sha512-VK2zcvntEufaimc+efOYi622VN5ZacdnufnmX7zIhCPmjhKnOi9ZDMtg1/ug5l183f19gG1/cBstPO4D8N/Img==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</body>

</html>
