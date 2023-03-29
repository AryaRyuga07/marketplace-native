<?php 
	require '../../core/db.php';
	error_reporting(0);

	session_start();
	if($_SESSION["status_login"] !== true) {
		echo '<script>window.location="../../views/user/login/login.php"</script>';
	}

	$produk = mysqli_query($conn, "SELECT * FROM tb_product WHERE id_product = '" .$_GET['id']. "' ");
	if (mysqli_num_rows($produk) == 0) {
		echo '<script>window.location="../../views/admin/product/data-product.php"</script>';
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
			<h3>Update Product</h3>
			<div class="box">
				<form action="" method="POST" enctype="multipart/form-data">
					<select class="input-control" name="category" required>
						<option value="">--choose--</option>
						<?php 
							$kategori = mysqli_query($conn, "SELECT * FROM tb_category ORDER BY id_category DESC");
							while ($r = mysqli_fetch_array($kategori)) {
						 ?>
						 <option value="<?= $r['id_category'] ?>" <?= ($r['id_category'] == $p->id_category)? 'selected':''; ?>><?= $r['category_name'] ?></option>
						<?php } ?>
					</select>

					<input type="text" name="name" class="input-control" placeholder="Product Name" value="<?= $p->product_name ?>" required>
					<input type="text" name="price" class="input-control" placeholder="Price" value="<?= $p->product_price ?>" required>
					<input type="text" name="cond" class="input-control" placeholder="Condition" value="<?= $p->product_condition ?>" required>
					<input type="text" name="stok" class="input-control" placeholder="Stock" value="<?= $p->stok ?>" required>
					<textarea class="input-control" name="description" placeholder="Description"><?= $p->product_desc ?></textarea>

					<img src="../../../public/image/Product/<?= $p->product_image ?>" width="100px" height="100px">
					<input type="hidden" name="foto" value="<?= $p->product_image ?>">
					<input type="file" name="image" class="input-control">
					<select class="input-control" name="status">
						<option value="">--choose--</option>
						<option value="1" <?= ($p->product_status == 1)? 'selected':''; ?>>active</option>
						<option value="0" <?= ($p->product_status == 0)? 'selected':''; ?>>non active</option>
					</select>
					<button name="submit" class="btn">Submit</button>
				</form>
				<?php 
					if (isset($_POST['submit'])) {

						$kategori = $_POST['category'];
						$name = $_POST['name'];
						$price = $_POST['price'];
						$cond = $_POST['cond'];
						$stok = $_POST['stok'];
						$desc = $_POST['description'];
						$status = $_POST['status'];
						$foto = $_POST['foto'];

						$filename = $_FILES['image']['name'];
						$tmp_name = $_FILES['image']['tmp_name'];

						$type1 = explode('.', $filename);
						$type2 = $type1[1];

						$newname = 'product' .time(). '.' .$type2;

						$type_izin = array('jpg', 'jpeg', 'png');

						if ($filename != '') {
							
							if (in_array($type2, $type_izin)) {
								unlink('../Product/' .$foto);
								move_uploaded_file($tmp_name, '../../../public/image/Product/' .$newname);
								$pictname = $newname;
							}else {
								echo '<script>alert("Format tidak diizinkan")</script>';
							}

						} else {
							$pictname = $foto;
						}

						$update = mysqli_query($conn, "UPDATE tb_product SET 
												id_category = '". $kategori ."',
												product_name = '". $name ."',
												product_price = '". $price ."',
												product_condition = '". $cond ."',
												product_desc = '". $desc ."',
												stok = '". $stok ."',
												product_image = '". $pictname ."',
												product_status = '". $status ."'
												WHERE id_product = '". $p->id_product ."' ");

						if ($update) {
								echo '<script>alert("Update data berhasil")</script>';
								echo '<script>window.location="../../views/admin/product/data-product.php"</script>';
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