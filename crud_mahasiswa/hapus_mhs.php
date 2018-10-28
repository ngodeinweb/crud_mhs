<?php
 
  // buka koneksi dengan MySQL
  include("generate/connect_db.php");

  // cek apakah form telah di submit (untuk menghapus data)
  if (isset($_POST["submit"])) {
    
    // ambil nilai nim 
    $nim = htmlentities(strip_tags(trim($_POST['nim'])));
    // filter data
    
    //jalankan query DELETE
    $konek = mysqli_connect('localhost', 'root', '', 'yudi_db');
    $query = "DELETE FROM data_mhs where nim = '$nim' ";
    $result = mysqli_query($konek,$query);
  
    //periksa query, tampilkan pesan kesalahan jika gagal
    if($result) {
      // DELETE berhasil, redirect ke tampil_mahasiswa.php + pesan
        $pesan = "<script>alert('Mahasiswa dengan nim = \"<b>$nim</b>\" sudah berhasil di hapus')</script>";
      $pesan = urlencode($pesan);
        header("Location: dashboard.php?pesan={$pesan}");
    } 
    else { 
      die ("Query gagal dijalankan: ".mysqli_errno($konek).
           " - ".mysqli_error($konek));
    }
  }

  // bebaskan memory 
  mysqli_free_result($result);
  
  // tutup koneksi dengan database mysql
  mysqli_close($konek);
?>
