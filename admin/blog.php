<?php
include "admin-panel.php";

// Veritabanına bağlantı bilgileri
$host = "localhost";
$dbname = "blog-db";
$username = "root";
$password = "";

try {
    // Veritabanına bağlan
    $db = new PDO("mysql:host=localhost;dbname=blog-db;charset=utf8", 'root', '');
} catch (PDOException $e) {
    die("Veritabanı hatası: " . $e->getMessage());
}


$blog_sorgusu = $db->query('SELECT * FROM blog_yazi');
$bloglar = $blog_sorgusu->fetchAll(PDO::FETCH_ASSOC);

if (isset($_GET['icerik_id'])) {
    $icerik_id = $_GET['icerik_id'];

    // Blog silme işlemi
    $sql = "DELETE FROM blog_yazi WHERE icerik_id = :id";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':id', $icerik_id, PDO::PARAM_INT);

    if ($stmt->execute()) {
        // Silme işlemi başarılı olduğunda, kullanıcıyı aynı sayfaya yönlendirin
        header("Location: blog.php");
        exit;
    } else {
        echo "Blog silinemedi.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" integrity="sha512-t4GWSVZO1eC8BM339Xd7Uphw5s17a86tIZIj8qRxhnKub6WoyhnrxeCIMeAqBPgdZGlCcG2PrZjMc+Wr78+5Xg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/blog.css">
</head>

<body>
    <h1>Bloglar</h1>
    <div class="row row-cols-1 row-cols-md-3 g-4">
        <?php foreach ($bloglar as $blog) : ?>
            <div class="col">
                <div class="card h-100">
                    <a href="../pages/post.php?icerik_id=<?php echo $blog['icerik_id']; ?>">
                        <img src="../assets/images/<?php echo $blog['dosya']; ?>" class="card-img-top" alt="...">
                    </a>
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $blog['baslik']; ?></h5>
                        <p class="card-text"><?php echo $blog['aciklama']; ?></p>
                        <p class="card-text" id="yazartarih"> <small class="text-body-secondary">
                                @<?php echo $blog['yazar']; ?>
                                <span class="separator"></span> <?php echo $blog['yayinlanma_tarihi']; ?>
                            </small>
                        </p>
                        <form method="GET">
                            <button type="button" class="btn btn-danger btn-sm" style="width: 60px;height:35px;float:right;" class="btn btn-danger" name="sil" id="sil" data-bs-toggle="modal" data-bs-target="#exampleModal" value="<?php echo $blog['icerik_id']; ?>">Sil</button>
                        </form>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog  modal-dialog-centered">
            <div class="modal-content" style="height: 240px;">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Gönderi Silme</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Gönderiyi silmek istediğinize emin misiniz? Bu işlem geri alınamaz, içerik kalıcı olarak kaybolacaktır.

                </div>
                <div class="modal-footer mt-3">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">İptal</button>
                    <button type="button" class="btn btn-danger" onclick="window.location.href='blog.php?icerik_id=<?php echo $blog['icerik_id']; ?>'">Sil</button>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js" integrity="sha512-VK2zcvntEufaimc+efOYi622VN5ZacdnufnmX7zIhCPmjhKnOi9ZDMtg1/ug5l183f19gG1/cBstPO4D8N/Img==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</body>

</html>