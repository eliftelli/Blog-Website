<?php
include '../config.php';
include '../include/header.php';


if (isset($_GET['icerik_id'])) {
    $icerik_id = $_GET['icerik_id'];

    // Veritabanından mevcut içeriği almak için bir sorgu 
    $sorgu = $db->prepare('SELECT baslik, aciklama, icerik, kategori, dosya FROM blog_yazi WHERE icerik_id = ?');
    $sorgu->execute([$icerik_id]);
    $icerik = $sorgu->fetch(PDO::FETCH_ASSOC);

    if (!$icerik) {
        echo "İçerik bulunamadı.";
        exit;
    }
} else {
    echo "Geçersiz istek.";
    exit;
}

if (isset($_POST['icerikyayimla'])) {
    $baslik = $_POST['baslik'];
    $aciklama = $_POST['aciklama'];
    $icerik = $_POST['icerik'];
    $kategori = $_POST['kategori'];
    $dosya = $_POST['dosya'];
    $yayinlayan_kullanici = $_SESSION['user']['kullanici_id'];
    $yazar = $_SESSION['user']['kullanici_adi'];

    if ($baslik != "" && $kategori != "" && $icerik != "" && $aciklama != "") {
        // Veritabanında güncelleme yapmak için gerekli SQL sorgusunu oluşturuyoruz.
        $sorgu = $db->prepare('UPDATE blog_yazi SET baslik = ?, aciklama = ?, icerik = ?, kategori = ?, dosya = ?, yazar = ? WHERE icerik_id = ?');

        // Güncelleme işlemini yapacak olan execute komutunu çalıştırıyoruz.
        $guncelle = $sorgu->execute([$baslik, $aciklama, $icerik, $kategori, $dosya, $yazar, $icerik_id]);

        if ($guncelle) {
            
            // 2 saniye sonra başka bir sayfaya yönlendir
            header("Refresh:0.5; url=bloglarim.php");
            echo '<div class="alert alert-success" role="alert">Güncelleme başarıyla yapıldı.</div>';
            
            exit; // Çıkış yaparak diğer kodların çalışmasını engelle
        } else {
            $hata = $sorgu->errorInfo();
            echo '<div class="alert alert-danger" role="alert">Güncelleme hatası: ' . $hata[2] . '</div>';
        }
    } else {
        echo '<div class="alert alert-danger" role="alert" id="uyari">Lütfen boş alan bırakmayın.</div>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blogla.com</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" integrity="sha512-t4GWSVZO1eC8BM339Xd7Uphw5s17a86tIZIj8qRxhnKub6WoyhnrxeCIMeAqBPgdZGlCcG2PrZjMc+Wr78+5Xg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-lite.min.css" integrity="sha512-ZbehZMIlGA8CTIOtdE+M81uj3mrcgyrh6ZFeG33A4FHECakGrOsTPlPQ8ijjLkxgImrdmSVUHn1j+ApjodYZow==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../assets/css/header.css">
    <link rel="stylesheet" href="../assets/css/icerikekle.css">
</head>

<body>

    <div class="row">
        <div class="col-xs-6 col-md-3">
            <h5>Kategori</h5>
            <h6>İçerik kategorisi belirleyiniz.</h6>
            <form method="POST" action="blog-duzenle.php?icerik_id=<?php echo $icerik_id; ?>">
                <select class="form-select" name="kategori" aria-label="Default select example">
                    <option selected>Kategori seçiniz</option>
                    <option id="1" value="1" <?php if ($icerik['kategori'] == 1) echo 'selected'; ?>>Bilim</option>
                    <option id="2" value="2" <?php if ($icerik['kategori'] == 2) echo 'selected'; ?>>Teknoloji</option>
                    <option id="3" value="3" <?php if ($icerik['kategori'] == 3) echo 'selected'; ?>>Sanat</option>
                    <option id="4" value="4" <?php if ($icerik['kategori'] == 4) echo 'selected'; ?>>Müzik</option>
                    <option id="5" value="5" <?php if ($icerik['kategori'] == 5) echo 'selected'; ?>>Moda</option>
                    <option id="5" value="6" <?php if ($icerik['kategori'] == 6) echo 'selected'; ?>>Kişisel Gelişim</option>
                    <option id="7" value="7" <?php if ($icerik['kategori'] == 7) echo 'selected'; ?>>Seyahat</option>
                </select>

                <div class="mb-3">
                    <input class="form-control" type="file" name="dosya" id="formFile">
                </div>

                <div class="mb-3">
                    <button type="submit" class="sub" id="yayimla" name="icerikyayimla">Güncelle</button>
                </div>
            
        </div>

        <div class="col-lg-8 col-md-3">
            <h3>İçeriği Düzenle</h3>
            <hr />
            
                <h6>Kısa Açıklama</h6>
                <!-- Kısa Açıklama -->
                <textarea class="form-control" id="floatingTextarea" name="aciklama"><?php echo $icerik['aciklama']; ?></textarea>

                <!-- İçerik Başlığı -->
                <input class="form-control form-control-lg" type="text" id="baslik" name="baslik" placeholder="İçerik başlığı" aria-label=".form-control-lg example" value="<?php echo $icerik['baslik']; ?>">

                <!-- İçerik -->
                <textarea class="form-control" id="summernote" name="icerik"><?php echo $icerik['icerik']; ?></textarea>

            </form>
        </div>
    </div>

   
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