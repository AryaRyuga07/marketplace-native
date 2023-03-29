<?php 
session_start();
error_reporting(0);
require '../../../core/db.php';
$kontak = mysqli_query($conn, "SELECT telp FROM tb_user WHERE id_user = 1");
$a = mysqli_fetch_object($kontak);

$session = $_SESSION['id_user'];
$query = mysqli_query($conn, "SELECT * FROM tb_user WHERE id_user = '$session' ");
$d = mysqli_fetch_object($query);

 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script src="https://kit.fontawesome.com/904a972631.js" crossorigin="anonymous"></script>
	<title>F&D Store</title>
	<link rel="stylesheet" href="../../../../public/css/home.css">
</head>
<body>

	<div class="container">

		<nav>
			<div class="logo">
				<a href="../home/home.php"><img src="../../../../public/image/imgp/logo.png" alt=""></a>
			</div>
			<div class="search">
				<a href="../product/product.php">
					<i class="fa-solid fa-magnifying-glass"></i>
				</a>
			</div>
			<div class="cart">
				<a href="../cart/cart.php">
					<i class="fa-solid fa-cart-shopping"></i>
				</a>
			</div>
			<?php if (empty($d)){?>
				<a href="../login/login.php">
				<div class="profile">
					<h3>Login</h3>
					<img src="../../../../public/image/imgp/profile.png" class="foto">
				</div>
				</a>
			<?php } else {?>
				<a href="../profile/profile.php">
				<div class="profile">
					<h3><?= $d->username ?></h3>
					<img src="../../../../public/image/imgp/profile.png" class="foto">
				</div>
				</a>
			<?php } ?>
		</nav>

		<div class="main">
			<div class="product">
				<div class="iklan">
					<img src="../../../../public/image/IndexImage/hero.png">
				</div>
				<div class="container-product">
						<div class="carousel">
							<div class="slider">
								<section>
									<?php 
										$produk = mysqli_query($conn, "SELECT * FROM tb_product WHERE product_status = 1 ORDER BY id_product DESC LIMIT 4");
										if (mysqli_num_rows($produk) > 0) {
										while ($p = mysqli_fetch_array($produk)) {
									?>
										<a href="../detail-product/detail-product.php?id=<?= $p['id_product'] ?>&cat=<?= $p['id_category'] ?>">
											<div class="isi">
													<img src="../../../../public/image/Product/<?= $p['product_image'] ?>">
													<h1><?= substr($p['product_name'], 0, 30)  ?></h1>
													<h2>Rp.<?= number_format($p['product_price']) ?></h2>
													<p>Kota Cimahi</p>
											</div>
										</a>
									<?php }} else { ?>
										<p>Product not found</p>
									<?php } ?>
								</section>
								<section>
									<?php 
										$produk = mysqli_query($conn, "SELECT * FROM tb_product WHERE product_status = 1 ORDER BY id_product ASC LIMIT 4");
										if (mysqli_num_rows($produk) > 0) {
										while ($p = mysqli_fetch_array($produk)) {
									?>
										<a href="../detail-product/detail-product.php?id=<?= $p['id_product'] ?>&cat=<?= $p['id_category'] ?>">
											<div class="isi">
													<img src="../../../../public/image/Product/<?= $p['product_image'] ?>">
													<h1><?= substr($p['product_name'], 0, 30)  ?></h1>
													<h2>Rp.<?= number_format($p['product_price']) ?></h2>
													<p>Kota Cimahi</p>
											</div>
										</a>
									<?php }} else { ?>
										<p>Product not found</p>
									<?php } ?>
								</section>
							</div>
							<div class="control">
                            	<span class="arrow left"><i class="fa-solid fa-angles-left"></i></span>
                            	<span class="arrow right"><i class="fa-solid fa-angles-right"></i></span>
                        	</div>
						</div>
					</div>
				</div>
			<div class="category">
				<div class="main-category">
					<h1>Category</h1>
					<?php 
					$kategori = mysqli_query($conn, "SELECT * FROM tb_category ORDER BY id_category DESC LIMIT 6");
					if (mysqli_num_rows($kategori) > 0) {
						while($k = mysqli_fetch_array($kategori)){
					 ?>

					<a href="../product/product.php?cat=<?= $k['id_category'] ?>">
					<div class="isi-category" id="shoes">
						<img src="../../../../public/image/category/<?= $k['category_picture'] ?>" alt="">
						<p><?= $k['category_name'] ?></p>
					</div>
					</a>
					<?php }} else { ?>
						<p>Category not found</p>
					<?php  } ?>
				</div>
			</div>
		</div>
		<div class="footer">
			<p>Contact us <?= $a->telp ?></p>
		</div>

	</div>

<script src="../../../../public/js/home.js"></script>

	
</body>
</html>