<?php 
	session_start();
	if($_SESSION["status_login"] !== true) {
		echo '<script>window.location="../../user/login/login.php"</script>';
	}

	require '../../../core/db.php';
	$session = $_SESSION['id_user'];
	$login = mysqli_query($conn, "SELECT * FROM tb_user WHERE id_user = '$session' ");
    $data = mysqli_fetch_object($login);
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>WebStore</title>
	<link rel="stylesheet" href="../../../../public/css/dashboard.css">
</head>
<body>
	
	<header>
		<div class="container">
	
			<h1><a href="dashboard.php"><img src="../../../../public/image/imgp/logo.png" width="190px" height="35px"></a></h1>
				<ul>
					<li><a href="dashboard.php">Dashboard</a></li>
					<li><a href="../profile/profile.php">Profile</a></li>
					<li><a href="../category/data-category.php">Data Category</a></li>
					<li><a href="../product/data-product.php">Data Product</a></li>
				</ul>
		
		</div>
	</header>

	

	<section>
		<div class="container">
			<h3>Dashboard</h3>
			<div class="box">
				<h4>Selamat Datang <?= $data->nama ?> di Halaman Admin</h4><br>
				<p>Masuk ke <a href="../../user/home/home.php" style="text-decoration: underline; color: blue;">Halaman Home</a></p>
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