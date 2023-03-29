<?php 
	session_start();
	require '../../../core/db.php';
	if($_SESSION["status_login"] !== true) {
		echo '<script>window.location="../../user/login/login.php"</script>';
	}
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>WebStore</title>
	<link rel="stylesheet" href="../../../../public/css/data.css">
</head>
<body>
	
	<header>
		<div class="container">
	
			<h1><a href="dashboard.php"><img src="../../../../public/image/imgp/logo.png" width="190px" height="35px"></a></h1>
				<ul>
					<li><a href="../dashboard/dashboard.php">Dashboard</a></li>
					<li><a href="../profile/profile.php">Profile</a></li>
					<li><a href="../category/data-category.php">Data Category</a></li>
					<li><a href="data-product.php">Data Product</a></li>
				</ul>
		
		</div>
	</header>

	<section>
		<div class="container">
			<h3>Data Product</h3>
			<div class="box">
				<button class="btn" style="margin-bottom: 15px;"><a href="../../../models/product/add-product.php" class="add">+ Add Product</a></button><br>
				<table border="1" cellspacing="0" class="table">
					<thead>
						<tr>
							<th width="60px">No</th>
							<th>Category</th>
							<th>Product Name</th>
							<th>Price</th>
							<th>Stock</th>
							<th>Condition</th>
							<th>Pict</th>
							<th>Status</th>
							<th width="150px">Action</th>
						</tr>
					</thead>
					<tbody>
						<?php 
							$no = 1;
							$produk = mysqli_query($conn, "SELECT * FROM tb_product LEFT JOIN tb_category USING (id_category) ORDER BY id_product DESC");
							if (mysqli_num_rows($produk) > 0) {
							while ($row = mysqli_fetch_array($produk)) {
						 ?>
						<tr>
							<td><?= $no++ ?></td>
							<td><?= $row['category_name']; ?></td>
							<td><?= $row['product_name']; ?></td>
							<td>Rp. <?= number_format($row['product_price']); ?></td>
							<td><?= $row['stok']; ?></td>
							<td><?= $row['product_condition']; ?></td>
							<td><a href="../../../../public/image/product/<?= $row['product_image']; ?>" target="blank"><img src="../../../../public/image/product/<?= $row['product_image']; ?>" width="50px" height="50px"></a></td>
							<td><?= ($row['product_status'] == 0)? 'Tidak Aktif':'Aktif'; ?></td>
							<td>
								<a href="../../../models/product/update-product.php?id=<?= $row['id_product'] ?>" class="act">Edit</a> || <a href="../../../models/delete/delete.php?idp=<?= $row['id_product']?>" onclick="return confirm('are you sure ?')" class="act">Delete</a>
							</td>
						</tr>
						<?php } } else {?>
							<tr>
								<td colspan="7">Tidak Ada Data</td>
							</tr>
						<?php } ?>
					</tbody>
				</table>
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