<?php
include '../config.php';
include '../include/header.php';


$userid = $_SESSION['user']['kullanici_id'];
$blog = $db->prepare('SELECT * FROM blog_yazi WHERE yayinlayan_kullanici = ?');
$blog->execute([$userid]);
$icerikler = $blog->fetchAll(PDO::FETCH_ASSOC);

// Blog Sil
if (isset($_GET['icerik_id'])) {
    $icerik_id = $_GET['icerik_id'];

    $deleteUserQuery = "DELETE FROM blog_yazi WHERE icerik_id = :icerik_id";
    $stmt = $db->prepare($deleteUserQuery);
    $stmt->bindValue(':icerik_id', $icerik_id, PDO::PARAM_INT);
    $stmt->execute();

    header('Location: bloglarim.php');
    exit();
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
    <link rel="stylesheet" href="../assets/css/bloglarim.css">
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
                                <img src="<?php echo isset($_SESSION['user']['profil_foto']) ? $_SESSION['user']['profil_foto'] : 'profil_fotograflari/profile.png'; ?>" alt="profile-image" class="profile" />
                                <div class="card-content">
                                    <h2><?php echo "" . $_SESSION['user']['ad'] . "" ?> <?php echo "" . $_SESSION['user']['soyad'] . "" ?><small>@<?php echo "" . $_SESSION['user']['kullanici_adi'] . "" ?></small></h3>
                                        <div class="icon-block"><a href="https://www.facebook.com/"><i class="bi bi-facebook"></i></a><a href="https://www.twitter.com/"> <i class="bi bi-twitter"></i></a><a href="https://www.instagram.com/"> <i class="bi bi-instagram"></i></a></div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>



            <div class="col">
                <div class="card col-5 mt-5" id="cardbaslik" style="height:50px;">
                    <div class="card-body" id="icerik">
                        <h1>İçerikler</h1>
                    </div>
                </div>
                <!-- İçerik Kartları -->
                <div class="col" id="post">
                    <?php if (empty($icerikler)) : ?>
                        <p>Yayınlanmış blog gönderisi bulunamadı.</p>
                    <?php else : ?>
                        <?php foreach ($icerikler as $icerik) : ?>
                            <div class="card mb-3 mt-4" style="max-width: 740px; height: 280px">
                                <div class="row g-0">
                                    <div class="col-md-5">
                                        <img src="../assets/images/<?php echo $icerik['dosya']; ?>" class="img-fluid rounded-start" alt="...">
                                    </div>
                                    <div class="col-md-7">
                                        <div class="card-body">
                                            <a href="../pages/post.php?icerik_id=<?php echo $icerik['icerik_id']; ?>">
                                                <h5 class="card-title"><?php echo $icerik['baslik']; ?></h5>
                                            </a>
                                            <p class="card-text" id="aciklama"><?php echo $icerik['aciklama']; ?></p>
                                            <p class="card-text" id="tarih"><small class="text-body-secondary"><?php echo $icerik['yayinlanma_tarihi']; ?></small></p>
                                            <div class="buttons-container">
                                                <button type="button" class="btn btn-success btn-sm" id="duzenle" onclick="window.location.href='blog-duzenle.php?icerik_id=<?php echo $icerik['icerik_id']; ?>'">Düzenle</button>
                                                <button type="button" class="btn btn-danger btn-sm" name="sil" id="sil" data-bs-toggle="modal" data-bs-target="#exampleModal">Kaldır</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>

            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog  modal-dialog-centered">
                <div class="modal-content" style="height: 240px;">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Blog Silme</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Blog gönderinizi silmek istediğinize emin misiniz? Bu işlem geri alınamaz, içerik kalıcı olarak kaybolacaktır.

                    </div>
                    <div class="modal-footer mt-3">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">İptal</button>
                        <button type="button" class="btn btn-danger" onclick="window.location.href='bloglarim.php?icerik_id=<?php echo $icerik['icerik_id']; ?>'">Gönderiyi Sil</button>
                    </div>
                </div>
            </div>
        </div>


        <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.min.js" integrity="sha512-3dZ9wIrMMij8rOH7X3kLfXAzwtcHpuYpEgQg1OA4QAob1e81H8ntUQmQm3pBudqIoySO5j0tHN4ENzA6+n2r4w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js" integrity="sha512-VK2zcvntEufaimc+efOYi622VN5ZacdnufnmX7zIhCPmjhKnOi9ZDMtg1/ug5l183f19gG1/cBstPO4D8N/Img==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

</body>

</html>