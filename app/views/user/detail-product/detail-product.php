<?php 
    session_start();
    if($_SESSION["status_login"] !== true) {
        echo '<script>window.location="../login/login.php"</script>';
    }

    require '../../../core/db.php';
    $kontak = mysqli_query($conn, "SELECT telp FROM tb_user WHERE id_user = 1");
    $a = mysqli_fetch_object($kontak);

    $produk = mysqli_query($conn, "SELECT * FROM tb_product WHERE id_product = '".$_GET['id']."' ");
    $p = mysqli_fetch_object($produk);

    $kategori = mysqli_query($conn, "SELECT * FROM tb_category WHERE id_category = '".$_GET['cat']."' ");
    $k = mysqli_fetch_object($kategori);

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
    <link rel="stylesheet" href="../../../../public/css/detail-product.css">
    <script src="https://kit.fontawesome.com/904a972631.js" crossorigin="anonymous"></script>
    <title>F&D Store</title>
</head>
<body>

    <div class="container">
        <nav>
			<div class="logo">
				<a href="../home/home.php"><img src="../../../../public/image/imgp/logo.png" alt=""></a>
			</div>
			<form action="">
				<div class="search">
                <a href="../product/product.php">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </a>
            </div>
			</form>
			<div class="cart">
                <a href="../cart/cart.php">
                    <i class="fa-solid fa-cart-shopping"></i>
                </a>
            </div>
			<a href="../profile/profile.php" style="text-decoration: none;">
            <div class="profile">
                <h3><?= $d->username ?></h3>
                <img src="../../../../public/image/imgp/profile.png" class="foto">
            </div>
            </a>
		</nav>

        <div class="main">
            <div class="isi-main" id="gambar">
                <img src="../../../../public/image/Product/<?= $p->product_image ?>" alt="">
            </div>
            <div class="isi-main" id="keterangan">
                <h1><?= $p->product_name ?></h1>
                <div class="harga">
                    <h2>Rp. <?= number_format($p->product_price) ?></h2>
                </div>
                <div class="condition">
                    <h3>Condition : <?= $p->product_condition ?></h3>
                    <h3>Category : <?= $k->category_name ?></h3>
                </div>

                <div class="description">
                    <h1>Description : </h1>
                    <p><?= $p->product_desc ?></p>
                </div>


            </div>
            <div class="isi-main" id="variant">
                <h1>Menu :</h1>
                <p>Stok : <?= $p->stok ?></p>
                <p>Size :</p>
                <input type="button" value="ADD TO CART">
                <input type="button" value="BUY">
            </div>
        </div>

        <div class="footer">
            <p>Contact us <?= $a->telp ?></p>
        </div>
    </div>


    
</body>
</html>