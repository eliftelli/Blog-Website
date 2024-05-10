<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include '../config.php';

// Kullanıcı oturum açmışsa ve yetki seviyesi 1 ise izin ver
if (isset($_SESSION['user']) && $_SESSION['user']['yetki'] == 1) {
    include '../include/header.php';
} else {
    // Yetki seviyesi 1 değilse erişim engellendi veya başka bir sayfaya yönlendirilebilir.
?>
    <header role="banner">
        <a href="../admin/dashboard.php">
            <h1>Admin Panel</h1>
        </a>
        <ul class="utilities">
            <br>
            <li class="users"><a href="/blog/pages/profil.php">Profilim</a></li>
            <li class="logout warn"><a href="/blog/pages/logout.php">Çıkış Yap</a></li>
        </ul>
    </header>
<?php }


if (isset($_POST['kaydet'])) {
    $ad = $_POST['ad'];
    $soyad = $_POST['soyad'];
    $eposta = $_POST['eposta'];
    $kullanici_adi = $_POST['kullanici_adi'];

    $userid = $_SESSION['user']['kullanici_id'];

    $updateQuery = "UPDATE kullanici SET ad = :ad, soyad = :soyad, eposta = :eposta, kullanici_adi = :kullanici_adi WHERE kullanici_id = :userid";
    $stmt = $db->prepare($updateQuery);

    $stmt->bindValue(':ad', $ad);
    $stmt->bindValue(':soyad', $soyad);
    $stmt->bindValue(':eposta', $eposta);
    $stmt->bindValue(':kullanici_adi', $kullanici_adi);
    $stmt->bindValue(':userid', $userid);

    if ($stmt->execute()) {
        // verileri güncelle
        $_SESSION['user']['ad'] = $ad;
        $_SESSION['user']['soyad'] = $soyad;
        $_SESSION['user']['eposta'] = $eposta;
        $_SESSION['user']['kullanici_adi'] = $kullanici_adi;

        // yönlendirme öncesi profil fotoğrafını güncelle

        if (isset($_FILES['profile-pic-input']) && $_FILES['profile-pic-input']['error'] === 0) {
            $profilFoto = $_FILES['profile-pic-input']['name'];
            $profilFoto_yolu = $_FILES['profile-pic-input']['tmp_name'];
            $yeniFotoYolu = "../profil_fotograflari/" . $profilFoto;


            move_uploaded_file($profilFoto_yolu, $yeniFotoYolu);
        } else {
            $yeniFotoYolu = $_SESSION['user']['profil_foto'];
        }

        $sorgu = $db->prepare('UPDATE kullanici SET profil_foto = ? WHERE kullanici_id = ?');
        $guncelle = $sorgu->execute([$yeniFotoYolu, $userid]);

        if ($guncelle) {
            $_SESSION['user']['profil_foto'] = $yeniFotoYolu;
            header("Location: profil.php?kullanici_id=$kullanici_id");
            exit;
        } else {
            $hata = $sorgu->errorInfo();
            echo '<div class="alert alert-danger" role="alert">MySQL hatası: ' . $hata[2] . '</div>';
        }

        header('Location: profil.php');
        exit();
    } else {
        // Hata 
        $error = $stmt->errorInfo();
        echo 'mysql hatası: ' . $error[2];
    }
}

//Şifre değiştir

if (isset($_POST['sifre_degistir'])) {
    $yeni_sifre = md5($_POST['yeni_sifre']);
    $yeni_sifre_tekrar = md5($_POST['yeni_sifre_tekrar']);
    $mevcut_sifre = md5($_POST['sifre']);

    $userid = $_SESSION['user']['kullanici_id'];

    // Mevcut şifreyi doğrulama
    $getPasswordQuery = "SELECT sifre FROM kullanici WHERE kullanici_id = :userid";
    $stmt = $db->prepare($getPasswordQuery);
    $stmt->bindValue(':userid', $userid);
    $stmt->execute();
    $hashed_mevcut_sifre = $stmt->fetchColumn();

    if ($mevcut_sifre != $hashed_mevcut_sifre) {
        echo '<div class="alert alert-danger">Mevcut şifre yanlış!</div>';
        exit();
    }

    // kontrol et
    if ($yeni_sifre != $yeni_sifre_tekrar) {
        echo '<div class="alert alert-danger">Yeni şifreler uyuşmuyor!</div>';
        exit();
    }
    $hashed_yeni_sifre = $yeni_sifre; // Şifreyi hash'leyerek güvenli bir şekilde kaydet

    $updateQuery = "UPDATE kullanici SET sifre = :sifre WHERE kullanici_id = :userid";
    $stmt = $db->prepare($updateQuery);

    $stmt->bindValue(':sifre', $hashed_yeni_sifre);
    $stmt->bindValue(':userid', $userid);

    if ($stmt->execute()) {
        echo '<div class="alert alert-success">Şifreniz başarıyla güncellendi!</div>';
    } else {
        $error = $stmt->errorInfo();
        echo 'mysql hatası: ' . $error[2];
    }
}

//Hesap Sil

if (isset($_POST['hesap_sil'])) {

    $userid = $_SESSION['user']['kullanici_id'];

    //Kullanıcıyı sil
    $deleteUserQuery = "DELETE FROM kullanici WHERE kullanici_id = :userid";
    $stmt = $db->prepare($deleteUserQuery);
    $stmt->bindValue(':userid', $userid);
    $stmt->execute();

    session_destroy(); // Oturumu sonlandır

    // Hesap silme işlemi başarılıysa
    echo '<div class="alert alert-success">Hesabınız siliniyor!</div>';
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blogla.com</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" integrity="sha512-t4GWSVZO1eC8BM339Xd7Uphw5s17a86tIZIj8qRxhnKub6WoyhnrxeCIMeAqBPgdZGlCcG2PrZjMc+Wr78+5Xg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../assets/css/header.css?v=9">
    <link rel="stylesheet" href="../assets/css/profil.css?v=17">
    <link rel="stylesheet" href="../assets/css/styles.css">

</head>

<body>
    <?php if ($_SESSION['user']['yetki'] == 2) : ?>

        <div class="container">
            <div class="middle-container py-5" style="margin-top: 20px;">
            <?php endif; ?>

            <div class="container">
                <div class="middle-container py-5">
                    <form method="post" action="profil.php" enctype="multipart/form-data">

                        <div class="row">
                            <div class="col-12">

                                <div class="row mb-5">
                                    <div class="col-12">
                                        <div class="d-flex flex-column align-items-center justify-content-center">
                                            <div class="mb-3">
                                                <img src="<?php echo isset($_SESSION['user']['profil_foto']) ? $_SESSION['user']['profil_foto'] : 'profil_fotograflari/profile.png'; ?>" class="img-fluid user-profile-img" alt="Profil Resmi" width="150" height="150">
                                            </div>
                                            <div>
                                                <button type="button" class="btn btn-primary btn-sm" id="change-profile-pic">Profil resmini güncelle</button>
                                                <input type="file" id="profile-pic-input" name="profile-pic-input" style="display: none;">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-4 g-4">
                                    <div class="col-md-6">
                                        <label for="ad" class="form-label">Adınız</label>
                                        <input type="text" class="form-control" id="ad" name="ad" value="<?php echo "" . $_SESSION['user']['ad'] . "" ?>">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="soyad" class="form-label">Soyadınız</label>
                                        <input type="text" class="form-control" id="soyad" name="soyad" value="<?php echo "" . $_SESSION['user']['soyad'] . "" ?>">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="email" class="form-label">E-Posta Adresiniz</label>
                                        <input type="text" class="form-control" id="email" name="eposta" value="<?php echo "" . $_SESSION['user']['eposta'] . "" ?>">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="kullanici_adi" class="form-label">Kullanıcı Adınız</label>
                                        <input type="text" class="form-control" id="kullanici_adi" name="kullanici_adi" value="<?php echo "" . $_SESSION['user']['kullanici_adi'] . "" ?>">
                                    </div>
                                </div>

                                <div class="row mb-5">
                                    <div class="col-md-12">
                                        <button type="submit" class="sub" name="kaydet">Kaydet</button>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <button class="btn" id="degistir" style="color: rgb(84, 84, 251)" type="button" data-bs-toggle="modal" data-bs-target="#sifreModal">
                                            Şifremi değiştirmek istiyorum.
                                        </button>
                                    </div>

                                    <div class="col-md-6">
                                        <button type="button" class="btn btn-primary " id="sil" style="color: rgb(251, 47, 47);" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                            Hesabımı silmek istiyorum.
                                        </button>
                                    </div>
                                </div>



                            </div>
                        </div>

                    </form>

                </div>

                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Hesap Silme</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Hesabınızı silmeniz durumunda tüm içerikleriniz ve profiliniz sistemden silinecektir. Üyeliğinizi sonlandırmak istediğinize emin misiniz?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">İptal</button>

                                <form method="post" action="profil.php">
                                    <button type="submit" name="hesap_sil" class="btn btn-danger">Hesabımı Sil</button>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>


                <!-- Modal 2 -->
                <form method="post" action="profil.php">
                    <div class="modal fade modal-lg" id="sifreModal" tabindex="-1" aria-labelledby="sifreModalLabel" aria-hidden="true">
                        <div class="modal-dialog  modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="sifreModalLabel">Hesap Silme</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row g-3" id="sifreExample">
                                        <div class="col-md-4">
                                            <input type="password" class="form-control" id="sifre" name="sifre" placeholder="Mevcut Şifre">
                                        </div>
                                        <div class="col-md-4">
                                            <input type="password" class="form-control" id="yeni_sifre" name="yeni_sifre" placeholder="Yeni Şifre">
                                        </div>
                                        <div class="col-md-4">
                                            <input type="password" class="form-control" id="yeni_sifre_tekrar" name="yeni_sifre_tekrar" placeholder="Yeni Şifre Tekrar">
                                        </div>

                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">İptal</button>

                                    <button type="submit" name="sifre_degistir" class="btn btn-danger">Kaydet</button>

                                </div>
                            </div>
                        </div>
                    </div>
                </form>

                <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.min.js" integrity="sha512-3dZ9wIrMMij8rOH7X3kLfXAzwtcHpuYpEgQg1OA4QAob1e81H8ntUQmQm3pBudqIoySO5j0tHN4ENzA6+n2r4w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js" integrity="sha512-VK2zcvntEufaimc+efOYi622VN5ZacdnufnmX7zIhCPmjhKnOi9ZDMtg1/ug5l183f19gG1/cBstPO4D8N/Img==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
                <script src="../assets/js/script.js"></script>
</body>

</html>