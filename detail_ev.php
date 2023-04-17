<?php include 'header.php'; ?>
<?php if (!isset($_GET['id'])) redirect('404');?>
<?php
$sqlDetail = 'SELECT
event.judul,
event.gambar,
event.teks_event,
event.tgl_posting,
event.id_admin,
event.dilihat,
event.link,
event.tanggal,
event.lokasi,
admin.id_admin,
admin.nama_lengkap,
kategori_event.id_kategori_ev,
kategori_event.kategori
FROM
admin
INNER JOIN event ON admin.id_admin = event.id_admin
INNER JOIN kategori_event ON kategori_event.id_kategori_ev = event.id_kategori_ev
WHERE event.id_event = "'.$_GET['id'].'"';

$qryDetail = $mysqli->query($sqlDetail) or die("Error retreiving detail:".$mysqli->error);

$found = $qryDetail->num_rows;

if ($found > 0) {
	$detail = $qryDetail->fetch_assoc();

	$stat = $detail['dilihat']+1;
	$sqlStat = 'UPDATE event SET dilihat = "'.$stat.'" WHERE id_event = "'.$_GET['id'].'"';
	$qryStat = $mysqli->query($sqlStat) or die("Error menyimpan statistik: ".$mysqli->error);
} else {
	echo "<script>window.location = '404.php'</script>";
}

?>
<div class="container-fluid">
	<div class="row">
	</br>
	</br>
	</br>
	</br>
		<div class="container konten-wrapper">
			<div class="panel panel-default">
				<div class="panel-body main">
					<div class="col-md-8">
						<div class="post-detail" style="
    box-shadow: 0px 0px 16px 0px;
    border-radius: 10px;
">
							<div class="row post-title">
								<div class="col-sm-12">
									<h2 style="text-align:center;"><?php echo strtoupper($detail['judul']);?></h2>
								</div>
							</div>
							
							<div class="row post-content">
								<div class="col-sm-12">
									<div class="image wow fadeIn">
										<img src="<?php echo $base_url; ?>images/<?php echo $detail['gambar']; ?>">
										<h4 style="font-weight:bold;">Tanggal diselenggarakan, <?php echo $detail['tanggal'];?></h4>
									<h4 style="font-weight:bold;">Lokasi Event, <?php echo $detail['lokasi'];?></h4>
									<a class="btn " href="<?php echo $detail['link'];?>" target='_blank'>
										<h4 style="
										background: #6b437e;
										padding: 5px;
										border-radius: 10px;
										box-shadow: 1px 1px 14px 0px;
										font-weight: bold;
										color:white;
									">Link Pendaftaran</h4>
									</a>
									</div>
									<div class="text">
										<?php echo $detail['teks_event']; ?>
									</div>
								</div>
							</div>
						</div>
					</div>
					<?php include 'sidebar_ev.php'; ?>
				</div>
			</div>
		</div>
	</div>
</div>
<?php include 'footer.php';