<?php 
	require '../../core/db.php';
	error_reporting(0);

	session_start();
	if($_SESSION["status_login"] !== true) {
		echo '<script>window.location="../../views/user/login/login.php"</script>';
	}
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>WebStore</title>
	<link rel="stylesheet" href="../../../public/css/data.css">
</head>
<body>
	
	<header>
		<div class="container">
	
			<h1><a href="../../views/admin/dashboard/dashboard.php"><img src="../../../public/image/imgp/logo.png" width="190px" height="35px"></a></h1>
				<ul>
					<li><a href="../../views/admin/dashboard/dashboard.php">Dashboard</a></li>
					<li><a href="../../views/admin/profile/profile.php">Profile</a></li>
					<li><a href="../../views/admin/category/data-category.php">Data Category</a></li>
					<li><a href="../../views/admin/product/data-product.php">Data Product</a></li>
				</ul>
		
		</div>
	</header>

	<section>
		<div class="container">
			<h3>Add Category</h3>
			<div class="box">
				<form action="" method="POST" enctype="multipart/form-data">
					<input type="text" name="name" class="input-control" placeholder="Category Name" required autocomplete="off">
					<input type="file" name="image" class="input-control" required>
					<button name="submit" class="btn">Submit</button>
				</form>
				<?php 
					if (isset($_POST['submit'])) {
						
						// print_r($_FILES['image']);
						//  menampung inputan dari form
						$name = $_POST['name'];
						// menampung data file yang di upload
						$filename = $_FILES['image']['name'];
						$tmp_name = $_FILES['image']['tmp_name'];

						$type1 = explode('.', $filename);
						$type2 = $type1[1];

						$newname = 'category' .time(). '.' .$type2;

						// menampung data format file yang diizinkan
						$type_izin = array('jpg', 'jpeg', 'png');

						// validasi format file
						if (in_array($type2, $type_izin)) {
							move_uploaded_file($tmp_name, '../../../public/image/category/' .$newname);

							$insert = mysqli_query($conn, "INSERT INTO tb_category 
								VALUES 
								(null, 
								'$name', '$newname')
								");

							if ($insert) {
								echo '<script>alert("Tambah data berhasil")</script>';
								echo '<script>window.location="../../views/admin/category/data-category.php"</script>';
							} else {
								echo "gagal" . mysqli_error($conn);
							}
						} else {
							echo '<script>alert("Format tidak diizinkan")</script>';
						}

						// proses upload file sekaligus insert ke database 

					}

				 ?>
		</div>
	</section>

	<footer>
		<div class="container">
			<small>Copyright &copy; 2022 WebStore</small>
		</div>
	</footer>

</body>
</html>