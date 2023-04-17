<?php
session_start(); // Start session nya


$host = 'localhost'; // Nama hostnya
$username = 'root'; // Username
$password = ''; // Password (Isi jika menggunakan password)
$database = 'db_kanaya'; // Nama databasenya
// Koneksi ke MySQL dengan PDO
$pdo = new PDO('mysql:host='.$host.';dbname='.$database, $username, $password);
// Load file koneksi.php

$username = $_POST['username']; // Ambil value username yang dikirim dari form
$password = $_POST['password']; // Ambil value password yang dikirim dari form
$password = md5($password); // Kita enkripsi (encrypt) password tadi dengan md5

// Buat query untuk mengecek apakah ada data user dengan username dan password yang dikirim dari form
$sql = $pdo->prepare("SELECT * FROM admin WHERE username=:a AND password=:b");
$sql->bindParam(':a', $username);
$sql->bindParam(':b', $password);
$sql->execute(); // Eksekusi querynya

$data = $sql->fetch(); // Ambil datanya dari hasil query tadi

// Cek apakah variabel $data ada datanya atau tidak
if( ! empty($data)){ // Jika tidak sama dengan empty (kosong)
	$_SESSION['id_admin'] = $data['id_admin']; // Set session untuk username (simpan username di session)
  $_SESSION['nama_lengkap'] = $data['nama_lengkap']; // Set session untuk nama (simpan nama di session)
  
  setcookie("message","delete",time()-1); // Kita delete cookie message
  
  header("location: index.php"); // Kita redirect ke halaman welcome.php
}else{ // Jika $data nya kosong
  // Buat sebuah cookie untuk menampung data pesan kesalahan
  echo "<script>alert('Password yang anda masukan salah'); window.location = 'login.php'</script>"; //Redirect kembali ke halaman index.php
}
?>