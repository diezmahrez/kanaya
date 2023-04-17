<?php

    mysql_connect("localhost","root","");
    mysql_select_db("db_kanaya");
    
    $cek_user=mysql_num_rows(mysql_query("SELECT * FROM admin WHERE username='$_POST[username]'"));
    if ($cek_user > 0) {
        echo '<script language="javascript">
              alert ("Username Sudah Ada Yang Menggunakan");
              window.location="login.php";
              </script>';
              exit();
    }
    else {
        mysql_query("INSERT INTO `admin` (`id_admin`, `username`, `password`, `nama_lengkap`, `foto`, `deskripsi`, `level`, `email`)
        VALUES (NULL, '$_POST[username]', MD5('$_POST[password]'), '$_POST[nama_lengkap]', '', '', '', '$_POST[email]')");
        
        echo '<script language="javascript">
              alert ("Registrasi Berhasil Di Lakukan!");
              window.location="login.php";
              </script>';
              exit();
    }

?>