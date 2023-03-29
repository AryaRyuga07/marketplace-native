<?php
error_reporting(0);

session_start();
    if($_SESSION["status_login"] !== true) {
        echo '<script>window.location="../login/login.php"</script>';
    }
    
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
    <link rel="stylesheet" href="../../../../public/css/as.css">
    <script src="https://kit.fontawesome.com/904a972631.js" crossorigin="anonymous"></script>
    <title>F&D Store</title>
</head>
<body>

    <div class="container">

    <div class="header">
        <nav>
			<div class="logo">
                <a href="../home/home.php"><img src="../../../../public/image/imgp/logo.png" alt=""></a>
            </div>
			<form action="">
				<div class="search">
					<i class="fa-solid fa-magnifying-glass"></i>
					<form action="product.php">
                        <input type="text" name="search" placeholder="Search" autocomplete="off" value="<?= $_GET['search'] ?>">
                        <input type="hidden" name="cat" value="<?= $_GET['cat'] ?>">
                    </form>
				</div>
			</form>
			<div class="cart">
                <a href="../cart/cart.php">
                    <i class="fa-solid fa-cart-shopping"></i>
                </a>
            </div>
            <a href="../profile/profile.php">
			<div class="profile">
				<h3><?= $d->username ?></h3>
				<img src="../../../../public/image/imgp/profile.png" class="foto">
			</div>
            </a>
		</nav>
    </div>

        <div class="main">
            <?php 
                    $search = $_GET['search'];
                    $cat = $_GET['cat'];
                    if ($search != '' || $cat != '') {
                        $where = "AND product_name LIKE '%".$search."%' AND id_category LIKE '%".$cat."%' ";
                    }
                    $produk = mysqli_query($conn, "SELECT * FROM tb_product WHERE product_status = 1 $where ORDER BY id_product DESC");
                    if (mysqli_num_rows($produk) > 0) {
                        while ($p = mysqli_fetch_array($produk)) {
                 ?>
            <a href="../detail-product/detail-product.php?id=<?= $p['id_product'] ?>&cat=<?= $p['id_category'] ?>&u=<?= $_GET['u'] ?>">
            <div class="isi">
                <img src="../../../../public/image/Product/<?= $p['product_image'] ?>" alt="">
                <h1><?= substr($p['product_name'], 0, 30)  ?></h1>
                <h2>Rp.<?= number_format($p['product_price']) ?></h2>
                <p>Kota Cimahi</p>
            </div>
            </a>
            <?php }} else { ?>
                <p>Product not found</p>
            <?php } ?>
        </div>

        <div class="footer">
            <p>Contact us <?= $a->telp ?></p>
        </div>

    </div>
    
</body>
</html>