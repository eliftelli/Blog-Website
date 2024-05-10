<?php
include '../config.php';
include '../include/header.php';

// Blog içeriklerini al
$query = $db->query("SELECT * FROM blog_yazi ORDER BY yayinlanma_tarihi DESC");
$icerikler = $query->fetchAll(PDO::FETCH_ASSOC);

if (isset($_GET['yayinlayan_kullanici'])) {
    $yazar_id = $_GET['yayinlayan_kullanici'];

    // Belirli yazar tarafından yazılan tüm blogları getirin
    $yazar_sorgusu = $db->prepare('SELECT * FROM blog_yazi WHERE yayinlayan_kullanici = ?');
    $yazar_sorgusu->execute([$yazar_id]);
    $yazar_icerikler = $yazar_sorgusu->fetchAll(PDO::FETCH_ASSOC);

    // Veritabanından kullanıcı profil bilgilerini getirin
    $yazar_sorgusu = $db->prepare('SELECT * FROM kullanici WHERE kullanici_id = ?');
    $yazar_sorgusu->execute([$yazar_id]);
    $yazar_bilgileri = $yazar_sorgusu->fetch(PDO::FETCH_ASSOC);

    // Kullanıcı veritabanında bulunmuyorsa
    if (!$yazar_bilgileri) {
        // Kullanıcı bulunamadığı durumu için işlem yapın
        die("Kullanıcı bulunamadı");
    }
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" integrity="sha512-t4GWSVZO1eC8BM339Xd7Uphw5s17a86tIZIj8qRxhnKub6WoyhnrxeCIMeAqBPgdZGlCcG2PrZjMc+Wr78+5Xg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../assets/css/header.css">
    <link rel="stylesheet" href="../assets/css/bloglarim.css?v=2">
</head>

<body>
    <div class="container text-center">
        <div class="row">
            <div class="col" id="profil_bilgi">
                <div class="card col-3 mt-5" style="width:400px; height:300px;">
                    <div class="card-body">
                        <div class="mb-3">
                            <div class="card profile-card-1">
                                <img src="https://images.pexels.com/photos/946351/pexels-photo-946351.jpeg?w=500&h=650&auto=compress&cs=tinysrgb" alt="profile-sample1" class="background" />
                                <img src="<?php echo isset($yazar_bilgileri['profil_foto']) ? $yazar_bilgileri['profil_foto'] : '../assets/images/profile.png'; ?>" alt="profile-image" class="profile" />
                                <div class="card-content">
                                    <h2><?php echo "" . $yazar_bilgileri['ad'] . "" ?> <?php echo "" . $yazar_bilgileri['soyad'] . "" ?><small>@<?php echo "" . $yazar_bilgileri['kullanici_adi'] . "" ?></small></h3>
                                        <div class="icon-block"><a href="https://www.facebook.com/"><i class="bi bi-facebook"></i></a><a href="https://www.twitter.com/"> <i class="bi bi-twitter"></i></a><a href="https://www.instagram.com/"> <i class="bi bi-instagram"></i></a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col">
                <div class="card col-5 mt-5" id="cardbaslik" style="width:400px; height:50px;">
                    <div class="card-body">
                        <h1>İçerikler</h1>
                    </div>
                </div>

                <div class="col" id="post">
                    <?php if (empty($icerikler)) : ?>
                        <p>Yayınlanmış blog gönderisi bulunamadı.</p>
                    <?php else : ?>
                        <?php foreach ($yazar_icerikler  as $icerik) : ?>
                            <div class="card mb-3 mt-4" style="max-width: 740px; height: 280px">
                                <div class="row g-0">
                                    <div class="col-md-5">
                                        <img src="../assets/images/<?php echo $icerik['dosya']; ?>" class="img-fluid rounded-start" alt="...">
                                    </div>
                                    <div class="col-md-7">
                                        <div class="card-body">
                                            <a href="post.php?icerik_id=<?php echo $icerik['icerik_id']; ?>">
                                                <h5 class="card-title"><?php echo $icerik['baslik']; ?></h5>
                                            </a>
                                            <p class="card-text" id="aciklama"><?php echo $icerik['aciklama']; ?></p>
                                            <p class="card-text" id="tarih"><small class="text-body-secondary"><?php echo $icerik['yayinlanma_tarihi']; ?></small></p>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>



        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js" integrity="sha512-VK2zcvntEufaimc+efOYi622VN5ZacdnufnmX7zIhCPmjhKnOi9ZDMtg1/ug5l183f19gG1/cBstPO4D8N/Img==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

</body>

</html>