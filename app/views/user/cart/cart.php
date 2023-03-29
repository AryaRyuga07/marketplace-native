<?php 

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
    <script src="https://kit.fontawesome.com/904a972631.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../../../../public/css/cart.css">
    <title>F&D Store</title>
</head>
<body>

    <div class="container">
        <div class="header">
            <nav>
                <div class="logo">
                    <a href="../home/home.php"><img src="../../../../public/image/imgp/logo.png"></a>
                </div>
                <form action="">
                    <div class="search">
                        <a href="../product/product.php">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </a>
                    </div>
                </form>
                <div class="cart">
                    <i class="fa-solid fa-cart-shopping"></i>
                    <h1>Shopping Cart</h1>
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
            <div class="isi-main" id="isi-cart">
                <div class="select">
                    <input type="checkbox">
                    <h1>All Product</h1>
                </div>

                <div class="product" id="top">
                    <input type="checkbox">
                    <img src="../imgp/product1.png" alt="">
                    <div class="caption">
                        <h1>F&D T-Shirt Greek Original Edition</h1>
                        <p>Color :</p>
                    </div>
                    <div class="price">
                        <h1>Rp 165.000</h1>
                        <div class="jumlah">
                            <i class="fa-solid fa-minus"></i>
                            <p>1</p>
                            <i class="fa-solid fa-plus"></i>
                        </div>
                    </div>
                    <i class="fa-solid fa-trash"></i>
                </div>
                
            </div>
            <div class="isi-main" id="isi-summary">
                <div class="summary">
                    <h1>Shopping Summary</h1>
                    <p>Total : </p>
                    <p>Discount : </p>
                    <h2>Total : </h2>
                    <input type="button" value="BUY">
                </div>
            </div>
        </div>

        <div class="footer">
            <p>Contact us <?= $a->telp ?></p>
        </div>

    </div>

    
</body>
</html>