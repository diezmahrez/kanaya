<?php include 'header.php';
if (!isset($_GET['id'])) redirect('404');
$limit = 5;
if(isset($_GET['p'])){
    $noPage = $mysqli->real_escape_string($_GET['p']);
}
else $noPage = 1;

$offset = ($noPage - 1) * $limit;

$sqlKategori = "SELECT kategori FROM kategori_event WHERE id_kategori_ev='".$mysqli->real_escape_string($_GET['id'])."'";

$qryKategori = $mysqli->query($sqlKategori);

$jumlah = $qryKategori->num_rows;

if ($jumlah > 0) {
	$kategori = $qryKategori->fetch_assoc();

	$sqlIndex = "SELECT
	event.id_event,
	event.judul,
	event.gambar,
	event.teks_event,
	event.tgl_posting,
	event.dilihat,
	event.lokasi,
	event.link,
	event.tanggal,
	admin.id_admin,
	admin.nama_lengkap,
	kategori_event.id_kategori_ev,
	kategori_event.kategori
	FROM
	admin
	INNER JOIN event ON admin.id_admin = event.id_admin
	INNER JOIN kategori_event ON kategori_event.id_kategori_ev = event.id_kategori_ev
	WHERE kategori_event.id_kategori_ev = '".$mysqli->real_escape_string($_GET['id'])."'
	ORDER BY
	event.tgl_posting DESC
	LIMIT ".$mysqli->real_escape_string($offset).",". $mysqli->real_escape_string($limit);

	$sql_rec = "SELECT id_event FROM event WHERE id_kategori_ev = '".$mysqli->real_escape_string($_GET['id'])."'";

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
							<div class="post" style="background-color: #e77f22;border-radius: 10px; box-shadow: 1px 1px 20px -5px;padding: 2%;" >
							
							
						<div class="row post-content">
								<div class="col-sm-12 excerpt" style="color: white; text-align:center;">
									<img src="<?php echo $base_url."images/".$post_kat ['gambar']; ?>" class="wow fadeIn" style="width: 40%;height: 174px;color:#343434;box-shadow: 0px 0px 14px 1px;">
									<a href="<?php echo $base_url."detail_ev.php?id=".$post_kat ['id_event']."&amp;judul=".strtolower(str_replace(" ", "-",$post_kat ['judul'])); ?>">
										<h3 style="color: white; font-weight:bold;"><?php echo $post_kat ['judul']; ?></h3>
									</a>
									<h4 style="color: white; font-weight:bold;">Tanggal diselenggarakan, <?php echo $post_kat ['tanggal'];?></h4>
									<h4 style="color: white; font-weight:bold;">Lokasi Event, <?php echo $post_kat ['lokasi'];?></h4>
									<a class="btn " href="<?php echo $post_kat ['link'];?>" target='_blank'>
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
							</div>
						</div>
						<?php } ?>
					</div>
					<?php include 'sidebar_ev.php'; ?>
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