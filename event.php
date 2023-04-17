<?php include 'header.php';

//Jumlah Perhalaman
$limit = 5;
if(isset($_GET['p']))
{
    $noPage = $_GET['p'];
}
else $noPage = 1;

$offset = ($noPage - 1) * $limit;

//Mengambil data event
$sqlIndex = "SELECT
event.id_event,
event.judul,
event.gambar,
event.teks_event,
event.tgl_posting,
event.dilihat,
event.tanggal,
event.link,
event.lokasi,
admin.id_admin,
admin.nama_lengkap,
kategori_event.id_kategori_ev,
kategori_event.kategori
FROM
admin
INNER JOIN event ON admin.id_admin = event.id_admin
INNER JOIN kategori_event ON kategori_event.id_kategori_ev = event.id_kategori_ev
ORDER BY
event.tgl_posting DESC
LIMIT ".$mysqli->real_escape_string($offset).",". $limit;

//data untuk dihitung
$sql_rec = "SELECT id_event FROM event";

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

			<?php include 'slider_ev.php'; ?>
			</br>
			</br>
			<div class="panel panel-default">
				<div class="panel-body main">
					<div class="col-md-8">
					<?php while ($index = $qryIndex->fetch_array()) { ?>
						<div class="post" style="background-color: #e77f22;border-radius: 10px; box-shadow: 1px 1px 20px -5px;padding: 2%;" >
							
							
						<div class="row post-content">
								<div class="col-sm-12 excerpt" style="color: white; text-align:center;">
									<img src="<?php echo $base_url."images/".$index['gambar']; ?>" class="wow fadeIn" style="width: 40%;height: 174px;color:#343434;box-shadow: 0px 0px 14px 1px;">
									<a href="<?php echo $base_url."detail_ev.php?id=".$index['id_event']."&amp;judul=".strtolower(str_replace(" ", "-",$index['judul'])); ?>">
										<h3 style="color: white; font-weight:bold;"><?php echo $index['judul']; ?></h3>
									</a>
									<h4 style="color: white; font-weight:bold;">Tanggal diselenggarakan, <?php echo $index['tanggal'];?></h4>
									<h4 style="color: white; font-weight:bold;">Lokasi Event, <?php echo $index['lokasi'];?></h4>
									<a class="btn " href="<?php echo $index['link'];?>" target='_blank'>
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
						<?php if ($total_rec_num > $limit) { ?>
						<?php if ($noPage > 1 ) { ?>

							<li>
								<a href="<?php echo $base_url."event.php?p=".($noPage-1);?>">
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
								<a href="<?php echo $base_url."event.php?p=".($noPage+1); ?>">
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