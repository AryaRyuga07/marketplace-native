<?php 
	require '../../../core/db.php';

	session_start();
	if($_SESSION["status_login"] !== true) {
		echo '<script>window.location="../../user/login/login.php"</script>';
	}

	$session = $_SESSION['id_user'];
	$query = mysqli_query($conn, "SELECT * FROM tb_user WHERE id_user = '$session' ");
	$d = mysqli_fetch_object($query);
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>WebStore</title>
	<link rel="stylesheet" href="../../../../public/css/profile.css">
</head>
<body>
	
	<header>
		<div class="container">
	
			<h1><a href="dashboard.php"><img src="../../../../public/image/imgp/logo.png" width="190px" height="35px"></a></h1>
				<ul>
					<li><a href="../dashboard/dashboard.php">Dashboard</a></li>
					<li><a href="profile.php">Profile</a></li>
					<li><a href="../category/data-category.php">Data Category</a></li>
					<li><a href="../product/data-product.php">Data Product</a></li>
				</ul>
		
		</div>
	</header>

	<section>
		<div class="container">
			<h3>Profile</h3>
			<div class="box">
				<form action="" method="POST">
					<input type="text" name="user" placeholder="Username" class="input-control" value="<?= $d->username ?>" required autocomplete="off">
					<input type="text" name="name" placeholder="Full Name" class="input-control" value="<?= $d->nama ?>" required autocomplete="off">
					<input type="date" name="tgl" placeholder="Birthday" class="input-control" value="<?= $d->tgl_lahir ?>" required autocomplete="off">
					<select class="input-control" name="jk">
						<option value="<?= $d->jk ?>"><?= $d->jk ?></option>
						<option value="Pria">Pria</option>
						<option value="Wanita">Wanita</option>
					</select>
					<input type="email" name="email" placeholder="Email" class="input-control" value="<?= $d->email ?>" required autocomplete="off">
					<input type="text" name="hp" placeholder="No Hp" class="input-control" value="<?= $d->telp ?>" required autocomplete="off">
					<input type="text" name="address" placeholder="Address" class="input-control" value="<?= $d->alamat ?>" required autocomplete="off">
					<button name="submit" class="btn">Change Profile</button>
				</form>
				<?php 
					if (isset($_POST['submit'])) {
					
						$user = $_POST['user'];
						$nama = ucwords($_POST['name']);
						$tgl = $_POST['tgl'];
						$jk = $_POST['jk'];
						$email = $_POST['email'];
						$hp = $_POST['hp'];
						$address = ucwords($_POST['address']);

						$update = mysqli_query($conn, "UPDATE tb_user SET 
							username = '$user', 
							nama = '$nama',
							tgl_lahir = '$tgl', 
							jk = '$jk', 
							email = '$email', 
							telp = '$hp', 
							alamat = '$address' WHERE id_user = '$d->id_user'");
						if ($update) {
							echo '<script>alert("Ubah data Berhasil")</script>';
							echo '<script>window.location="profile.php"</script>';
						} else {
							echo "gagal" . mysqli_error(conn);
						}

					}
				 ?>
			</div>
			<h3>Ubah Password</h3>
			<div class="box">
				<form action="" method="POST">
					<input type="password" name="pass1" placeholder="New Password" class="input-control" required>
					<input type="password" name="pass2" placeholder="Confirmed Password" class="input-control" required>
					<button name="c_password" class="btn">Change Password</button>
				</form>
				<?php 
					if (isset($_POST['c_password'])) {
					
						$pass1 = $_POST['pass1'];
						$pass2 = $_POST['pass2'];
						$ph = password_hash($pass1, PASSWORD_DEFAULT);

						if ($pass2 != $pass1) {
							echo '<script>alert("Konfirmasi Password Baru Tidak Sesuai")</script>';
						} else {
							$u_pass = mysqli_query($conn, "UPDATE tb_user SET
							password = '$ph' WHERE id_user = '$d->id_user'");	

							if ($u_pass) {
								echo '<script>alert("Ubah Password Berhasil")</script>';
								echo '<script>window.location="profile.php"</script>';
							} else {
								echo "gagal" . mysqli_error(conn);	
							}
						}
					}
				 ?>
			</div>
		</div>
	</section>

	<footer>
		<div class="container">
			<small>Copyright &copy; 2022 WebStore</small>
		</div>
	</footer>

</body>
</html>