<?php 
	error_reporting(0);
	require '../../core/db.php';
	$idk = $_GET['idk'];
	$idp = $_GET['idp'];

	if (isset($idk)) {
		$delete = mysqli_query($conn, "DELETE FROM tb_category WHERE id_category = '$idk' ");
		echo '<script>alert("Hapus Data Berhasil")</script>';
		echo '<script>window.location="../../views/admin/category/data-category.php"</script>';
	}

	if (isset($idp)) {

		$produk = mysqli_query($conn, "SELECT product_image FROM tb_product WHERE id_product = $idp");
		$p = mysqli_fetch_object($produk);

		unlink('./product/' .$p->product_image);

		$delete = mysqli_query($conn, "DELETE FROM tb_product WHERE id_product = '$idp' ");
		echo '<script>alert("Hapus Data Berhasil")</script>';
		echo '<script>window.location="../../views/admin/product/data-product.php"</script>';
	}



 ?>