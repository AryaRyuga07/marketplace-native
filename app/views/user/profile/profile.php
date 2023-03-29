<?php
session_start();
    if($_SESSION["status_login"] != true) {
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
    <link rel="stylesheet" href="../../../../public/css/prof.css">
    <script src="https://kit.fontawesome.com/904a972631.js" crossorigin="anonymous"></script>
    <title>F&D Store</title>
</head>
<body>

    <div class="container">

        <div class="header">
            <a href="../home/home.php"><img src="../../../../public/image/imgp/logo.png" alt=""></a>
        </div>

        <div class="main">
            <div class="isi-main" id="profile">
                <img src="../../../../public/image/profile/<?= $d->gambar ?>">
                <form method="POST" action="../edit-profile/edit-profile.php">
                <input type="submit" class="button-profile" value="EDIT" style="margin-left: 38px;">
                </form>
                <form action="../../../models/logout/logout.php">
                <input type="submit" class="button-profile" style="margin-left: 38px;" 
                value="LOGOUT">
                </form>
            </div>
            <div class="isi-main" id="contact">
                <h1>My Profile</h1>
                <p>Username : <?= $d->username ?></p>
                <p>Name : <?= $d->nama ?></p>
                <p>Birthday : <?= $d->tgl_lahir ?></p>
                <p>Gender : <?= $d->jk ?></p>
                <h1>Contact</h1>   
                <p>Email : <?= $d->email ?></p>
                <p>No : <?= $d->telp ?></p>
            </div>
            <div class="isi-main" id="social">
                <h1>Social Media</h1>
                <div class="social-media">
                    <i class="fa-brands fa-facebook"></i>
                    <h1>Facebook</h1>
                </div>
                <div class="social-media">
                    <i class="fa-brands fa-google"></i>
                    <h1>Google</h1>
                </div>
                <div class="social-media">
                    <i class="fa-brands fa-twitter"></i>
                    <h1>Twitter</h1>
                </div>
                <div class="social-media">
                    <i class="fa-brands fa-instagram"></i>
                    <h1>Instagram</h1>
                </div>
                <div class="social-media">
                    <i class="fa-brands fa-tiktok"></i>
                    <h1>Tiktok</h1>
                </div>
            </div>
        </div>

        <div class="footer">
            <p>Contact us <?= $a->telp ?></p>
        </div>

    </div>
    
</body>
</html>