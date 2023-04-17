<?php include 'header.php';
$sql_kat = "SELECT
kategori_edukasi.kategori
FROM
kategori_edukasi
WHERE
kategori_edukasi.id_kategori_e='$_GET[id]'";

$qry_kat = $mysqli->query($sql_kat) or die ($mysqli->error);


$data = $qry_kat->fetch_assoc();
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
$var_kategori = isset($_POST['kategori']) ? $_POST['kategori']:$data['kategori'];
if (isset($_POST['btn_edit'])) {
	$message=array();

    
    $kategori = $_POST['kategori'];

    if (count($message)==0) {
    	$insert_sql = "UPDATE kategori_edukasi SET kategori = '$kategori' WHERE id_kategori_e = '$_GET[id]'";
    	$insert_qry = $mysqli->query($insert_sql) or die ($mysqli->error);

    	echo "<script>alert('Data Berhasil Diperbarui'); window.location = 'kategori_edukasi.php'</script>";
    }

    if (!count($message)==0) {
    	$num=0;
    	foreach ($message as $index => $show_message) {
    		$num++;
?>
		<div class="alert alert-danger alert-dismissable fade in">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <?php
                echo $show_message;
            ?>
        </div>
<?php
    	}
    }
}
?>
					<div class="row">
						<div class="col-md-12">
							<h2 class="page-header"><i class="fa fa-newspaper-o"></i> Edit kategori</h2>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<form action="" method="post" enctype="multipart/form-data">
								<div class="col-sm-8">
                                    <div class="form-group">
										<input type="text" class="form-control" name="kategori" placeholder="Kategori" value="<?php echo $var_kategori; ?>">
									</div>
								<div class="col-sm-12">
									<a href="kategori_edukasi.php" class="btn btn-danger btn-sm">
										<i class="fa fa-arrow-left"></i> Kembali
									</a>
									<button class="btn btn-sm btn-primary" type="submit" name="btn_edit">
										<i class="fa fa-check"></i> Edit
									</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
    CKEDITOR.replace( 'editor' );
</script>
<?php include 'footer.php'; ?>