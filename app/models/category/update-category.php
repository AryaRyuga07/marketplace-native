<?php 
	require '../../core/db.php';
	error_reporting(0);

	session_start();
	if($_SESSION["status_login"] !== true) {
		echo '<script>window.location="../../views/user/login/login.php"</script>';
	}

	$produk = mysqli_query($conn, "SELECT * FROM tb_category WHERE id_category = '" .$_GET['id']. "' ");
	if (mysqli_num_rows($produk) == 0) {
		echo '<script>window.location="../../views/admin/category/data-category.php"</script>';
	}
	$p = mysqli_fetch_object($produk);
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
			<h3>Update Category</h3>
			<div class="box">
				<form action="" method="POST" enctype="multipart/form-data">
					<input type="text" name="name" class="input-control" placeholder="Category Name" value="<?= $p->category_name ?>" required>
					<img src="../../../public/image/category/<?= $p->category_picture ?>" width="100px" height="100px">
					<input type="hidden" name="foto" value="<?= $p->category_picture ?>">
					<input type="file" name="image" class="input-control">
					<button name="submit" class="btn">Submit</button>
				</form>
				<?php 
					if (isset($_POST['submit'])) {

					
						$name = $_POST['name'];
						$foto = $_POST['foto'];

						$filename = $_FILES['image']['name'];
						$tmp_name = $_FILES['image']['tmp_name'];

						$type1 = explode('.', $filename);
						$type2 = $type1[1];

						$newname = 'category' .time(). '.' .$type2;

						$type_izin = array('jpg', 'jpeg', 'png');

						if ($filename != '') {
							
							if (in_array($type2, $type_izin)) {
								unlink('../../../public/image/category/' .$foto);
								move_uploaded_file($tmp_name, '../../../public/image/category/' .$newname);
								$pictname = $newname;
							}else {
								echo '<script>alert("Format tidak diizinkan")</script>';
							}

						} else {
							$pictname = $foto;
						}

						$update = mysqli_query($conn, "UPDATE tb_category SET 
												category_name = '". $name ."',
												category_picture = '". $pictname ."'
												WHERE id_category = '". $p->id_category ."' ");

						if ($update) {
								echo '<script>alert("Update data berhasil")</script>';
								echo '<script>window.location="../../views/admin/category/data-category.php"</script>';
							} else {
								echo "gagal" . mysqli_error($conn);
							}

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