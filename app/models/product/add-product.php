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
			<h3>Add Product</h3>
			<div class="box">
				<form action="" method="POST" enctype="multipart/form-data">
					<select class="input-control" name="category" required>
						<option value="">--choose--</option>
						<?php 
							$kategori = mysqli_query($conn, "SELECT * FROM tb_category ORDER BY id_category DESC");
							while ($r = mysqli_fetch_array($kategori)) {
						 ?>
						 <option value="<?= $r['id_category'] ?>"><?= $r['category_name'] ?></option>
						<?php } ?>
					</select>

					<input type="text" name="name" class="input-control" placeholder="Product Name" required autocomplete="off">
					<input type="text" name="price" class="input-control" placeholder="Price" required autocomplete="off">
					<input type="text" name="cond" class="input-control" placeholder="Condition" required autocomplete="off">
					<input type="text" name="stok" class="input-control" placeholder="Stock" required autocomplete="off">
					<textarea class="input-control" name="description" placeholder="Description" autocomplete="off"></textarea>
					<input type="file" name="image" class="input-control" required>
					<select class="input-control" name="status">
						<option value="">--choose--</option>
						<option value="1">active</option>
						<option value="0">non active</option>
					</select>
					<button name="submit" class="btn">Submit</button>
				</form>
				<?php 
					if (isset($_POST['submit'])) {
						
						// print_r($_FILES['image']);
						//  menampung inputan dari form
						$kategori = $_POST['category'];
						$name = $_POST['name'];
						$price = $_POST['price'];
						$cond = $_POST['cond'];
						$stok = $_POST['stok'];
						$desc = $_POST['description'];
						$status = $_POST['status'];
						// menampung data file yang di upload
						$filename = $_FILES['image']['name'];
						$tmp_name = $_FILES['image']['tmp_name'];

						$type1 = explode('.', $filename);
						$type2 = $type1[1];

						$newname = 'product' .time(). '.' .$type2;

						// menampung data format file yang diizinkan
						$type_izin = array('jpg', 'jpeg', 'png');

						// validasi format file
						if (in_array($type2, $type_izin)) {
							move_uploaded_file($tmp_name, '../../../public/image/Product/' .$newname);

							$insert = mysqli_query($conn, "INSERT INTO tb_product 
								VALUES 
								(null, 
								'$kategori', '$name', '$price', '$cond','$stok', '$desc', '$newname',
								'$status', 
								null)
								");

							if ($insert) {
								echo '<script>alert("Tambah data berhasil")</script>';
								echo '<script>window.location="../../views/admin/product/data-product.php"</script>';
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