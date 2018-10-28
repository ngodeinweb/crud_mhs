<?php
	// konek database
	$konek = mysqli_connect('localhost', 'root', '', 'yudi_db');

	if (!$konek) {
		die('Koneksi Gagal'.mysql_error());
	}
	


?>