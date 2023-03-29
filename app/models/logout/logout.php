<?php 

	session_start();
	session_destroy();

	echo '<script>window.location="../../views/user/login/login.php"</script>';

 ?>