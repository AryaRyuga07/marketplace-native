<?php 
		if (isset($_POST['submit'])) {
		session_start();
		require '../../core/db.php';

        $user = mysqli_real_escape_string($conn, $_POST['nama']);
        $pass = mysqli_real_escape_string($conn, $_POST['pass']);
        $status = false;
        $login = mysqli_query($conn, "SELECT * FROM tb_user WHERE username = '$user'");
        $data = mysqli_fetch_object($login);
        
        if (password_verify($pass, $data->password)) {
          $status = true;
        } else {
          echo '<script>alert("Password anda salah")</script>';
          echo '<script>window.location="../../views/user/login/login.php"</script>';
        }

      if ($status == true) {
        $cek = mysqli_num_rows($login);
      }

        if ($cek > 0) {
         if ($data->level == "admin") {
            $_SESSION['a_global'] = $data;

            $_SESSION["status_login"] = true;
            $_SESSION["username"] = $user;

            $_SESSION['level'] = "admin";
            $_SESSION['id_user'] = $data->id_user;

            echo '<script>window.location="../../views/admin/dashboard/dashboard.php"</script>';
          } else if ($data->level == "user") {
            $_SESSION['a_global'] = $data;

            $_SESSION["status_login"] = true;
            $_SESSION["username"] = $user;

            $_SESSION['level'] = "user";
            $_SESSION['id_user'] = $data->id_user;

            echo '<script>window.location="../../views/user/home/home.php"</script>';
          } else {
            echo '<script>alert("Username atau Password anda salah")</script>';
            echo '<script>window.location="../../views/user/login/login.php"</script>';
          }
        } else {
          echo '<script>alert("Username atau Password anda salah")</script>';
          echo '<script>window.location="../../views/user/login/login.php"</script>';
        }
      }

    ?>