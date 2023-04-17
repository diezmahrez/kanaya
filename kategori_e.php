<?php include 'header.php';
if (!isset($_GET['id'])) redirect('404');
$limit = 5;
if(isset($_GET['p'])){
    $noPage = $mysqli->real_escape_string($_GET['p']);
}
else $noPage = 1;

$offset = ($noPage - 1) * $limit;

$sqlKategori = "SELECT kategori FROM kategori_edukasi WHERE id_kategori_e='".$mysqli->real_escape_string($_GET['id'])."'";

$qryKategori = $mysqli->query($sqlKategori);

$jumlah = $qryKategori->num_rows;

if ($jumlah > 0) {
	$kategori = $qryKategori->fetch_assoc();

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
	WHERE kategori_edukasi.id_kategori_e = '".$mysqli->real_escape_string($_GET['id'])."'
	ORDER BY
	edukasi.tgl_posting DESC
	LIMIT ".$mysqli->real_escape_string($offset).",". $mysqli->real_escape_string($limit);

	$sql_rec = "SELECT id_edukasi FROM edukasi WHERE id_kategori_e = '".$mysqli->real_escape_string($_GET['id'])."'";

	$total_rec = $mysqli->query($sql_rec);

	$total_rec_num = $total_rec->num_rows;

	$qryIndex = $mysqli->query($sqlIndex);

	$total_page = ceil($total_rec_num/$limit);
} else {
	echo "<script>window.location = '404.php'</script>";
}
?>
</br>
</br>
</br>
</br>
	<div class="row">
		<div class="container konten-wrapper">
			<div class="panel panel-default">
				<div class="panel-body main">
					<div class="col-md-8">
						<h1>Kategori <strong><?php echo $kategori['kategori']; ?></strong></h1>
						<?php while ($post_kat = $qryIndex->fetch_assoc()) { ?>
						<div class="post" style="background-color: #2780e3;border-radius: 10px; box-shadow: 1px 1px 20px -5px;padding: 2%;">
							<div class="row post-title">
								<div class="col-sm-12">
									<a href="<?php echo $base_url."detail_e.php?id=".$post_kat['id_edukasi']."&amp;judul=".strtolower(str_replace(" ", "-",$post_kat['judul'])); ?>">
										
									</a>
								</div>
							</div>
							
							<div class="row post-content" style="margin-bottom: 0px;">
								<div class="col-sm-12 excerpt" style="color: white;">
									<img src="<?php echo $base_url."images/".$post_kat['gambar']; ?>" class="wow fadeIn">
									<h2 style="color: white;" ><?php echo strtoupper($post_kat['judul']); ?></h2>
									<?php echo substr($post_kat['teks_edukasi'], 0,200); ?>...
									<a style="color: white;" href="<?php echo $base_url."detail_e.php?id=".$post_kat['id_edukasi']."&amp;judul=".
									strtolower(str_replace(' ', '-', $post_kat['judul'])); ?>">
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
						<?php if ($total_rec_num > $limit): ?>
						<?php if ($noPage > 1) { ?>
							<li>
								<a href="<?php echo $base_url."kategori.php?id=".$_GET['id']."&amp;p=".($noPage-1);?>">
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
            						else echo " <li><a href='".$_SERVER['PHP_SELF']."?id=".$_GET['id']."&amp;p=".$page."'>".$page."</a></li> ";
            						if ($page == 1 && $noPage >=6) echo "<li class='active'><a>...</a></li>";
								?>
							<?php } ?>
						<?php } ?>
						<?php if ($noPage < $total_page) { ?>
							<li>
								<a href="<?php echo $base_url."kategori.php?id=".$_GET['id']."&amp;p=".($noPage+1); ?>">
									<i class="glyphicon glyphicon-chevron-right"></i>
								</a>
							</li>
						<?php } ?>
						<?php endif ?>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php include 'footer.php'; ?>