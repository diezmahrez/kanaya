<?php include 'header.php'; ?>
<?php
$limit = 5;
if(isset($_GET['p']))
{
    $noPage = $_GET['p'];
}
else $noPage = 1;

$offset = ($noPage - 1) * $limit;

$sql = "SELECT
edukasi.id_edukasi,
edukasi.judul,
admin.id_admin,
edukasi.gambar,
edukasi.tgl_posting,
admin.nama_lengkap,
kategori_edukasi.kategori
FROM
edukasi
INNER JOIN admin ON edukasi.id_admin = admin.id_admin
INNER JOIN kategori_edukasi ON kategori_edukasi.id_kategori_e = edukasi.id_kategori_e
ORDER BY edukasi.tgl_posting DESC
LIMIT ".$offset.",". $limit;
$qry = $mysqli->query($sql);

$sql_rec = "SELECT id_edukasi FROM edukasi";

$total_rec = $mysqli->query($sql_rec);

$total_rec_num = $total_rec->num_rows;

$total_page = ceil($total_rec_num/$limit);

?>
<div class="container-fluid body">
	<div class="row">
		<div class="col-lg-2 sidebar">
			<?php include 'sidebar.php'; ?>
		</div>
		<div class="col-lg-10 main-content">
			<div class="panel panel-default">
				<div class="panel-body">
					<div class="row">
						<div class="col-md-12">
							<h2 class="page-header"><i class="fa fa-newspaper-o"></i> Edukasi</h2>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<a href="tambah-edukasi.php" class="btn btn-sm btn-primary">
								<i class="fa fa-plus-circle"></i> Tambah Berita
							</a>
							<div class="clear"></div>
							<table class="table table-hover">
								<thead>
									<tr>
										<th width="30%">Judul</th>
										<th width="5%">Gambar</th>
										<th width="20%">Kategori</th>
										<th width="15%">Tgl. Posting</th>
										<th width="15%">Penulis</th>
										<th width="15%">Pilihan</th>
									</tr>
								</thead>
								<tbody>
								<?php while ($news_list = $qry->fetch_assoc()) { ?>
									<tr>
										<td><strong><?php echo $news_list['judul']; ?></strong></td>
										<td>
											<img src="../images/<?php echo $news_list['gambar']; ?>" height="75" width="75">
										</td>
										<td><?php echo $news_list['kategori']; ?></td>
										<td><?php echo $news_list['tgl_posting']; ?></td>
										<td><?php echo $news_list['nama_lengkap']; ?></td>
										<td align="center">
											<?php if ($news_list['id_admin'] == $_SESSION['id_admin'] or $_SESSION['level']=='admin') { ?>
											<a class="btn btn-sm btn-primary" target="_blank" href="<?php echo $base_url.'detail_e.php?id='.$news_list['id_edukasi']; ?>">
												<i class="fa fa-eye"></i>
											</a>
											<a href="edit-edukasi.php?id=<?=$news_list['id_edukasi']?>" class="btn btn-sm btn-success">
												<i class="fa fa-edit"></i>
											</a>
											<a onclick="return confirm('Anda Yakin Ingin Menghapus Data Ini?');" href="hapus-edukasi.php?id=<?=$news_list['id_edukasi']?>" class="btn btn-sm btn-danger">
												<i class="fa fa-trash"></i>
											</a>
											<?php } else { ?>
											<a class="btn btn-sm btn-primary" target="_blank" href="<?php echo $base_url.'detail_e.php?id='.$news_list['id_edukasi']; ?>">
												<i class="fa fa-eye"></i>
											</a>
											<?php } ?>
										</td>
									</tr>
								<?php } ?>
								</tbody>
							</table>
						</div>
						<div class="col-md-12">
							<ul class="pagination">
							<?php if ($noPage > 1) { ?>

								<li>
									<a href="<?php echo "edukasi.php?p=".($noPage-1);?>">
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
									<a href="<?php echo "edukasi.php?p=".($noPage+1); ?>">
										<i class="glyphicon glyphicon-chevron-right"></i>
									</a>
								</li>
							<?php } ?>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php include 'footer.php'; ?>