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
					<li><a href="data-category.php">Data Category</a></li>
					<li><a href="../product/data-product.php">Data Product</a></li>
				</ul>
		
		</div>
	</header>

	<section>
		<div class="container">
			<h3>Data Category</h3>
			<div class="box">
				<button class="btn" style="margin-bottom: 15px;"><a href="../../../models/category/add-category.php" class="add">+ Add Category</a></button><br>
				<table border="1" cellspacing="0" class="table">
					<thead>
						<tr>
							<th width="60px">No</th>
							<th>Category</th>
							<th>Pict</th>
							<th width="150px">Action</th>
						</tr>
					</thead>
					<tbody>
						<?php 
							$no = 1;
							$kategori = mysqli_query($conn, "SELECT * FROM tb_category ORDER BY id_category DESC");
							if (mysqli_num_rows($kategori) > 0) {
							while ($row = mysqli_fetch_array($kategori)) {
						 ?>
						<tr>
							<td><?= $no++ ?></td>
							<td><?= $row['category_name']; ?></td>
							<td><a href="../../../../public/image/category/<?= $row['category_picture']; ?>" target="blank"><img src="../../../../public/image/category/<?= $row['category_picture']; ?>" width="50px" height="50px"></a></td>
							<td>
								<a href="../../../models/category/update-category.php?id=<?= $row['id_category'] ?>" class="act">Edit</a> || <a href="../../../models/delete/delete.php?idk=<?= $row['id_category']?>" onclick="return confirm('are you sure ?')" class="act">Delete</a>
							</td>
						</tr>
						<?php }} else { ?>
							<tr>
								<td colspan="3">Tidak ada data</td>
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