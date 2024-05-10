<?php
$db = new PDO("mysql:host=localhost;dbname=blog-db;charset=utf8", "root", "");
$kategoriler_sorgusu = $db->query('SELECT * FROM kategori');
$kategoriler = $kategoriler_sorgusu->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" integrity="sha512-t4GWSVZO1eC8BM339Xd7Uphw5s17a86tIZIj8qRxhnKub6WoyhnrxeCIMeAqBPgdZGlCcG2PrZjMc+Wr78+5Xg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../assets/css/header.css?v=12">
</head>

<body>
    <?php include 'loading.php'; ?>
    <nav class="navbar sticky-top navbar-light bg-light" style="height: 100px;">
        <div class="container-fluid">
            <div class="ham-menu ms-5">
                <script src="https://cdn.lordicon.com/bhenfmcm.js"></script>
                <lord-icon class="icon" src="https://cdn.lordicon.com/svbmmyue.json" trigger="hover" colors="primary:#000000" style="width:60px;height:60px">

                    <button class="btn" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    </button>
                    <ul class="dropdown-menu mt-3 ms-5 p-3" style="height: 250px; width: 200px;">
                        <?php foreach ($kategoriler as $kategori) : ?>
                            <li>
                                <a href="/blog/pages/kategori.php?kategori_id=<?php echo $kategori['kategori_id']; ?>" class="dropdown-item">
                                    <?php echo $kategori['kategori_ad']; ?>
                                </a>

                            </li>
                        <?php endforeach; ?>
                    </ul>


                </lord-icon>
            </div>
            <a class="navbar-brand d-flex justify-content-center align-items-center" href="../index.php" style="position: absolute; left: 50%; transform: translateX(-50%);">
                <img src="/blog/assets/images/logo.png" alt="Logo" width="210" height="50">
            </a>


            <ul class="nav justify-content-end me-5">

                <?php
                $db = new PDO("mysql:host=localhost;dbname=blog-db;charset=utf8", "root", "");
                if (isset($_SESSION['user'])) {
                ?>
                    <div class="ekleicon">
                        <a href="/blog/pages/icerik-ekle.php">
                            <script src="https://cdn.lordicon.com/bhenfmcm.js"></script>
                            <lord-icon src="https://cdn.lordicon.com/mecwbjnp.json" trigger="hover" colors="primary:#121331,secondary:#2bd69d" style="width:70px;height:70px">
                            </lord-icon>
                        </a>
                    </div>
                    <li href="#" class="nav-item dropdown" role="button">
                        <a class="nav-link dropdown-toggle" id="hesapmenu" data-bs-toggle="dropdown" aria-expanded="false">
                            Hesabım
                        </a>
                        <p id="hesabim"><small>@<?php echo $_SESSION['user']['kullanici_adi']; ?></small></p>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" id="menu2" href="/blog/pages/profil.php">Profil Bilgilerim</a></li>
                            <li><a class="dropdown-item" id="menu2" href="/blog/pages/bloglarim.php">Bloglarım</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/blog/pages/logout.php" id="hesapmenu">Çıkış Yap</a>
                    </li>
                <?php
                } else {
                ?>
                    <li class="nav-item">
                        <a class="nav-link active" id="anamenu" aria-current="page" href="/blog/index.php">Ana Sayfa</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="anamenu" href="/blog/pages/login.php">Giriş</a>
                    </li>
                <?php
                }
                ?>
            </ul>
        </div>
    </nav>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.min.js" integrity="sha512-3dZ9wIrMMij8rOH7X3kLfXAzwtcHpuYpEgQg1OA4QAob1e81H8ntUQmQm3pBudqIoySO5j0tHN4ENzA6+n2r4w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js" integrity="sha512-VK2zcvntEufaimc+efOYi622VN5ZacdnufnmX7zIhCPmjhKnOi9ZDMtg1/ug5l183f19gG1/cBstPO4D8N/Img==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</body>

</html>