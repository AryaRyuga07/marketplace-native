<?php 
require 'func/db.php';

function registrasi($data)
{
	global $conn;

	$username = strtolower(stripcslashes($data["username"]));
	$name = $data["name"];
	$telp = $data["telp"];
	$email = strtolower(stripcslashes($data["email"]));
	$password = mysqli_real_escape_string($conn, $data["pass"]);
	$password2 = mysqli_real_escape_string($conn, $data["pass2"]);

	// cek username sudah ada atau belum
	$result = mysqli_query($conn, "SELECT name FROM tb_admin WHERE name = '$username'");
	if (mysqli_fetch_assoc($result)) {
		echo "<script>
		alert('username sudah terdaftar');
		</script>";
		return false;
	}

	// cek konfirmasi password
	if ($password !== $password2) {
		echo "<script>
			alert('konfirmasi password tidak sesuai')
		</script>";
		return false;
	}

	// enkripsi password
	$password = md5($password);

	// tambahkan user baru ke database
	mysqli_query($conn, "INSERT INTO tb_admin VALUES('', '$name', '$username', '$password', '$telp', '$email', '')");
	return mysqli_affected_rows($conn);
}
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Register | Webstore</title>
	<link rel="stylesheet" href="css/login.css">
</head>
<body id="bg-login">
	
	<div class="box-login">
		<h2>Register</h2>
		<form action="" method="POST">
			<input type="text" name="name" placeholder="Name" class="input-control" autocomplete="off">
			<input type="text" name="username" placeholder="Username" class="input-control" autocomplete="off">
			<input type="text" name="telp" placeholder="No. Telp" class="input-control" autocomplete="off"><br><br>
			<h2>Email & Password</h2>
			<input type="email" name="email" placeholder="Email" class="input-control" autocomplete="off"> 
			<input type="password" name="pass" placeholder="Password" class="input-control" autocomplete="off">
			<input type="password" name="pass2" placeholder="Konfirmasi Password" class="input-control" autocomplete="off">
			<button name="register" class="btn">Register</button>
			<p class="reg"><a href="login.php">Sudah Memiliki akun?</a></p>
		</form>

		<?php 

			if (isset($_POST["register"])) {
	
				if (registrasi($_POST) > 0) {
					echo '<script>alert("user baru berhasil ditambahkan")</script>';
					echo '<script>window.location="login.php"</script>';
					} else {
						echo mysqli_error($conn);
					}

				}

		?>

	</div>

</body>
</html>