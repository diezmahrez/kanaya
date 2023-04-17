<?php include 'header.php';

//Jumlah Perhalaman
$limit = 5;
if(isset($_GET['p']))
{
    $noPage = $_GET['p'];
}
else $noPage = 1;

$offset = ($noPage - 1) * $limit;

//Mengambil data berita
$sqlIndex = "SELECT
berita.id_berita,
berita.judul,
berita.gambar,
berita.teks_berita,
berita.tgl_posting,
berita.dilihat,
admin.id_admin,
admin.nama_lengkap,
kategori.id_kategori,
kategori.kategori
FROM
admin
INNER JOIN berita ON admin.id_admin = berita.id_admin
INNER JOIN kategori ON kategori.id_kategori = berita.id_kategori
ORDER BY
berita.tgl_posting DESC
LIMIT ".$mysqli->real_escape_string($offset).",". $limit;

//data untuk dihitung
$sql_rec = "SELECT id_berita FROM berita";

$total_rec = $mysqli->query($sql_rec);

//Menghitung data yang diambil
$total_rec_num = $total_rec->num_rows;

$qryIndex = $mysqli->query($sqlIndex);

//Total semua data
$total_page = ceil($total_rec_num/$limit);
?>
<header>
        
      
  
        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
          <!-- Indicators -->
          <ol class="carousel-indicators">
      <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
      <li data-target="#carousel-example-generic" data-slide-to="1"></li>
      <li data-target="#carousel-example-generic" data-slide-to="2"></li>
      </ol>
      <!-- Wrapper for slides -->
          <div class="carousel-inner" role="listbox">
            <div class="item active">
              <img src="https://cdn.pixabay.com/photo/2017/06/02/12/14/temple-2366184_1280.jpg"  alt="...">
              <div class="carousel-caption">
                <h2 class="animated bounceInRight" style="animation-delay: 1s">
      Apa Itu Kanaya?</h2>
      <h3 class="animated bounceInLeft" style="animation-delay: 2s">
      Kanaya merupakan media edukasi berbasis web yang diciptakan untuk mempermudah teman teman untuk lebih mengenal budaya Indonesia</h3>
      </div>
      </div>
      <div class="item">
              <img src="https://cdn.pixabay.com/photo/2022/05/14/12/10/temple-7195534_1280.jpg" alt="...">
              <div class="carousel-caption">
                <h2 class="animated slideInDown" style="animation-delay: 1s">
      Mengapa harus Kanaya</h2>
      <h3 class="animated slideInRight" style="animation-delay: 2s">
      Dengan Kanaya teman teman mampu lebih mudah untuk mempelajari budaya Indonesia</h3>
      </div>
      </div>
      <div class="item">
              <img src="https://cdn.pixabay.com/photo/2017/05/21/09/25/woman-2330844_1280.jpg" alt="...">
              <div class="carousel-caption">
                <h2 class="animated zoomIn" style="animation-delay: 1s">
      Emang sumbernya Valid?</h2>
      <h3 class="animated zoomIn" style="animation-delay: 2s">
      Kami menyediakan berbagai macam informasi mengenai budaya Indonesia dari sabang sampai merauke dengan sumber yang valid dan terjamin.</h3>
      </div>
      </div>
      </div>
      <!-- Controls -->
          <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>
      </header>
    
    <div class="kategori" >
	  <div class="section-header" style="color: white;">
	  <div class="container">
	  </br>
                            <h2 class="section-title">Kategori Budaya di Indonesia</h2>
							<p>Kebudayaan yang ada di Indonesia sangatlah beragam dan istimewa, banyak kebudayaan yang dapat kita pelajari
								melalui website Kanaya ini. Ayo cari tahu beragam kebudayaan yang ada di Indonesia melalui kategori budaya dibawah ini.</p>
                        </div>
              
	  <div class="container">
							<div class="row">
						                            <div class="col-lg-4 col-md-4 col-sm-6">
													
                                <a href="kategori_e.php?id=4&kat=alat%20musik%20tradisional" class="s_integration_item">
                                    <img src="https://i.pinimg.com/originals/65/67/db/6567dbadeb12f4c8bd6f2a03c962fd66.jpg" width="119px;" alt="">
                                    <h5>Alat Musik Tradisional</h5>
                                </a>
                            </div>
						                            <div class="col-lg-4 col-md-4 col-sm-6">
                                <a href="kategori_e.php?id=5&kat=rumah adat" class="s_integration_item">
                                    <img src="https://i.fbcd.co/products/original/07e37e6dd975050dad927c64665a4806d301fe74887ccb0cb801e1245fa2e9d2.jpg" width="134px;" alt="">
                                    <h5>Rumah Adat</h5>
                                </a>
                            </div>
						                            <div class="col-lg-4 col-md-4 col-sm-6">
                                <a href="kategori_e.php?id=6&kat=upacara adat" class="s_integration_item">
                                    <img src="//jbbudaya.jogjabelajar.org/file/page/db0443c8a1b4201c74905d8cc6c63d07.png" width="25%;" alt="">
                                    <h5>Upacara Adat</h5>
                                </a>
                            </div>
						                            <div class="col-lg-4 col-md-4 col-sm-6">
                                <a href="kategori_e.php?id=7&kat=tari tradisional" class="s_integration_item">
                                    <img src="https://i.pinimg.com/564x/5b/7d/f9/5b7df9a36e9faf723e396992cc8d26a0.jpg" width="25%;" alt="">
                                    <h5>Tari Tradisional</h5>
                                </a>
                            </div>
						                            <div class="col-lg-4 col-md-4 col-sm-6">
                                <a href="kategori_e.php?id=8&kat=lagu daerah" class="s_integration_item">
                                    <img src="//jbbudaya.jogjabelajar.org/file/page/c21304c17074ab012d35e0d6ba5faebe.png" width="25%;" alt="">
                                    <h5>Lagu Daerah</h5>
                                </a>
                            </div>
						                            <div class="col-lg-4 col-md-4 col-sm-6">
                                <a href="kategori_e.php?id=9&kat=pakaian adat" class="s_integration_item">
                                    <img src="//jbbudaya.jogjabelajar.org/file/page/f3a5927a692c62e9bdf70975f697943d.png" width="25%;" alt="">
                                    <h5>Pakaian Adat</h5>
                                </a>
                            </div>
						                            <div class="col-lg-4 col-md-4 col-sm-6">
                                <a href="kategori_e.php?id=10&kat=bahasa daerah" class="s_integration_item">
                                    <img src="//jbbudaya.jogjabelajar.org/file/page/2361007172ec6f400a22f62b891b5849.png" width="25%;" alt="">
                                    <h5>Bahasa Daerah</h5>
                                </a>
                            </div>
						                            <div class="col-lg-4 col-md-4 col-sm-6">
                                <a href="kategori_e.php?id=11&kat=busana daerah" class="s_integration_item">
                                    <img src="//jbbudaya.jogjabelajar.org/file/page/42ca7b0bcf21c39c686a8d79decac9b8.png" width="25%;" alt="">
                                    <h5>Busana Daerah</h5>
                                </a>
                            </div>
						                            <div class="col-lg-4 col-md-4 col-sm-6">
                                <a href="kategori_e.php?id=12&kat=makanan daerah" class="s_integration_item">
                                    <img src="//jbbudaya.jogjabelajar.org/file/page/0df4fa1cf650dd4231b1f5e291ba983a.png" width="25%;" alt="">
                                    <h5>Makanan Daerah</h5>
                                </a>
                            </div>
						                            <div class="col-lg-4 col-md-4 col-sm-6">
                                <a href="kategori_e.php?id=13&kat=minuman daerah" class="s_integration_item">
                                    <img src="//jbbudaya.jogjabelajar.org/file/page/87198129c085c32c279c65afc8e5bae6.png" width="25%;" alt="">
                                    <h5>Minuman Daerah</h5>
                                </a>
                            </div>
						                            <div class="col-lg-4 col-md-4 col-sm-6">
                                <a href="kategori_e.php?id=14&kat=seni pertunjukan daerah" class="s_integration_item">
                                    <img src="//jbbudaya.jogjabelajar.org/file/page/3279dfc69429b9025786e3595c2e2e73.png" width="25%;" alt="">
                                    <h5>Seni Pertunjukan Daerah</h5>
                                </a>
                            </div>
						                        </div>
                                    </div>
                                    </div>
                                    </div>

<?php include 'tes.php';?>
</div>
</div>
</div>
</div>
</div>
</div>
<?php include 'footer.php';?>
<style>
.kategori {
    background-image: url("images/vector-megamendung-batik-gold-sketch-pattern.jpg");
    background-size: cover;
}
.section-header {
    padding-top: 50px;
    padding-bottom: 50px;
}
h5, .h5 {
    font-size: 15px;
    font-family: 'Poppins';
    font-weight: bold;
    color: #333;
}
.s_integration_item {
    background: #fff;
    -webkit-box-shadow: 0px 2px 7px 0px rgb(12 0 46 / 10%);
    box-shadow: 0px 2px 7px 0px rgb(12 0 46 / 10%);
    border-radius: 10px;
    text-align: center;
    display: block; 
    padding: 26px 0px;
    margin-bottom: 30px;
    -webkit-transition: all 0.2s linear;
    -o-transition: all 0.2s linear;
    transition: all 0.2s linear;
    z-index: 1;
    position: relative;
}
header .carousel-inner{
	width: 100%;
	min-height: fit-content;
}
header .carousel-inner .item{
  height: 100vh;
}
header .carousel-inner .item img{
  width: 100%;
}
.carousel-caption{
  padding-bottom: 160px;

}
.carousel-caption h2{
  font-size: 50px;
  font-weight: bold;
}
.carousel-caption h3{
  font-weight: bold;
}
.carousel-control.right{
  background-image: none;
}
.carousel-control.left{
  background-image: none;
}


</style>