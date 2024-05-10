<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" integrity="sha512-t4GWSVZO1eC8BM339Xd7Uphw5s17a86tIZIj8qRxhnKub6WoyhnrxeCIMeAqBPgdZGlCcG2PrZjMc+Wr78+5Xg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../assets/css/login.css?v=8">
    <title>Blogla.com</title>
</head>

<body>
    <section class="login">
        <a href="../index.php" class="bi bi-arrow-left">Geri</a>

        <div class="tableOuter">
            <a href="login.php" class="active">Giriş Yap</a> <b></b>
            <a href="kayit-ol.php">Kayıt Ol</a>
            <form action="" method="post" class="form">
                <div class="user">
                    <input type="text" name="eposta" placeholder="E-posta">
                </div>
                <div class="pass">
                    <input type="password" name="sifre" placeholder="Şifre">
                </div>
                <button type="submit" class="sub" id="giris" name="giris_yap">Giriş Yap</button>
                <br>
            </form>


            <?php
            include '../config.php';

            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $eposta = $_POST['eposta'];
                $sifre = $_POST['sifre'];

                if (!$eposta || !$sifre) {
                    echo '<div class="alert alert-danger">Lütfen boş alan bırakmayınız.</div>';
                } else {
                    $hasspass = md5($sifre);
                    $user = $db->query("SELECT * FROM kullanici WHERE eposta = '{$eposta}' AND sifre = '{$hasspass}'")->fetch(PDO::FETCH_ASSOC);

                    if ($user) {
                        $_SESSION['user'] = $user;
            
                        if ($user['yetki'] == 1) { // Kullanıcı
                            header("Location: ../index.php");
                            exit;
                        } elseif ($user['yetki'] == 2) { // Yönetici 
                            header("Location: ../admin/dashboard.php");
                            exit;
                        }
                    } else {
                        echo '<div class="alert alert-danger">Bilgiler hatalı!</div>';
                    }
                }
            }
            ?>

        </div>
    </section>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js" integrity="sha512-VK2zcvntEufaimc+efOYi622VN5ZacdnufnmX7zIhCPmjhKnOi9ZDMtg1/ug5l183f19gG1/cBstPO4D8N/Img==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</body>

</html>