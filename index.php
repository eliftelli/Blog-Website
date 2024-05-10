<?php
include 'config.php';
include 'include/header.php';


function getIcerikById($icerik_id, $db)
{
  $sorgu = "SELECT * FROM blog_yazi WHERE icerik_id = $icerik_id";
  $sonuc = $db->query($sorgu);
  if ($sonuc) {
    $icerik = $sonuc->fetch(PDO::FETCH_ASSOC);
    if ($icerik) {
      echo '<div class="metin-overlay">';
      echo '<h5>' . $icerik['baslik'] . '</h5>';
      echo '<p>' . $icerik['aciklama'] . '</p>';
      echo '</div>';
    } else {
      echo '<h5>Başlık Yok</h5>';
      echo '<p>Açıklama Yok</p>';
    }
  } else {
    echo "Sorgu hatası: " . $db->errorInfo()[2];
  }
}


$query = "SELECT * FROM blog_yazi ORDER BY yayinlanma_tarihi DESC LIMIT 15";
$stmt = $db->query($query);

$stmt->execute();
$blogs = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Kullanıcı bloglarından slider için veri seçme
$query2 = "SELECT * FROM blog_yazi ORDER BY yayinlanma_tarihi DESC LIMIT 3"; // Örnek: Son 3 blogu seçiyoruz
$stmt = $db->query($query2);
$blog2 = $stmt->fetchAll(PDO::FETCH_ASSOC);


?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" integrity="sha512-t4GWSVZO1eC8BM339Xd7Uphw5s17a86tIZIj8qRxhnKub6WoyhnrxeCIMeAqBPgdZGlCcG2PrZjMc+Wr78+5Xg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="assets/css/stil.css?v=6">
  <link rel="stylesheet" href="assets/css/kategori.css?v=7">
  <link rel="stylesheet" href="assets/css/header.css?v=10">
  <link rel="stylesheet" href="assets/css/footer.css?v=1">
  <title>Blogla.com</title>

</head>

<body>

  <!-- slider -->
  <div class="container py-4">
    <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
      <div class="carousel-indicators">
        <?php foreach ($blog2 as $key => $blog) : ?>
          <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="<?php echo $key; ?>" class="<?php echo ($key === 0) ? 'active' : ''; ?>" aria-current="<?php echo ($key === 0) ? 'true' : 'false'; ?>" aria-label="Slide <?php echo $key + 1; ?>"></button>
        <?php endforeach; ?>
      </div>
      <div class="carousel-inner">
        <?php foreach ($blog2 as $key => $blog) : ?>
          <div class="carousel-item <?php echo ($key === 0) ? 'active' : ''; ?>">
            <a href="pages/post.php?icerik_id=<?php echo $blog['icerik_id']; ?>"><img src="assets/images/<?php echo $blog['dosya']; ?>" class="d-block w-100" alt="..."></a>
            <div class="carousel-caption d-none d-md-block">
              <h5><?php echo $blog['baslik']; ?></h5>
              <p><?php echo $blog['aciklama']; ?></p>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>

    
    <!-- Son Eklenenler -->

    <div class="heading mt-5">
      <h1>Son Eklenenler</h1>
    </div>
    <div class="row row-cols-1 row-cols-md-3 g-4">
      <?php foreach ($blogs as $blog) : ?>
        <div class="col">
          <div class="card ms-3">
            <a href="pages/post.php?icerik_id=<?php echo $blog['icerik_id']; ?>">
              <img src="assets/images/<?php echo $blog['dosya']; ?>" class="card-img-top" alt="...">
            </a>
            <div class="card-body">
              <a href="pages/post.php?icerik_id=<?php echo $blog['icerik_id']; ?>">
                <h5 class="card-title"><?php echo $blog['baslik']; ?></h5>
              </a>
              <a href="pages/post.php?icerik_id=<?php echo $blog['icerik_id']; ?>">
                <p class="card-text"><?php echo $blog['aciklama']; ?></p>
              </a>
              <p class="card-text" id="yazartarih"> <small class="text-body-secondary">
                  <a class="yazaradi" href="pages/kullanici_blog.php?yayinlayan_kullanici=<?php echo $blog['yayinlayan_kullanici']; ?>">
                    @<?php echo $blog['yazar']; ?> </a>
                  <span class="separator"></span> <?php echo $blog['yayinlanma_tarihi']; ?>
                </small>
              </p>
            </div>
          </div>
        </div>
      <?php endforeach;  ?>
    </div>


    <?php
    ob_end_flush();
    ?>

<footer>
<?php include 'include/footer.php'; ?>
</footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js" integrity="sha512-VK2zcvntEufaimc+efOYi622VN5ZacdnufnmX7zIhCPmjhKnOi9ZDMtg1/ug5l183f19gG1/cBstPO4D8N/Img==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

</body>

</html>