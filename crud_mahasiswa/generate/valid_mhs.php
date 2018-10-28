<?php
include("connect_db.php");

// cek tombol daftar
if(isset($_POST['bt-submit'])){
	
	// ambil data dari form
	$nim 		= htmlentities(htmlspecialchars($_POST['nim']));
	$nama 		= htmlentities(htmlspecialchars($_POST['nama']));
	$email 		= htmlentities(htmlspecialchars($_POST['email']));
	$gender 	= htmlentities(htmlspecialchars($_POST['gender']));
	$jurusan 	= htmlentities(htmlspecialchars($_POST['jurusan']));
	$alamat 	= htmlentities(htmlspecialchars($_POST['alamat']));
	
	$konek = mysqli_connect('localhost', 'root', '', 'yudi_db');
	// buat query
	$sql = " INSERT INTO data_mhs (nim, nama, email, gender, jurusan, alamat) VALUE ('$nim','$nama', '$email', '$gender','$jurusan','$alamat')";

	$query = mysqli_query($konek, $sql);
	
	// query simpan sudah berhasil
	if( $query ) {
		// kalau berhasil menampilkan status=sukses
		echo "<script>alert('Data Berhasil Disimpan');</script>";
		echo "<meta http-equiv='refresh' content='0; url= ../dashboard.php'>";
	} else {
		// kalau gagal menampilkan status=gagal
		echo "<script>alert('Data Gagal Disimpan');</script>";
		echo "<meta http-equiv='refresh' content='0; url= ../dashboard.php'>";
	}	
} else {
	die("Akses Gagal");
}
?>
