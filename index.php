<?php
	/**
	 * 
	 */
	$server = "localhost";
	$user = "root";
	$pass = "";
	$database = "dblatihan";

	$koneksi = mysqli_connect($server, $user, $pass, $database) or die(mysqli_error($koneksi));

	if(isset($_POST['bsimpan']))
	{
		if($_GET['hal'] == "edit")
		{
			$edit = mysqli_query($koneksi,	" UPDATE mahasiswa set
												nim = '$_POST[tnim]',
												nama = '$_POST[tnama]',
												jeniskelamin = '$_POST[tjeniskelamin]',
												alamat = '$_POST[talamat]',
												kota = '$_POST[tkota]',
												email = '$_POST[temail]',
											 WHERE id_mhs = '$_GET[id]'
											");
			if($edit)
			{
				echo "<script>
						alert('Edit Data SUKSES');
						document.location='index.php';
					</script>";
			}
			else
			{
				echo "<script>
						alert('Edit Data GAGAL');
						document.location='index.php';
					</script>";
			}
		}

		else
		{
			$simpan = mysqli_query($koneksi,	"INSERT INTO mahasiswa (nim, nama, jeniskelamin, alamat, kota, email)
											 VALUES ('$_POST[tnim]',
											 		'$_POST[tnama]',
											 		'$_POST[tjeniskelamin]',
											 		'$_POST[talamat]',
											 		'$_POST[tkota]',
											 		'$_POST[temail]')
											");
			if($simpan)
			{
				echo "<script>
						alert('Simpan Data SUKSES');
						document.location='index.php';
					</script>";
			}
			else
			{
				echo "<script>
						alert('Simpan Data GAGAL');
						document.location='index.php';
					</script>";
			}
			}
		
	}

if(isset($_GET['hal']))
{
	if ($_GET['hal'] == "edit")
	{
		$tampil = mysqli_query($koneksi, "SELECT * FROM mahasiswa WHERE id_mhs = '$_GET[id]' ");
		$data = mysqli_fetch_array($tampil);
		if($data)
		{
			$vnim = $data['nim'];
			$vnama = $data['nama'];
			$vjeniskelamin = $data['jeniskelamin'];
			$valamat = $data['alamat'];
			$vkota = $data['kota'];
			$vemail = $data['email'];
		}
	}
	else if ($_GET['hal'] == "hapus")
	{
		$hapus = mysqli_query($koneksi, "DELETE FROM mahasiswa WHERE id_mhs = '$_GET[id]'");
		if($hapus)
		{
			echo "<script>
						alert('Hapus Data SUKSES');
						document.location='index.php';
					</script>";
		}
	}
}

?>

<!DOCTYPE html>
<html>
<head>
	<tittle>CRUD menggunakan PHP dan MySQL + Bootstrap</tittle>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
</head>
<body>
<div class="container">

	<h1 class="text-center">CRUD Tabel Mahasiswa Menggunakan PHP dengan Database MySQL + Bootstrap</h1>
	<h2 class="text-center">Oleh Rizania Fayza Indhira (20051214039) SI 2020A</h2>>

	<div class="card mt-3">
	  <div class="card-header bg-primary text-white">
	    Form Input Data Mahasiswa
	  </div>
	  <div class="card-body">
	    <form method="post" action="">
	    	<div class="form-group">
	    		<label>NIM</label>
	    		<input type="text" name="tnim" value="<?=@$vnim?>" class="form-control" placeholder="Input NIM Anda Disini" required>
	    	</div>
	    	<div class="form-group">
	    		<label>Nama</label>
	    		<input type="text" name="tnama" value="<?=@$vnama?>" class="form-control" placeholder="Input Nama Anda Disini" required>
	    	</div>
	    	<div class="form-group">
	    		<label>Jenis Kelamin</label>
	    		<select class="form-control" name="tjeniskelamin">
	    			<option value="<?=@$vjeniskelamin?>"><?=@$vjeniskelamin?></option>
	    			<option value="Laki-laki">Laki-laki</option>
	    			<option value="Perempuan">Perempuan</option>
	    		</select>
	    	</div>
	    	<div class="form-group">
	    		<label>Alamat</label>
	    		<textarea class="form-control" name="talamat" placeholder="Input Alamat Anda Disini"><?=@$valamat?></textarea>
	    	</div>
	    	<div class="form-group">
	    		<label>Kota</label>
	    		<input type="text" name="tkota" value="<?=@$vkota?>" class="form-control" placeholder="Input Kota Anda Disini" required>
	    	</div>
	    	<div class="form-group">
	    		<label>Email</label>
	    		<input type="text" name="temail" value="<?=@$vemail?>" class="form-control" placeholder="Input Email Anda Disini" required>
	    	</div>

	    		<button type="submit" class="btn btn-success" name="bsimpan">Simpan</button>
	    		<button type="reset" class="btn btn-danger" name="breset">Kosongkan</button>
	    </form>
	  </div>
	</div>


	<div class="card mt-3">
	  <div class="card-header bg-success text-white">
	    Daftar Mahasiswa
	  </div>
	  <div class="card-body">
	    
	  	<table class="table table-bordered table-stripped">
	  		<tr>
	  			<th>No.</th>
	  			<th>NIM</th>
	  			<th>Nama</th>
	  			<th>Jenis Kelamin</th>
	  			<th>Alamat</th>
	  			<th>Kota</th>
	  			<th>Email</th>
	  			<th>Aksi</th>
	  		</tr>
	  		<?php
	  			$no = 1;
	  			$tampil = mysqli_query($koneksi, "SELECT * from mahasiswa order by id_mhs desc");
	  			while($data = mysqli_fetch_array($tampil)) :
	  		?>
	  		<tr>
	  			<td><?=$no++;?></td>
	  			<td><?=$data['nim']?></td>
	  			<td><?=$data['nama']?></td>
	  			<td><?=$data['jeniskelamin']?></td>
	  			<td><?=$data['alamat']?></td>
	  			<td><?=$data['kota']?></td>
	  			<td><?=$data['email']?></td>
	  			<td>
	  				<a href="index.php?hal=edit&id=<?=$data['id_mhs']?>" class="btn btn-warning"> Edit </a>
	  				<a href="index.php?hal=hapus&id=<?=$data['id_mhs']?>" onclick="return confirm('Apakah yakin ingin menghapus data ini?')" class="btn btn-danger"> Hapus </a>
	  			</td>
	  		</tr>
	  	<?php endwhile; ?>
	  	</table>

	  </div>
	</div>

</div>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
</body>
</html> 