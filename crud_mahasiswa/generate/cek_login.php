<?php
	
	// header('Location: index.php');
	include('connect_db.php');

	$username = htmlentities(htmlspecialchars($_POST['nama']));
	$password = htmlentities(htmlspecialchars($_POST['pass']));

	// konek databse
	$konek = mysqli_connect('localhost', 'root', '', 'yudi_db');

	$query = mysqli_query($konek, "select username, password from user where username='$username' and password='$password' " );
	$result = mysqli_num_rows($query);
	

	if (!empty($result)) {
		echo "<script>alert('Selamat Datang');</script>";
		echo "<meta http-equiv='refresh' content='0; url=../dashboard.php'>";

	}
	else {
		echo "<script>alert('Salah Bro');</script>";
		echo "<meta http-equiv='refresh' content='0; url= ../index.php'>";
	}


	mysqli_close($konek);
	
?>