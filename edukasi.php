<?php include 'header.php';

//Jumlah Perhalaman
$limit = 5;
if(isset($_GET['p']))
{
    $noPage = $_GET['p'];
}
else $noPage = 1;

$offset = ($noPage - 1) * $limit;

//Mengambil data edukasi
$sqlIndex = "SELECT
edukasi.id_edukasi,
edukasi.judul,
edukasi.gambar,
edukasi.teks_edukasi,
edukasi.tgl_posting,
edukasi.dilihat,
admin.id_admin,
admin.nama_lengkap,
kategori_edukasi.id_kategori_e,
kategori_edukasi.kategori
FROM
admin
INNER JOIN edukasi ON admin.id_admin = edukasi.id_admin
INNER JOIN kategori_edukasi ON kategori_edukasi.id_kategori_e = edukasi.id_kategori_e
ORDER BY
edukasi.tgl_posting DESC
LIMIT ".$mysqli->real_escape_string($offset).",". $limit;

//data untuk dihitung
$sql_rec = "SELECT id_edukasi FROM edukasi";

$total_rec = $mysqli->query($sql_rec);

//Menghitung data yang diambil
$total_rec_num = $total_rec->num_rows;

$qryIndex = $mysqli->query($sqlIndex);

//Total semua data
$total_page = ceil($total_rec_num/$limit);
?>
</br>
</br>
</br>
</br>
	<div class="row">
		<div class="container konten-wrapper">

			<?php include 'slider_e.php'; ?>
			</br>
			</br>
			<div class="panel panel-default"  >
				<div class="panel-body main">
					<div class="col-md-8">
					<?php while ($index = $qryIndex->fetch_array()) { ?>
						<div class="post" style="background-color: #2780e3;border-radius: 10px; box-shadow: 1px 1px 20px -5px" >
						
							
							<div class="row post-content">
								<div class="col-sm-12 excerpt" style="color: white;">
									<img src="<?php echo $base_url."images/".$index['gambar']; ?>" class="wow fadeIn">
									<a href="<?php echo $base_url."detail_e.php?id=".$index['id_edukasi']."&amp;judul=".strtolower(str_replace(" ", "-",$index['judul'])); ?>">
										<h2 style="color: white;"><?php echo $index['judul']; ?></h2>
									</a>
									<?php echo substr($index['teks_edukasi'], 0,200); ?>...
									<a style="color: white;" href="<?php echo $base_url."detail_e.php?id=".$index['id_edukasi']."&amp;judul=".
									strtolower(str_replace(' ', '-', $index['judul'])); ?>">
										Selengkapnya <i class="glyphicon glyphicon-chevron-right"></i>
									</a>
								</div>
							</div>
						</div>
						<?php } ?>
					</div>
					<?php include 'sidebar_e.php'; ?>
					<div class="col-md-12">
						<ul class="pagination">
						<?php if ($total_rec_num > $limit) { ?>
						<?php if ($noPage > 1 ) { ?>

							<li>
								<a href="<?php echo $base_url."edukasi.php?p=".($noPage-1);?>">
									<i class="glyphicon glyphicon-chevron-left"></i>
								</a>
							</li>

						<?php } ?>

						<?php for ($page=1; $page <= $total_page ; $page++) { ?>
							<?php if ((($page >= $noPage - 3) && ($page <= $noPage + 3)) || ($page == 1) || ($page == $total_page)) { ?>
								<?php
									$showPage = $page;
									if ($page==$total_page && $noPage <= $total_page-5) echo "<li class='active'><a>...</a></li>";
            						if ($page == $noPage) echo "<li class='active'><a href='#'>".$page."</a></li> ";
            						else echo " <li><a href='".$_SERVER['PHP_SELF']."?p=".$page."'>".$page."</a></li> ";
            						if ($page == 1 && $noPage >=6) echo "<li class='active'><a>...</a></li>";
								?>
							<?php } ?>
						<?php } ?>

						<?php if ($noPage < $total_page) { ?>
							<li>
								<a href="<?php echo $base_url."edukasi.php?p=".($noPage+1); ?>">
									<i class="glyphicon glyphicon-chevron-right"></i>
								</a>
							</li>
						<?php } ?>
						<?php } ?>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php include 'footer.php';