<?php include 'header.php'; ?>
<?php if (!isset($_GET['id'])) redirect('404');?>
<?php
$sqlDetail = 'SELECT
edukasi.judul,
edukasi.gambar,
edukasi.teks_edukasi,
edukasi.tgl_posting,
edukasi.id_admin,
edukasi.dilihat,
admin.id_admin,
admin.nama_lengkap,
kategori_edukasi.id_kategori_e,
kategori_edukasi.kategori
FROM
admin
INNER JOIN edukasi ON admin.id_admin = edukasi.id_admin
INNER JOIN kategori_edukasi ON kategori_edukasi.id_kategori_e = edukasi.id_kategori_e
WHERE edukasi.id_edukasi = "'.$_GET['id'].'"';

$qryDetail = $mysqli->query($sqlDetail) or die("Error retreiving detail:".$mysqli->error);

$found = $qryDetail->num_rows;

if ($found > 0) {
	$detail = $qryDetail->fetch_assoc();

	$stat = $detail['dilihat']+1;
	$sqlStat = 'UPDATE edukasi SET dilihat = "'.$stat.'" WHERE id_edukasi = "'.$_GET['id'].'"';
	$qryStat = $mysqli->query($sqlStat) or die("Error menyimpan statistik: ".$mysqli->error);
} else {
	echo "<script>window.location = '404.php'</script>";
}

?>
</br>
</br>
<div class="container-fluid">
	<div class="row">
		<div class="container konten-wrapper">
			<div class="panel panel-default">
				<div class="panel-body main">
					<div class="col-md-8">
						<div class="post-detail" style="box-shadow: 1px 1px 10px 0px;border-radius: 10px;">
							<div class="row post-title">
								<div class="col-sm-12" style="text-align: center;padding-top: 5%;">
									<span><?php echo strtoupper($detail['judul']);?></span>
								</div>
							</div>
							
							<div class="row post-content">
								<div class="col-sm-12">
									<div class="image wow fadeIn">
										<img src="<?php echo $base_url; ?>images/<?php echo $detail['gambar']; ?>">
									</div>
									<div class="text">
										<?php echo $detail['teks_edukasi']; ?>
									</div>
								</div>
							</div>
						</div>
					</div>
					<?php include 'sidebar_e.php'; ?>
				</div>
			</div>
		</div>
	</div>
</div>
<?php include 'footer.php';