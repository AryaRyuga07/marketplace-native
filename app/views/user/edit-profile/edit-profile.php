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
    <title>Edit Profile - F&D Store</title>
    <link rel="stylesheet" href="../../../../public/css/edit-profile.css">
    <script src="https://kit.fontawesome.com/904a972631.js" crossorigin="anonymous"></script>
   
</head>
<body>

    <div class="container">

        <div class="header">
            <a href="../home/home.php"><img src="../../../../public/image/imgp/logo.png" alt=""></a>
        </div>

        <div class="main">
            <div class="input-field">
                <h1>Account Management</h1>
                
            <form action="../../../models/action/edit-action.php" method="post">
                <div class="edit-profile">
                    <div class="img">
                        <h1>Profile Picture</h1>
                        <img src="../../../../public/image/profile/<?= $d->gambar ?>">
                    </div>
                    <div class="form">
                            <input type="hidden" name="foto" value="<?= $d->gambar ?>">
                            <input type="file" id="file" name="image">
                            <label for="file"> <p>Choose a Photo</p> </label>
                    </div>
                </div>

                <div class="edit-personal">
                    <h1>Personal Information</h1>
                        <div class="name" id="page">
                            <p>Username</p>
                                <div class="input-name">
                                    <i class="fa-solid fa-user"></i>
                                    <input type="text" name="user" placeholder="Username" value="<?= $d->username ?>">
                                </div>
                        </div>

                        <div class="name" id="page">
                            <p>Name</p>
                                <div class="input-name">
                                    <i class="fa-solid fa-user"></i>
                                    <input type="text" name="nama" placeholder="Name" value="<?= $d->nama ?>">
                                </div>
                        </div>

                        <div class="birthday" id="page">
                            <p>Birthday</p>
                                <div class="input-date">
                                    <i class="fa-solid fa-calendar-days"></i>
                                    <input type="date" name="birth" placeholder="Birthday" value="<?= $d->tgl_lahir ?>">
                                </div>
                        </div>

                        <div class="gender" id="page">
                            <p>Gender</p>
                                <div class="input-date">
                                    <i class="fa-solid fa-venus-mars"></i>
                                    <select name="jk" id="">
                                        <option value="Pria">Male</option>
                                        <option value="Wanita">Female</option>
                                    </select>
                                </div>
                        </div>

                        <div class="email" id="page">
                            <p>E-Mail</p>
                                <div class="input-name">
                                    <i class="fa-solid fa-envelope"></i>
                                    <input type="text" name="email" placeholder="E-Mail" value="<?= $d->email ?>">
                                </div>
                        </div>

                        <div class="no" id="page">
                            <p>Phone Number</p>
                                <div class="input-name">
                                    <i class="fa-solid fa-phone"></i>
                                    <input type="text" name="telp" placeholder="No Tlp" value="<?= $d->telp ?>">
                                </div>
                        </div>

                        <div class="alamat" id="page">
                            <p>Addresss</p>
                                <div class="input-name">
                                    <i class="fa-solid fa-location-dot"></i>
                                    <input type="text" name="address" placeholder="Addresss" value="<?= $d->alamat ?>">
                                </div>
                        </div>

                        <input type="submit" name="submit" class="btn-submit" value="SAVE">
                    </form>
                </div>

           </div>
        </div>

        <?php 
            $filename = $_FILES['image']['nama'];
            var_dump($filename);
         ?>

        <div class="footer">
            <p>Contact us <?= $a->telp ?></p>
        </div>

    </div>
    
</body>
</html>