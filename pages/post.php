<?php
include '../config.php';
include '../include/header.php';

// URL'den "id" parametresini al
if (isset($_GET['icerik_id'])) {
    $id = $_GET['icerik_id'];

    // Veritabanından ilgili içeriği seç
    $query = $db->prepare("SELECT * FROM blog_yazi WHERE icerik_id = :icerik_id");
    $query->bindParam(':icerik_id', $id);
    $query->execute();

    // İlgili içeriği al
    $icerik = $query->fetch(PDO::FETCH_ASSOC);

?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../assets/css/post.css?v=2">
        <link rel="stylesheet" href="../assets/css/header.css?v=2">
        <title>Blogla.com</title>
    </head>
    <?php
    if ($icerik) {
    ?>

        <body>
            <div class="post-card">

                <div class="post-header">
                    <h1><?php echo $icerik['baslik']; ?></h1>
                </div>

                <div class="post-bilgi">
                    <p class="card-text"> <small class="text-body-secondary">
                            <a class="yazaradi" href="kullanici_blog.php?yayinlayan_kullanici=<?php echo $icerik['yayinlayan_kullanici']; ?>">
                                @<?php echo $icerik['yazar']; ?> </a>
                            <span class="separator"></span> <?php echo $icerik['yayinlanma_tarihi']; ?>
                        </small>
                    </p>
                </div>

                <div class="post-images">
                    <img src="../assets/images/<?php echo $icerik['dosya']; ?>" alt="gorsel" width="70%" height="auto">
                </div>

                <div class="content">
                    <p> <?php echo $icerik['icerik']; ?> </p>

                </div>
            </div>
    <?php
    } else {
        echo "İçerik bulunamadı.";
    }
} else {
    echo "Geçersiz parametre.";
}
    ?>

        </body>

    </html>