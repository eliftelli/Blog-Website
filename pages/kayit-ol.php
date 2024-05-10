<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" integrity="sha512-t4GWSVZO1eC8BM339Xd7Uphw5s17a86tIZIj8qRxhnKub6WoyhnrxeCIMeAqBPgdZGlCcG2PrZjMc+Wr78+5Xg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../assets/css/login.css?v=10">
    <title>Blogla.com</title>
</head>

<body>
    <section class="kayit">
        <a href="../index.php" class="bi bi-arrow-left">Geri</a>

        <div class="tableOuter2">
            <a href="login.php">Giriş Yap</a> <b></b>
            <a href="kayit-ol.php" class="active">Kayıt Ol</a>
            <form method="post" class="post">
                <div class="user">
                    <input type="text" name="ad" placeholder="Ad">
                </div>
                <div class="user">
                    <input type="text" name="soyad" placeholder="Soyad">
                </div>
                <div class="user">
                    <input type="email" name="eposta" placeholder="E-posta">
                </div>
                <div class="user">
                    <input type="text" name="kullanici_adi" placeholder="Kullanıcı Adı">
                </div>
                <div class="pass">
                    <input type="password" name="sifre" placeholder="Şifre">
                </div>
                <div class="list-group">
                    <li class="list-group-item">
                        <input class="form-check-input me-1" type="checkbox" name="onay" value="" id="sozlesmeCheckbox"><a data-bs-toggle="modal" data-bs-target="#exampleModal" href="#">Kullanıcı ve Gizlilik Sözleşmesi</a> 'ni kabul ediyorum.
                    </li>
                </div>

                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Kullanıcı ve Gizlilik Sözleşmesi</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p>Kullanıcı Sözleşmesi ("Sözleşme"), Blogla.com ("Hizmet Sağlayıcı") tarafından sunulan blog yazma hizmetini ("Hizmet") kullanan kişi veya kuruluş ("Kullanıcı") arasında yapılır. Bu Sözleşme, Hizmetin kullanımına ilişkin koşulları ve taraflar arasındaki hak ve sorumlulukları belirler.</p>

                                <p>1-Hizmetin Kullanımı: Kullanıcı, Blogla.com üzerinden sunulan Hizmeti yalnızca kişisel veya ticari olmayan amaçlarla kullanabilir. Kullanıcı, Hizmeti yasalara uygun şekilde kullanmalı ve diğer kullanıcıların haklarına saygı göstermelidir.</p>

                                <p>2-Hesap Oluşturma: Kullanıcı, Hizmeti kullanabilmek için bir hesap oluşturmalıdır. Hesap bilgileri doğru, güncel ve eksiksiz olmalıdır. Kullanıcı, hesap bilgilerini güvenli bir şekilde korumakla ve yetkisiz erişimlerden sorumlu olduğunu kabul eder.</p>

                                <p>3-İçerik Oluşturma: Kullanıcı, Hizmet üzerinden içerik oluşturabilir, düzenleyebilir ve paylaşabilir. Kullanıcı, içerik oluştururken yasaları ihlal etmemeli, başkalarının haklarını ihlal etmemeli ve toplum kurallarına uygun davranmalıdır.</p>

                                <p>4-Fikri Mülkiyet Hakları: Kullanıcı, Hizmet üzerinden oluşturulan içeriğin fikri mülkiyet haklarını korumakla ve başkalarının fikri mülkiyet haklarını ihlal etmemekle sorumludur. Kullanıcı, Hizmetin veya başka kullanıcıların fikri mülkiyet haklarına saygı göstermelidir.</p>

                                <p>5-Kullanıcı Sorumlulukları: Kullanıcı, Hizmeti kötüye kullanmamalı, diğer kullanıcıları taciz etmemeli, yanıltıcı bilgiler vermemeli ve Hizmetin işleyişine zarar verecek faaliyetlerde bulunmamalıdır. Kullanıcı, Hizmetin güvenliğini tehlikeye atacak veya sistemi aşırı yükleyecek herhangi bir eylemden kaçınmalıdır.</p>

                                <p>6-Hizmet Değişiklikleri ve Sonlandırma: Hizmet Sağlayıcı, Hizmeti herhangi bir zamanda değiştirme, askıya alma veya sonlandırma hakkını saklı tutar. Kullanıcı da Sözleşmeyi ihlal ettiği takdirde Hizmet Sağlayıcı, Kullanıcının hesabını askıya alma veya sonlandırma hakkını saklı tutar.</p>

                                <p>7-Sorumluluk Sınırlaması: Hizmet Sağlayıcı, Hizmetin kesintisiz veya hatasız çalışacağını garanti etmez. Kullanıcı, Hizmetin kullanımıyla ilgili risklerin tamamen kendisine ait olduğunu kabul eder. Hizmet Sağlayıcı, Kullanıcı tarafından oluşturulan içerikten sorumlu değildir.</p>

                                <p>8-Uyuşmazlıkların Çözümü: Bu Sözleşme Türk hukukuna tabidir. Taraflar arasında çıkabilecek uyuşmazlıkların çözümünde İstanbul Mahkemeleri ve İcra Daireleri yetkilidir.
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kapat</button>
                            </div>
                        </div>
                    </div>
                </div>
                <button type="submit" class="sub" id="giris" name="kullanicikaydet" onclick="return validateForm()">Kayıt Ol</button>
                <br>
            </form>


            <?php
            
            $db = new PDO("mysql:host=localhost;dbname=blog-db;charset=utf8", "root", "");

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $ad = $_POST['ad'];
                $soyad = $_POST['soyad'];
                $eposta = $_POST['eposta'];
                $kullanici_adi = $_POST['kullanici_adi'];
                $sifre = $_POST['sifre'];


                if (!$ad || !$soyad || !$eposta || !$kullanici_adi || !$sifre) {
                    echo '<div class="alert alert-danger">Lütfen boş alan bırakmayınız.</div>';
                } elseif (!isset($_POST['onay'])) {
                    echo '<div class="alert alert-danger" role="alert">Kullanıcı ve Gizlilik Sözleşmesini onaylamadınız.</div>';
                } else {
                    // E-posta ve kullanıcı adının veritabanında var olup olmadığını kontrol ediyoruz
                    $email_sorgusu = $db->prepare('SELECT * FROM kullanici WHERE eposta = ?');
                    $kullanici_adi_sorgusu = $db->prepare('SELECT * FROM kullanici WHERE kullanici_adi = ?');

                    $email_sorgusu->execute([$eposta]);
                    $kullanici_adi_sorgusu->execute([$kullanici_adi]);

                    // Eğer e-posta veya kullanıcı adı veritabanında varsa hata mesajı gösteriyoruz
                    if ($email_sorgusu->rowCount() > 0) {
                        echo '<div class="alert alert-danger">Bu e-posta adresi zaten kullanılıyor.</div>'; 
                    } elseif ($kullanici_adi_sorgusu->rowCount() > 0) {
                        echo '<div class="alert alert-danger">Bu kullanıcı adı zaten kullanılıyor.</div>';
                    } else {
                        // Veritabanına yeni kaydı ekliyoruz
                        $ekle = $db->prepare("INSERT INTO kullanici (ad, soyad, eposta, kullanici_adi, sifre) VALUES (?, ?, ?, ?, ?)");
                        if ($ekle->execute([$ad, $soyad, $eposta, $kullanici_adi, md5($sifre)])) {
                            $defaultProfilFoto = "../profil_fotograflari/profile.png";
                            $yetki = 1; // Admin yetkisi yok
                            $kullanici_id = $db->lastInsertId();

                            $sorgu = $db->prepare('UPDATE kullanici SET profil_foto = ?, yetki = ? WHERE kullanici_id = ?');
                            $guncelle = $sorgu->execute([$defaultProfilFoto, $yetki, $kullanici_id]);


                            if ($guncelle) {
                                echo '<div class="alert alert-success">Başarıyla kayıt olundu.</div>';
                            } else {
                                echo '<div class="alert alert-danger">Bir hata oluştu.</div>';
                            }
                        } else {
                            echo '<div class="alert alert-danger">Bir hata oluştu.</div>';
                        }
                    }
                }
            }
            ?>



        </div>
    </section>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.min.js" integrity="sha512-3dZ9wIrMMij8rOH7X3kLfXAzwtcHpuYpEgQg1OA4QAob1e81H8ntUQmQm3pBudqIoySO5j0tHN4ENzA6+n2r4w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js" integrity="sha512-VK2zcvntEufaimc+efOYi622VN5ZacdnufnmX7zIhCPmjhKnOi9ZDMtg1/ug5l183f19gG1/cBstPO4D8N/Img==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</body>

</html>