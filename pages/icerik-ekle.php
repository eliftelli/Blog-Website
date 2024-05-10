<?php
include '../config.php';
include '../include/header.php';

$kategoriler_sorgusu = $db->query('SELECT * FROM kategori');
$kategoriler = $kategoriler_sorgusu->fetchAll(PDO::FETCH_ASSOC);


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blogla.com</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" integrity="sha512-t4GWSVZO1eC8BM339Xd7Uphw5s17a86tIZIj8qRxhnKub6WoyhnrxeCIMeAqBPgdZGlCcG2PrZjMc+Wr78+5Xg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-lite.min.css" integrity="sha512-ZbehZMIlGA8CTIOtdE+M81uj3mrcgyrh6ZFeG33A4FHECakGrOsTPlPQ8ijjLkxgImrdmSVUHn1j+ApjodYZow==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../assets/css/header.css?v=8">
    <link rel="stylesheet" href="../assets/css/icerikekle.css?v=16">

</head>

<body>

    <div class="row">
        <div class="col-xs-6 col-md-3">
            <h5>Kategori</h5>
            <h6>İçerik kategorisi belirleyiniz.</h6>
            <form method="POST" action="icerik-ekle.php">
                <select class="form-select" name="kategori" aria-label="Default select example">
                    <option selected>Kategori seçiniz</option>
                    <?php foreach ($kategoriler as $kategori) : ?>
                        <option value="<?php echo $kategori['kategori_id']; ?>"><?php echo $kategori['kategori_ad']; ?></option>
                    <?php endforeach; ?>
                </select>

                <div class="mb-3">
                    <input class="form-control" type="file" name="dosya" id="formFile">
                </div>

                <div class="mb-3">
                    <button type="submit" class="sub" id="yayimla" name="icerikyayimla">Yayımla</button>
                </div>

                <?php
                $db = new PDO("mysql:host=localhost;dbname=blog;charset=utf8", "root", "");

                if (isset($_POST['icerikyayimla'])) {
                    $baslik = $_POST['baslik'];
                    $aciklama = $_POST['aciklama'];
                    $icerik = $_POST['icerik'];
                    $kategori = $_POST['kategori'];
                    $dosya = $_POST['dosya'];
                    $yayinlayan_kullanici = $_SESSION['user']['kullanici_id'];
                    $yazar = $_SESSION['user']['kullanici_adi'];

                    if (strlen($aciklama) > 245) {
                        echo '<div class="alert alert-danger h-50" role="alert" id="uyari">Hatalı giriş! Lütfen 245 karakter uzunluğunda bir açıklama giriniz.</div>';
                    } else {
                        if ($baslik != "" && $kategori != "" && $icerik != "" && $aciklama != "") {
                            $sorgu = $db->prepare('INSERT INTO blog_yazi (baslik, aciklama, icerik, kategori, dosya, yayinlayan_kullanici, yazar) 
                                            VALUES (?, ?, ?, ?, ?, ?, ?)');

                            $ekle = $sorgu->execute([$baslik, $aciklama, $icerik, $kategori, $dosya, $yayinlayan_kullanici, $yazar]);

                            if ($ekle) {
                                echo '<div class="alert alert-success" role="alert" id="uyari">Blog başarıyla yayımlandı.</div>';
                            } else {
                                $hata = $sorgu->errorInfo();
                                echo 'mysql hatası: ' . $hata[2];
                            }
                        } else {
                            echo '<div class="alert alert-danger" role="alert" id="uyari">Lütfen boş alan bırakmayın.</div>';
                        }
                    }
                }
                ?>
        </div>


        <div class="col-lg-8 col-md-3">
            <h3>Yeni içerik oluştur</h3>
            <hr />
            <h6>Kısa Açıklama</h6>
            <textarea class="form-control" id="floatingTextarea" name="aciklama" maxlength="245"></textarea>
            <h6> <small>Maksimum karakter sayısı: 245</small></h6>

            <input class="form-control form-control-lg" type="text" id="baslik" name="baslik" placeholder="İçerik başlığı" aria-label=".form-control-lg example">

            <textarea class="form-control" id="summernote" name="icerik"></textarea>

            </form>
        </div>


    </div>
    <script>
        setTimeout(function() {
            var uyariElement = document.getElementById("uyari");
            if (uyariElement) {
                uyariElement.style.display = "none";
            }
        }, 5000);
    </script>

    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js" integrity="sha512-VK2zcvntEufaimc+efOYi622VN5ZacdnufnmX7zIhCPmjhKnOi9ZDMtg1/ug5l183f19gG1/cBstPO4D8N/Img==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-lite.min.js" integrity="sha512-lVkQNgKabKsM1DA/qbhJRFQU8TuwkLF2vSN3iU/c7+iayKs08Y8GXqfFxxTZr1IcpMovXnf2N/ZZoMgmZep1YQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        $(document).ready(function() {
            $('#summernote').summernote({
                placeholder: 'İçerik',
                tabsize: 2,
                height: 400
            });
        });
    </script>

    <script>
        $('#formBlogEkle').on('submit', function(e) {
            e.preventDefault();

            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: 'post.php',
                data: $(this).serialize(),
                success: function(data) {
                    if (data.status === true) {
                        alert('İşlem başarılı')
                    }
                }
            });
        })
    </script>

</body>

</html>