<?php
include '../config.php';
include '../include/header.php';

// Kategori id
$kategori_id = $_GET['kategori_id'];

// Kategoriye ait blog içeriklerini çekme 
$sorgu = $db->prepare('SELECT * FROM blog_yazi WHERE kategori = ?');
$sorgu->execute([$kategori_id]);
$kategori_icerikler = $sorgu->fetchAll(PDO::FETCH_ASSOC);

// Veritabanından kategori adını çekme
$stmt = $db->prepare("SELECT kategori_ad FROM kategori WHERE kategori_id = :kategori_id");
$stmt->bindParam(':kategori_id', $kategori_id);
$stmt->execute();

if ($stmt->rowCount() > 0) {
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $kategori_ad = $row["kategori_ad"];
} else {
    $kategori_ad = "Kategori bulunamadı";
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" integrity="sha512-t4GWSVZO1eC8BM339Xd7Uphw5s17a86tIZIj8qRxhnKub6WoyhnrxeCIMeAqBPgdZGlCcG2PrZjMc+Wr78+5Xg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../assets/css/stil.css?v=6">
    <link rel="stylesheet" href="../assets/css/kategori.css?v=7">
    <link rel="stylesheet" href="../assets/css/header.css?v=10">
    <title>Blogla.com</title>

</head>

<body>

    <div class="container py-4">
    <div class="heading">
        <h1><?php echo $kategori_ad; ?></h1>
        </div>
        <div class="row row-cols-1 row-cols-md-3 g-4 ms-1">
            <?php foreach ($kategori_icerikler as $icerik) : ?>
                <div class="col">
                    <div class="card mb-2">
                        <a href="post.php?icerik_id=<?php echo $icerik['icerik_id']; ?>">
                            <img src="../assets/images/<?php echo $icerik['dosya']; ?>" class="card-img-top" alt="...">
                        </a>
                        <div class="card-body">
                            <a href="post.php?icerik_id=<?php echo $icerik['icerik_id']; ?>">
                                <h5 class="card-title"><?php echo $icerik['baslik']; ?></h5>
                            </a>
                            <a href="post.php?icerik_id=<?php echo $icerik['icerik_id']; ?>">
                                <p class="card-text"><?php echo $icerik['aciklama']; ?></p>
                            </a>
                            <p class="card-text" id="yazartarih"> <small class="text-body-secondary">
                                    <a class="yazaradi" href="kullanici_blog.php?yayinlayan_kullanici=<?php echo $icerik['yayinlayan_kullanici']; ?>">
                                        @<?php echo $icerik['yazar']; ?> </a>
                                    <span class="separator"></span> <?php echo $icerik['yayinlanma_tarihi']; ?>
                                </small>
                            </p>
                            <a href="post.php?icerik_id=<?php echo $icerik['icerik_id']; ?>" class="btn btn-secondary">Devamını Oku</a>
                        </div>
                    </div>
                </div>
            <?php endforeach;  ?>
        </div>


        <?php
        ob_end_flush();
        ?>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js" integrity="sha512-VK2zcvntEufaimc+efOYi622VN5ZacdnufnmX7zIhCPmjhKnOi9ZDMtg1/ug5l183f19gG1/cBstPO4D8N/Img==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

</body>

</html>