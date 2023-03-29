<?php

session_start();
require '../../core/db.php';

if (isset($_POST['submit'])) {
  $username = strtolower(stripcslashes($_POST['name']));
  $password = mysqli_real_escape_string($conn, $_POST['password']);
  $ph = password_hash($password, PASSWORD_DEFAULT);

  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $result = mysqli_query($conn, "SELECT username FROM tb_user WHERE username = '$username'");
    if (mysqli_fetch_assoc($result)) {
    echo "<script>
      alert('username sudah terdaftar');
      </script>";
    return false;
  }

$insert = mysqli_query($conn, "INSERT INTO tb_user VALUES(
  '', '$username', '-', 
  '$ph','-','-',
  '$email','-','-',
  'profile.png','user') ");

if ($insert) {
    echo '<script>alert("Sign Up Berhasil")</script>';
    echo '<script>window.location="../../views/user/login/login.php"</script>';
  } else {
    echo "gagal" . mysqli_error($conn);
    echo '<script>window.location="../../views/user/login/login.php"</script>';
  }
}
?>