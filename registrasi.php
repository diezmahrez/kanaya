<?php


$db_host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "db_kanaya";

try {    
    //create PDO connection 
    $db = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);
} catch(PDOException $e) {
    //show error
    die("Terjadi masalah: " . $e->getMessage());
}

if(isset($_POST['register'])){

    // filter data yang diinputkan
    $nama_lengkap = filter_input(INPUT_POST, 'nama_lengkap', FILTER_SANITIZE_STRING);
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    // enkripsi password
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);


    // menyiapkan query
    $sql = "INSERT INTO admin (nama_lengkap, username, email, password) 
            VALUES (:nama_lengkap, :username, :email, :password)";
    $stmt = $db->prepare($sql);

    // bind parameter ke query
    $params = array(
        ":nama_lengkap" => $nama_lengkap,
        ":username" => $username,
        ":password" => $password,
        ":email" => $email
    );

    // eksekusi query untuk menyimpan ke database
    $saved = $stmt->execute($params);

    // jika query simpan berhasil, maka user sudah terdaftar
    // maka alihkan ke halaman login
    if($saved) echo "<script>alert('Anda Berhasil Registrasi'); window.location = 'login.php'</script>";
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<link rel="shortcut icon" href="assets/logo.png">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v3.8.5">

    <link rel="canonical" href="https://getbootstrap.com/docs/4.3/examples/sign-in/">

    <!-- Bootstrap core CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

	<title>Login</title>
<style>
body {
    font-family: Poppins;
	width: 100wh;
	height: 90vh;
	color: #fff;
	background-image: url("images/vector-megamendung-batik-gold-sketch-pattern.jpg");
	-webkit-animation: Gradient 5s ease infinite;
	-moz-animation: Gradient 5s ease infinite;
	animation: Gradient 5s ease infinite;
}
 
@-webkit-keyframes Gradient {
	0% {
		background-position: 0% 50%
	}
	50% {
		background-position: 100% 50%
	}
	100% {
		background-position: 0% 50%
	}
}
 
@-moz-keyframes Gradient {
	0% {
		background-position: 0% 50%
	}
	50% {
		background-position: 100% 50%
	}
	100% {
		background-position: 0% 50%
	}
}
 
@keyframes Gradient {
	0% {
		background-position: 0% 50%
	}
	50% {
		background-position: 100% 50%
	}
	100% {
		background-position: 0% 50%
	}
}

.card{border-radius: 1em;
    box-shadow: rgba(50, 50, 93, 0.25) 0px 50px 100px -20px, rgba(0, 0, 0, 0.3) 0px 30px 60px -30px;

}
.form-control{border-radius: 0.8em;

}
.button {
  box-shadow: rgba(50, 50, 93, 0.25) 0px 50px 100px -20px, rgba(0, 0, 0, 0.3) 0px 30px 60px -30px;
  border-radius: 0.8em;
  background-color: #212529;
  padding: 0px 50px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  margin: 10px 5px;
  cursor: pointer;
  }
.button2 {
  border-radius: 0.8em;
  background-color: #FFF;
  padding: 0px 50px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  margin: 10px 10px;
  cursor: pointer;
  box-shadow: rgba(50, 50, 93, 0.25) 0px 50px 100px -20px, rgba(0, 0, 0, 0.3) 0px 30px 60px -30px;
}
.form-control{
    box-shadow: inset 0px 0px 5px rgba(0,0,0,0.2);
}
</style>
</head>
<body>
<div class="login-form">

	<div class='container'>
      </br>
      </br>
      <h3 class="fw-bold text-light">Selamat datang di website Kanayaa</h3>
      <p class="text-light">Ayo temukan kebudayaan Indonesia lebih jauh lagi</p>
    
	<div class="card" style="width: 25rem;">
		<div class="card-header text-dark">
		<strong>Registrasi Akun</strong>
		</div>
			<div class="card-body">
			<form action="" method="post">
				<div class="mb-3">
						<label class="text-dark">Nama Lengkap<span class="text-danger">*</span></label>
                		<input class="form-control" type="text" name="nama_lengkap" placeholder="Nama kamu" />
				</div>
				<div class="mb-3">
						<label class="text-dark">Email <span class="text-danger">*</span></label>
               		 	<input class="form-control" type="email" name="email" placeholder="Alamat Email" />
				</div>

				<div class="mb-3">
					<label class="text-dark">Username <span class="text-danger">*</span></label>
                		<input class="form-control" type="text" name="username" placeholder="Username" />
				</div>
				<div class="mb-3">
					<label class="text-dark">Password <span class="text-danger">*</span></label>
					<input type="password" class="form-control" name="password" placeholder="Password" required="required">
				</div>
				</div>
				</div>
				</br>
			<div class="d-grid gap-2 d-md-block">
            	<div class="button "><input type="submit" class="btn btn-dark " value="Daftar" name="register"></input></div>
				<div class="button2"><a class="btn btn-light" href="login.php">Login</a></div>
			</div>
    </form>
    
    
</div>
</body>
</html>