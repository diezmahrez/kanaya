<?php include 'header.php'; ?>
<?php
$sql_edukasi = "SELECT event.gambar FROM event WHERE event.id_event='$_GET[id]'";

$qry_edukasi = $mysqli->query($sql_edukasi) or die ($mysqli->error);

$num = $qry_edukasi->num_rows;

$data = $qry_edukasi->fetch_assoc();
?>
<div class="container-fluid body">
	<div class="row">
		<div class="col-lg-2 sidebar">
			<?php include 'sidebar.php'; ?>
		</div>
		<div class="col-lg-10 main-content">
			<div class="panel panel-default">
				<div class="panel-body">
<?php
if ($num==0) {
	header('location:event.php');
} else {
	$del_sql = "DELETE FROM event WHERE event.id_event='$_GET[id]'";

	$del_qry = $mysqli->query($del_sql);

	if ($del_qry) {
		unlink('../images/'.$data['gambar']);
		echo "<meta http-equiv='refresh' content='0;url=event.php'>";
		echo "<h3 class='page-header'><i class='fa fa-refresh fa-spin'></i> Data berhasil dihapus</h3>";
	} else {
		echo $mysqli->error;
	}
}?>
				</div>
			</div>
		</div>
	</div>
</div>
<?php include 'footer.php'; ?>