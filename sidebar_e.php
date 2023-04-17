<?php
$kategori_list = 'SELECT
					kategori_edukasi.kategori,
					Count(edukasi.id_edukasi) AS jumlah,
					kategori_edukasi.id_kategori_e
					FROM
					edukasi
					INNER JOIN kategori_edukasi ON edukasi.id_kategori_e = kategori_edukasi.id_kategori_e
					GROUP BY
					kategori_edukasi.kategori,
					kategori_edukasi.id_kategori_e';
$list_kategori = $mysqli->query($kategori_list) or die($mysqli->error);

$terkini = 'SELECT
edukasi.id_edukasi,
edukasi.judul,
edukasi.gambar,
edukasi.tgl_posting,
edukasi.id_admin,
admin.nama_lengkap
FROM
edukasi
INNER JOIN admin ON edukasi.id_admin = admin.id_admin
ORDER BY
edukasi.tgl_posting DESC
LIMIT 0, 5
';

$populer = 'SELECT
edukasi.id_edukasi,
edukasi.judul,
edukasi.gambar,
edukasi.tgl_posting,
admin.nama_lengkap,
edukasi.id_admin,
edukasi.dilihat
FROM
edukasi
INNER JOIN admin ON edukasi.id_admin = admin.id_admin
ORDER BY
edukasi.dilihat DESC
LIMIT 0, 5
';

$list_terkini = $mysqli->query($terkini) or die ($mysqli->error);

$list_populer = $mysqli->query($populer) or die ($mysqli->error);
?>
					<div class="col-md-4 sidebar" style="background-color: white;box-shadow: 1px 1px 20px -5px;border-radius: 10px;">
						<div class="sidebar-item kategori">
							<h3 class="page-header">Kategori Edukasi</h5>
							<ul class="nav nav-pills nav-stacked nav-kat">
							<?php while ($data_kat = $list_kategori->fetch_array()) { ?>

							<?php if (isset($_GET['kat']) && $data_kat['id_kategori_e'] == $_GET['id'] ) { ?>
								<li class="active">
									<a href="<?php echo $base_url."kategori_e.php?id=".$data_kat['id_kategori_e']."&amp;kat=".strtolower($data_kat['kategori']); ?>">
									<?php echo $data_kat['kategori']; ?> <span class="badge pull-right"><?php echo $data_kat['jumlah'] ?></span></a>
								</li>
							<?php } else { ?>
								<li>
									<a href="<?php echo $base_url."kategori_e.php?id=".$data_kat['id_kategori_e']."&amp;kat=".strtolower($data_kat['kategori']); ?>">
									<?php echo $data_kat['kategori']; ?> <span class="badge pull-right"><?php echo $data_kat['jumlah'] ?></span></a>
								</li>
							<?php } ?>
							<?php } ?>
							</ul>
						</div>
						
					</div>