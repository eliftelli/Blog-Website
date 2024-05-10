<?php
session_start();
ob_start();


// Veritabanına bağlantı bilgileri
$host = "localhost";
$dbname = "blog-db";
$username = "root";
$password = "";

try {

  $db = new PDO("mysql:host=localhost;dbname=blog-db;charset=utf8", 'root', '');
} catch (PDOException $e) {
  die("Veritabanı hatası: " . $e->getMessage());
}

?>
