<?php
include("generate/connect_db.php");

// cek tombol daftar
if(isset($_POST['submit'])){
  
  // ambil data dari form
  $nim      = htmlentities(htmlspecialchars($_POST['nim']));
  $nama     = htmlentities(htmlspecialchars($_POST['nama']));
  $email    = htmlentities(htmlspecialchars($_POST['email']));
  $gender   = htmlentities(htmlspecialchars($_POST['gender']));
  $jurusan  = htmlentities(htmlspecialchars($_POST['jurusan']));
  $alamat   = htmlentities(htmlspecialchars($_POST['alamat']));

  
  $konek = mysqli_connect('localhost', 'root', '', 'yudi_db');
  
  // buat query update
  $sql = " UPDATE data_mhs SET nama='$nama', email='$email', gender='$gender', jurusan='$jurusan',  alamat='$alamat' WHERE nim=$nim ";

  $query = mysqli_query($konek, $sql);
  
  // cek query apakah true / false
  if($query) {
    // jika berhasil menyimpan data
    echo "<script>alert('Data Berhasil Diupdate');</script>";
    echo "<meta http-equiv='refresh' content='0; url= dashboard.php'>";
  } else {
    // kalau gagal menampilkan status=gagal
    echo "<script>alert('Data Gagal Diupdate');</script>";
    echo "<meta http-equiv='refresh' content='0; url= dashboard.php'>";
  } 
} else {
  die("Akses Gagal");
}
?>

