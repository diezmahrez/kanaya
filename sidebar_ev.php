<?php
$kategori_list = 'SELECT
					kategori_event.kategori,
					Count(event.id_event) AS jumlah,
					kategori_event.id_kategori_ev
					FROM
					event
					INNER JOIN kategori_event ON event.id_kategori_ev = kategori_event.id_kategori_ev
					GROUP BY
					kategori_event.kategori,
					kategori_event.id_kategori_ev';
$list_kategori = $mysqli->query($kategori_list) or die($mysqli->error);

$terkini = 'SELECT
event.id_event,
event.judul,
event.gambar,
event.tgl_posting,
event.id_admin,
admin.nama_lengkap
FROM
event
INNER JOIN admin ON event.id_admin = admin.id_admin
ORDER BY
event.tgl_posting DESC
LIMIT 0, 5
';

$populer = 'SELECT
event.id_event,
event.judul,
event.gambar,
event.tgl_posting,
admin.nama_lengkap,
event.id_admin,
event.dilihat
FROM
event
INNER JOIN admin ON event.id_admin = admin.id_admin
ORDER BY
event.dilihat DESC
LIMIT 0, 5
';

$list_terkini = $mysqli->query($terkini) or die ($mysqli->error);

$list_populer = $mysqli->query($populer) or die ($mysqli->error);
?>
					<div class="col-md-4 sidebar" style="box-shadow: 1px 1px 13px 0px;border-radius: 10px;padding: 2%;">
						<div class="sidebar-item kategori">
							<h3 class="page-header">Kategori Event</h5>
							<ul class="nav nav-pills nav-stacked nav-kat">
							<?php while ($data_kat = $list_kategori->fetch_array()) { ?>

							<?php if (isset($_GET['kat']) && $data_kat['id_kategori_ev'] == $_GET['id'] ) { ?>
								<li class="active">
									<a href="<?php echo $base_url."kategori_ev.php?id=".$data_kat['id_kategori_ev']."&amp;kat=".strtolower($data_kat['kategori']); ?>">
									<?php echo $data_kat['kategori']; ?> <span class="badge pull-right"><?php echo $data_kat['jumlah'] ?></span></a>
								</li>
							<?php } else { ?>
								<li>
									<a href="<?php echo $base_url."kategori_ev.php?id=".$data_kat['id_kategori_ev']."&amp;kat=".strtolower($data_kat['kategori']); ?>">
									<?php echo $data_kat['kategori']; ?> <span class="badge pull-right"><?php echo $data_kat['jumlah'] ?></span></a>
								</li>
							<?php } ?>
							<?php } ?>
							</ul>
						</div>
						
					</div>