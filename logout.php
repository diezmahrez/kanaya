<?php
session_start();
unset($_SESSION['id_admin']);
unset($_SESSION['nama_lengkap']);
echo "<script>alert('Anda Berhasil Log out'); window.location = 'login.php'</script>";