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
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../assets/css/footer.css?v=2">
</head>

<body>
    <footer>
        <div class="footer-container">
            <div class="footer-content">
                <div class="footer-section">
                    <h3>Kategoriler</h3>
                    <ul>
                    <?php foreach ($kategoriler as $kategori) : ?>
                            <li>
                                <a href="/blog/pages/kategori.php?kategori_id=<?php echo $kategori['kategori_id']; ?>" >
                                    <?php echo $kategori['kategori_ad']; ?>
                                </a>

                            </li>
                        <?php endforeach; ?>
                    </ul>

                </div>
                <div class="footer-section">
                    <h3>Bizi Takip Edin</h3>
                    <ul class="social-icons">
                        <li><a href="#"><i class="bi bi-facebook"></i></a></li>
                        <li><a href="#"><i class="bi bi-twitter"></i></a></li>
                        <li><a href="#"><i class="bi bi-instagram"></i></a></li>
                    </ul>
                </div>
                <div class="footer-section">
                    <h3>İletişim</h3>
                    <p><a href="mailto:info@example.com">info@example.com</a></p>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; 2023 Blogla.com Tüm hakları saklıdır. | <a href="#" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Gizlilik Politikası</a></p>
            </div>


            <!-- Modal -->
            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Gizlilik Politikası</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">


                            <p>Son güncelleme: 28.08.2023 </p>

                            <p> Bu gizlilik politikası, Blogla.com ("biz", "bizim" veya "sitemiz") tarafından işletilen https://blogla.com ("web sitemiz") için geçerlidir. Bu politika, web sitemizdeki bilgi toplama, kullanma ve ifşa uygulamalarımızı ve seçeneklerinizi açıklar.</p>

                            <h1> Kişisel Bilgilerin Toplanması ve Kullanılması</h1>

                            <p> Web sitemizi ziyaret ettiğinizde, belirli bilgileri otomatik olarak toplarız. Bu bilgiler şunları içerebilir:</p>

                            <p> Tarayıcı türü ve sürümü</p>
                            <p> İşletim sistemi</p>
                            <p> İnternet Protokolü (IP) adresi</p>
                            <p> İnternet Hizmet Sağlayıcısı (ISP)</p>
                            <p> Tarih ve saat bilgileri</p>
                            <p> Web sitemizi ziyaret edilen sayfalar </p>
                            <p> Bu bilgiler, web sitemizin geliştirilmesi, güncellenmesi ve daha iyi hizmet sunulması için kullanılır. </p>

                            <p> Web sitemizde belirli formları doldurduğunuzda veya bize doğrudan e-posta gönderdiğinizde kişisel bilgileri toplamamız istenebilir. Bu bilgiler, adınızı, e-posta adresinizi veya diğer kişisel tanımlayıcı bilgilerinizi içerebilir. Bu bilgiler yalnızca belirli amaçlar için kullanılır ve sizinle iletişim kurmak, hizmetlerimizi sağlamak ve gerektiğinde sizinle iletişime geçmek için kullanılır. </p>

                            <h1> Çerezler</h1>

                            <p> Web sitemiz, ziyaretçilerimize daha iyi bir deneyim sunmak için çerezleri (cookies) kullanabilir. Çerezler, web tarayıcınızın hard diskine yerleştirilen küçük metin dosyalarıdır. Bu dosyalar, web sitemizin sizi tanımasına ve tercihlerinizi hatırlamasına yardımcı olur. Çerezlerin nasıl kullanılacağını ve kontrol edileceğini belirlemek için tarayıcınızın ayarlarını değiştirebilirsiniz. </p>

                            <h1> Diğer Web Sitelerine Bağlantılar</h1>

                            <p> Web sitemiz, üçüncü taraf web sitelerine bağlantılar içerebilir. Bu bağlantılar, sizin için kullanışlı bilgilere veya hizmetlere erişim sağlayabilirler. Ancak, bu bağlantıları kullanırken diğer web sitelerinin gizlilik politikalarını kontrol etmelisiniz. Biz, diğer web sitelerinin içeriği veya uygulamaları üzerinde herhangi bir kontrol sahibi değiliz. </p>

                            <h1> Gizlilik Politikası Değişiklikleri</h1>

                            <p> Bu gizlilik politikasını zaman zaman güncelleme hakkımızı saklı tutarız. Herhangi bir değişiklik yaparsak, bu sayfada güncel bir sürümünü yayınlayacağız. Bu politika değişiklikleri, yayınlandığı tarihten itibaren geçerli olacaktır. </p>

                            <h1> İletişim Bilgileri</h1>

                            <p> Bu gizlilik politikası hakkında sorularınız veya endişeleriniz varsa, lütfen bize <a href="mailto:info@example.com">info@example.com</a> adresinden ulaşın. </p>


                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kapat</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</body>


</html>