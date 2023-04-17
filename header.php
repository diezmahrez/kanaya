<?php

error_reporting(0);
require_once 'config/config.php';
require_once 'config/koneksi.php';
require_once 'lib/site_title.php';
require_once 'lib/redirect.php';
session_start();
	if (!isset($_SESSION['nama_lengkap'])) {
		header('location:login.php');
	}
$sqlHal = 'SELECT * FROM halaman';
$qryHal = $mysqli->query($sqlHal) or die($mysqli->error);

$sqlKat = 'SELECT
kategori.id_kategori,
kategori.kategori
FROM
kategori
INNER JOIN berita ON kategori.id_kategori = berita.id_kategori
GROUP BY
kategori.kategori
ORDER BY
kategori.id_kategori ASC
LIMIT 0, 12';
$qryKat = $mysqli->query($sqlKat) or die($mysqli->error);

$sqlBreaking = 'SELECT berita.id_berita, berita.judul FROM berita ORDER BY berita.tgl_posting DESC LIMIT 0, 5';
$qryBreaking = $mysqli->query($sqlBreaking);

$url = $_SERVER['REQUEST_URI'];
$explode_url = explode("/", $url);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title><?php echo site_title(); ?></title>
  <link rel="shortcut icon" href="assets/logo.png">
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="dist/css/hover-min.css">
  <link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="dist/css/style.css">
  <link rel="stylesheet" href="assets/wow/css/animate.css">
  <script src="<?php echo $base_url; ?>assets/jquery/jquery-1.12.0.min.js"></script>
</head>
<body style="background-color: #E5E5E5;">
    <div class="container">
		<nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container">

    <!-- Collect the nav links, forms, and other content for toggling -->
    			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1" style="font-weight: bold;">
              <ul class="nav navbar-nav headline-container">
              
                <p class="navbar-text ">Selamat datang, <?php echo $_SESSION['nama_lengkap']; ?></p>
                <li>
                    <li>
                    </li>
                  </ul>
                </li>
              </ul>
      				<ul class="nav navbar-nav navbar-right">
              <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false" id="search">
                  <svg style="width:24px;height:24px;margin-bottom: -8px" viewBox="0 0 24 24">
                      <path fill="currentColor" d="M9.5,3A6.5,6.5 0 0,1 16,9.5C16,11.11 15.41,12.59 14.44,13.73L14.71,14H15.5L20.5,19L19,20.5L14,15.5V14.71L13.73,14.44C12.59,15.41 11.11,16 9.5,16A6.5,6.5 0 0,1 3,9.5A6.5,6.5 0 0,1 9.5,3M9.5,5C7,5 5,7 5,9.5C5,12 7,14 9.5,14C12,14 14,12 14,9.5C14,7 12,5 9.5,5Z" />
                  </svg>
                  </a>
                  <ul class="dropdown-menu dropdown-search" style="background-color: #2780e3;">
                    <li>
                    <form action="search.php" class="navbar-form" role="search" method="GET">
                      <div class="form-group">
                        <input type="text" class="form-control" placeholder="Cari" name="q" id="search-form">
                      </div>
                    </form>
                    </li>
                  <li>
                  </li>
                </ul>
                </li>
              
              <?php if ($explode_url[2] == 'index.php' || $explode_url[2] == '') { ?>

                <li class="active"><a href="index.php">Beranda</a></li>

              <?php } else { ?>

                <li><a href="index.php">Beranda</a></li>

              <?php } ?>

              <?php
                while ($hal=$qryHal->fetch_array()) {
                  if ($hal['link'] == $explode_url[2]) {
              ?>
                <li class="active"><a href="<?php echo $base_url.$hal['link']; ?>"><?php echo $hal['nm_halaman']; ?></a></li>
              <?php
                  } else {
              ?>
                <li><a href="<?php echo $base_url.$hal['link']; ?>"><?php echo $hal['nm_halaman']; ?></a></li>
              <?php
                  }
              ?>
              <?php } ?>
              <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false" id="search">
                    Profile
                  </a>
                  <ul class="dropdown-menu dropdown-search">
                    <li>
                        <a href="profil.php">Edit Profile</a>
                    </li>
                  <li>
                    <a href="logout.php">Logout</a>
                  </li>
                </ul>
                </li>
    	  			</ul>
    			</div><!-- /.navbar-collapse -->
  			</div><!-- /.container-fluid -->
		</nav>
	</div>
		
		 
		  </nav>
		</div>
	</div>
</div>
              </body>
              </html>