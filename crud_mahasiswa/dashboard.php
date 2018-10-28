<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title> Dashboard - CRUD Mahasiswa</title>

	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/main.js"></script>


</head>
<body>
	<?php
		include 'generate/connect_db.php';

		$konek = mysqli_connect('localhost', 'root', '', 'yudi_db');

		$query = mysqli_query($konek, "select * from data_mhs ");
		$result = mysqli_num_rows($query);

	?>

    <div class="container">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-6">
						<h2> Data <b> Mahasiswa</b></h2>
					</div>
					<div class="col-sm-6">
						<a href="#create_md" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span> Tambah Mahasiswa </span></a>
						<a href="#deleteEmployeeModal" class="btn btn-danger" data-toggle="modal"><i class="material-icons">&#xE15C;</i> <span> Hapus </span></a>						
					</div>
                </div>
            </div>

            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                    	<th>NO</th>
						<th>NIM</th>
                        <th>Nama</th>
                        <th>Email</th>
						<th>Gender</th>
                        <th>Jurusan</th>
                        <th>Alamat</th>
                        <th>Tindakan</th>
                    </tr>
                </thead>
                <tbody>
                	<!-- Mengambil isi database -->
					<?php
						// variable nomor urut
						$no = 1;
						if ($result > 0 ) { ?>
							<?php
								while ($data = mysqli_fetch_array($query)) { ?>
									<tr>
										<td style="text-align: center;"><?php echo $no; ?></td>
										<td><?php echo $data['nim']; ?></td>
										<td><?php echo $data['nama']; ?></td>
										<td><?php echo $data['email']; ?></td>
										<td><?php echo $data['gender']; ?></td>
										<td><?php echo $data['jurusan']; ?></td>
										<td><?php echo $data['alamat']; ?></td>

										<td>
											<!-- no urut -->
											<?php
												$no++;
											?>

											<!-- tombol edit -->
											<a href="#md_ed" class="edit" data-toggle="modal"><i 				class="material-icons" data-toggle="tooltip" 						title="Edit">&#xE254;</i></a>
											<!-- Edit Data -->
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
											    $query = "SELECT * FROM data_mhs where nim = '$nim' ";
											    $result = mysqli_query($konek,$query);
											    $data = mysqli_fetch_assoc($result);
											  
											    // jika data yang di-edit tidak ditemukan
											    if( mysqli_num_rows($result) < 1 ){
											        die("Maaf Data Tidak Ditemukan");
											    }
											    
											  }
											  
											  // tutup koneksi dengan database mysql
											  mysqli_close($konek);
											?>
											<div id="md_ed" class="modal fade">
												<div class="modal-dialog">
													<div class="modal-content">
														<form method="post" action="edit_mhs.php">
															<input type="hidden" name="nim" value="<?php echo $data['nim'] ?>" />

															<div class="modal-header">						
																<h4 class="modal-title">Edit Data Mahasiswa</h4>
																<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
															</div>
															<div class="modal-body">
																<div class="form-group">
																	<label>NIM</label>
																	<input type="text" class="form-control" name="nim" id="nim" required value="<?php echo $data['nim']; ?>" readonly>
																</div>					
																<div class="form-group">
																	<label>Nama</label>
																	<input type="text" class="form-control" name="nama" id="nama" required value="<?php echo $data['nama']; ?>">
																</div>
																<div class="form-group">
																	<label>Email</label>
																	<input type="email" class="form-control" name="email" id="email" required value="<?php echo $data['email']; ?>">
																</div>
																<div class="form-group">
																	<label>Gender</label>
																	<?php $gender = $data['gender']; ?>
																	<select class="form-control" id="gender" name="gender">
																      <option selected>Pilih ..</option>
																      <option <?php echo ($gender == 'L') ? "selected": "" ?>>L</option>
																      <option <?php echo ($gender == 'P') ? "selected": "" ?>>P</option>
																    </select>
																</div>
																<div class="form-group">
																	<label>Jurusan</label>
																	<?php $jurusan = $data['jurusan']; ?>
																	<select class="form-control" id="jurusan" name="jurusan">
																      <option selected>Pilih ..</option>
																      <option <?php echo ($jurusan == 'D3 Teknik Informatika') ? "selected": "" ?>>D3 Teknik Informatika</option>
																      <option <?php echo ($jurusan == 'D3 Manajemen Informatika') ? "selected": "" ?>>D3 Manajemen Informatika</option>
																      <option <?php echo ($jurusan == 'S1 Teknik Komputer') ? "selected": "" ?>>S1 Teknik Komputer</option>
																      <option <?php echo ($jurusan == 'S1 Ilmu Komunikasi') ? "selected": "" ?>>S1 Ilmu Komunikasi</option>
																    </select>
																</div>
																<div class="form-group">
																	<label>Alamat</label>
																	<textarea name="alamat" id="alamat" class="form-control" required><?php echo $data['alamat']; ?></textarea>
																</div>					
															</div>
															<div class="modal-footer">
																<input type="button" class="btn btn-default" data-dismiss="modal" value="Batal">
																<input id="submit" name="submit" type="submit" class="btn btn-info" value="Simpan">
															</div>
														</form>
													</div>
												</div>
											</div> 


											<!-- tombol hapus -->
											<a href="#md_dl" class="delete" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></a>
											<!-- Hapus Data -->
											<div id="md_dl" class="modal fade">
												<div class="modal-dialog">
													<div class="modal-content">
														<form action="hapus_mhs.php" method="post">
															<div class="modal-header">						
																<h4 class="modal-title">Hapus Data Mahasiswa</h4>
																<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
															</div>
															<div class="modal-body">					
																<p>Apakah anda yakin ingin menghapus data mahasiswa ini?</p>
																<p class="text-warning"><small>Data yang sudah dihapus tidak dapat dikembalikan.</small></p>
															</div>
															<div class="modal-footer">
																<input type="button" class="btn btn-default" data-dismiss="modal" value="Batal">

																<form>
																	<input type="hidden" name="nim" value="<?php echo $data['nim']; ?>" >
																	<input class="btn btn-danger btn-sm" type="submit" name="submit" value="Hapus" >
																</form>
																
																
															</div>
														</form>
													</div>
												</div>
											</div>

										</td>
									</tr>
							<?php	} ?>

					<?php	} ?>

                </tbody>
            </table>
			<div class="clearfix">
                <!-- footer -->
            </div>
        </div>
    </div>


	<!-- create modal -->
	<div id="create_md" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form method="post" action="generate/valid_mhs.php">
					<div class="modal-header">						
						<h4 class="modal-title">Tambah Mahasiswa</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<label>NIM</label>
							<input type="text" class="form-control" name="nim" id="nim" required>
						</div>					
						<div class="form-group">
							<label>Nama</label>
							<input type="text" class="form-control" name="nama" id="nama" required>
						</div>
						<div class="form-group">
							<label>Email</label>
							<input type="email" class="form-control" name="email" id="email" required>
						</div>
						<div class="form-group">
							<label>Gender</label>
							<select class="form-control" id="gender" name="gender">
						      <option selected>Pilih ..</option>
						      <option>L</option>
						      <option>P</option>
						    </select>
						</div>
						<div class="form-group">
							<label>Jurusan</label>
							<select class="form-control" id="jurusan" name="jurusan">
						      <option selected>Pilih ..</option>
						      <option>D3 Teknik Informatika</option>
						      <option>D3 Manajemen Informatika</option>
						      <option>S1 Teknik Komputer</option>
						      <option>S1 Ilmu Komunikasi</option>
						    </select>
						</div>
						<div class="form-group">
							<label>Alamat</label>
							<textarea name="alamat" id="alamat" class="form-control" required></textarea>
						</div>					
					</div>
					<div class="modal-footer">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Batal">
						<input id="bt-submit" name="bt-submit" type="submit" class="btn btn-success" value="Tambah">
					</div>
				</form>
			</div>
		</div>
	</div>

	

	
</body>
</html>                                		                            