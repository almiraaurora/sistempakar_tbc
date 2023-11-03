<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

	<title>Diagnosis TBC Paru</title>

</head>
<body>
	<!-- Image and text -->
<nav class="navbar navbar-light bg-light">
  <a class="navbar-brand mb-0 h1" href="#">
    <img src="assets/img/stetoskop3.png" width="35" height="35" class="d-inline-block align-top" alt="">
    MediScan
  </a>
</nav>
		<div class=" text-center" style="margin:20px auto;">
		<h1>Mulai diagnosa TBC kamu!</h1>
		<h3>Tambah data baru</h3>
		</div>
		<table style="margin:20px auto;">
			
			<form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">
			<tr>
				<td>Nama</td>
				<td><input type="text" name="nama"></td>
			</tr>
			<tr>
				<td>Usia</td>
				<td><input type="text" name="alamat"></td>
			</tr>
			<tr>
				<td>Jenis Kelamin</td>
				<td> <input type="radio" name="jenis_kelamin" value="Laki-laki"> Laki-laki<br>
                     <input type="radio" name="jenis_kelamin" value="Perempuan"> Perempuan<br></td>
			</tr>
			<tr>
				<td></td>
				<td><input type="submit" class="btn btn-info" value="Tambah"></td>
			</tr>
			</form>
			
		</table>
	</form>	
	
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>