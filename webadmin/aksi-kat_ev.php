<?php
include '../config/koneksi.php';

session_start();

$act = $_GET['act'];

switch ($act) {
	case 'tambah':

		if (trim($_POST['kategori'])=="") {
			$message = 'Tidak ada data yang ditambahkan';
		}

		$kategoris = $_POST['kategori'];

		if (!isset($message)) {
			$insert_sql = "INSERT INTO kategori_event VALUES ('','$kategoris')";

			$insert_qry = $mysqli->query($insert_sql);

			if ($insert_qry) {
				echo "<script>alert('Data Berhasil Ditambah'); window.location = 'kategori_event.php'</script>";
			} else {
				echo $mysqli->error;
			}
		} else {

			echo "<script>alert('Data Gagal Ditambah'); window.location = 'kategori_event.php'</script>";

		}

		break;
		case 'edit':
			$id=$_REQUEST['id_kategori_ev'];
			$query = "SELECT * from kategori_event where id_kategori_ev='".$id."'"; 
			$result = mysqli_query($con, $query) or die ( mysqli_error());
			$row = mysqli_fetch_assoc($result);
			$status = "";
			if(isset($_POST['new']) && $_POST['new']==1)
			{
			$id=$_REQUEST['id_kategori_ev'];
			$kategori =$_REQUEST['kategori'];
			$submittedby = $_SESSION["nama_lengkap"];
			$update="update new_record set trn_date='".$trn_date."',
			name='".$name."', 
			submittedby='".$submittedby."' where id='".$id."'";
			mysqli_query($con, $update) or die(mysqli_error());
			$status = "Record Updated Successfully. </br></br>
			<a href='view.php'>View Updated Record</a>";
			echo '<p style="color:#FF0000;">'.$status.'</p>';
			}else {
			}
			break;


	case 'hapus2':

		$jum_sql = "SELECT id_event FROM event WHERE id_kategori_ev = '".$mysqli->real_escape_string($_GET['id'])."'";

		$jum_qry = $mysqli->query($jum_sql);

		$jum_berita = $jum_qry->num_rows;

		if ($jum_berita > 0) {
			if ($_SESSION['level']=='admin') {
				header('location: hapus-kat.php?id='.$_GET['id']);
			} else {
				echo "<script>alert('Maaf, dalam kategori ini terdapat berita dari penulis lain!'); window.location = 'kategori_event.php'</script>";
			}

		} else {
			$del_kat_qry = "DELETE FROM kategori_event WHERE id_kategori_ev = '".$_GET['id']."'";

			$del_kat = $mysqli->query($del_kat_qry);

			if ($del_kat) {
				echo "<script>alert('Data Berhasil Dihapus'); window.location = 'kategori_event.php'</script>";
			} else {
				echo $mysqli->error;
			}
		}

		break;

	default:

		header('location: kategori_event.php');

		break;
}