<?php 
	require '../../core/db.php';

	session_start();
	if($_SESSION["status_login"] !== true) {
		echo '<script>window.location="../../views/user/login/login.php"</script>';
	}

	$session = $_SESSION['id_user'];
	$query = mysqli_query($conn, "SELECT * FROM tb_user WHERE id_user = '$session' ");
	$d = mysqli_fetch_object($query);

	if (isset($_POST['submit'])) {
					
		$user = $_POST['user'];
		$nama = ucwords($_POST['nama']);
		$tgl = $_POST['birth'];
		$jk = $_POST['jk'];
		$email = $_POST['email'];
		$hp = $_POST['telp'];
		$address = $_POST['address'];
		$foto = $_POST['foto'];

		$filename = $_FILES['image']['name'];
		$tmp_name = $_FILES['image']['tmp_name'];

		$type1 = explode('.', $filename);
		$type2 = $type1[1];

		$newname = 'profile' .time(). '.' .$type2;

		$type_izin = array('jpg', 'jpeg', 'png');

		if ($filename != '') {
							
			if (in_array($type2, $type_izin)) {
				unlink('../../../public/image/profile/' .$foto);
				move_uploaded_file($tmp_name, '../../../public/image/profile/' .$newname);
				$pictname = $newname;
			}else {
				echo '<script>alert("Format tidak diizinkan")</script>';
			}

		} else {
			$pictname = $foto;
		}

		$update = mysqli_query($conn, "UPDATE tb_user SET 
			username = '". $user ."', 
			nama = '". $nama ."',
			tgl_lahir = '". $tgl ."', 
			jk = '". $jk ."', 
			email = '". $email ."', 
			telp = '". $hp ."', 
			alamat = '". $address ."',
			gambar = '". $pictname ."'
			WHERE id_user = '". $d->id_user ."' ");

		if ($update) {
			echo '<script>alert("Ubah data Berhasil")</script>';
			var_dump($foto);
			// echo '<script>window.location="../../views/user/profile/profile.php"</script>';
		} else {
			echo "gagal" . mysqli_error(conn);
		}

	}