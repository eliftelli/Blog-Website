<?php
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


if (isset($_GET['kullanici_id'])) {
    $kullanici_id = $_GET['kullanici_id'];

    // Kullanıcıyı silme işlemi
    $sql = "DELETE FROM kullanici WHERE kullanici_id = :id";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':id', $kullanici_id, PDO::PARAM_INT);

    if ($stmt->execute()) {
        echo "Kullanıcı başarıyla silindi.";
    } else {
        echo "Kullanıcı silinemedi.";
    }
}
$kullanici_sorgusu = $db->query('SELECT * FROM kullanici');
$userslist = $kullanici_sorgusu->fetchAll(PDO::FETCH_ASSOC);

include "admin-panel.php"
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kullanıcılar</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" integrity="sha512-t4GWSVZO1eC8BM339Xd7Uphw5s17a86tIZIj8qRxhnKub6WoyhnrxeCIMeAqBPgdZGlCcG2PrZjMc+Wr78+5Xg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/kullanicilar.css?v=2">
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>
    <h1>Kullanıcılar</h1>

    <table>
        <thead>
            <tr>
                <th scope="col"></th>
                <th scope="col">Ad</th>
                <th scope="col">Soyad</th>
                <th scope="col">Kullanıcı Adı</th>
                <th scope="col">E-posta</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($userslist as $user) : ?>
                <tr>
                    <td><img src="<?php echo $user['profil_foto']; ?>" class="img-fluid img-profile" alt="..."></td>
                    <td><?php echo $user['ad']; ?></td>
                    <td><?php echo $user['soyad']; ?></td>
                    <td><?php echo $user['kullanici_adi']; ?></td>
                    <td><?php echo $user['eposta']; ?></td>
                    <td>
                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal<?php echo $user['kullanici_id']; ?>">Kaldır</button>
                    </td>
                </tr>

                <!-- Modal -->
                <div class="modal fade" id="exampleModal<?php echo $user['kullanici_id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content" style="height: 240px;">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Kullanıcı Silme</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Kullanıcıyı silmek istediğinize emin misiniz? Bu işlem geri alınamaz.
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">İptal</button>
                                <a href="kullanicilar.php?kullanici_id=<?php echo $user['kullanici_id']; ?>" class="btn btn-danger">Sil</a>
                            </div>
                        </div>
                    </div>
                </div>

            <?php endforeach; ?>
        </tbody>
    </table>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js" integrity="sha512-VK2zcvntEufaimc+efOYi622VN5ZacdnufnmX7zIhCPmjhKnOi9ZDMtg1/ug5l183f19gG1/cBstPO4D8N/Img==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</body>

</html>
