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
		<h1>Tes Diagnosa Dini TBC Paru</h1>
		<h3>Isilah Sesuai Kondisi Kalian ya!</h3>
		<span class="p-3 mb-2 bg-light text-dark">
			<p>Tes ini hanya sebagai acuan untuk mencegah penyebaran dan mendiagnosa dini TBC</p>
		<p>Jika gejala yang anda alami terasa mengganggu segera konsultasikan ke dokter terdekat</p></span>
		
		</div>
	<table class="mx-auto" style="width: 650px;">
	<form action="<?php echo base_url('Combination/tambah_bobot');?>" method="post">
			<tr>
				<td>1. Batuk berlangsung lebih dari 2 minggu</td>
				<td>
				<div class="form-group col">
					<label for="exampleFormControlSelect1">pilih sesuai kondisi anda</label>
					<select class="form-control" id="exampleFormControlSelect1" name="Bobot_batuk">
					<option value="1"> Sangat Yakin</option>
					<option value="0.8"> Yakin</option>
					<option value="0.6"> Cukup Yakin</option>
					<option value="0.4"> Sedikit Yakin</option>
					<option value="0.2"> Tidak Yakin</option>
					</select>
				</div>
				</td>
			</tr>
			<tr>
				<td>2. Batuk berdarah</td>
				<td>
				<div class="form-group col">
					<label for="exampleFormControlSelect1">pilih sesuai kondisi anda</label>
					<select class="form-control" id="exampleFormControlSelect1" name="Bobot_batukberdarah">
					<option value="1"> Sangat Yakin</option>
					<option value="0.8"> Yakin</option>
					<option value="0.6"> Cukup Yakin</option>
					<option value="0.4"> Sedikit Yakin</option>
					<option value="0.2"> Tidak Yakin</option>
					</select>
				</div>
				</td>
			</tr>
			<tr>
				<td>3. Sesak nafas dan nyeri dada</td>
				<td>
				<div class="form-group col">
					<label for="exampleFormControlSelect1">pilih sesuai kondisi anda</label>
					<select class="form-control" id="exampleFormControlSelect1" name="Bobot_sesaknafas">
					<option value="1"> Sangat Yakin</option>
					<option value="0.8"> Yakin</option>
					<option value="0.6"> Cukup Yakin</option>
					<option value="0.4"> Sedikit Yakin</option>
					<option value="0.2"> Tidak Yakin</option>
					</select>
				</div>
				</td>
			</tr>
			<tr>
				<td>4. Demam</td>
				<td>
				<div class="form-group col">
					<label for="exampleFormControlSelect1">pilih sesuai kondisi anda</label>
					<select class="form-control" id="exampleFormControlSelect1" name="Bobot_demam">
					<option value="1"> Sangat Yakin</option>
					<option value="0.8"> Yakin</option>
					<option value="0.6"> Cukup Yakin</option>
					<option value="0.4"> Sedikit Yakin</option>
					<option value="0.2"> Tidak Yakin</option>
					</select>
				</div>
				</td>
			</tr>
			<tr>
				<td>5. Keringat pada malam hari</td>
				<td>
				<div class="form-group col">
					<label for="exampleFormControlSelect1">pilih sesuai kondisi anda</label>
					<select class="form-control" id="exampleFormControlSelect1" name="Bobot_keringat">
					<option value="1"> Sangat Yakin</option>
					<option value="0.8"> Yakin</option>
					<option value="0.6"> Cukup Yakin</option>
					<option value="0.4"> Sedikit Yakin</option>
					<option value="0.2"> Tidak Yakin</option>
					</select>
				</div>
				</td>
			</tr>
			<tr>
				<td>6. Kehilangan nafsu makan</td>
				<td>
				<div class="form-group col">
					<label for="exampleFormControlSelect1">pilih sesuai kondisi anda</label>
					<select class="form-control" id="exampleFormControlSelect1" name="Bobot_nafsumakan">
					<option value="1"> Sangat Yakin</option>
					<option value="0.8"> Yakin</option>
					<option value="0.6"> Cukup Yakin</option>
					<option value="0.4"> Sedikit Yakin</option>
					<option value="0.2"> Tidak Yakin</option>
					</select>
				</div>
				</td>
			</tr>
			<tr>
				<td>7. Penurunan berat badan </td>
				<td>
				<div class="form-group col">
					<label for="exampleFormControlSelect1">pilih sesuai kondisi anda</label>
					<select class="form-control" id="exampleFormControlSelect1" name="Bobot_beratbadan">
					<option value="1"> Sangat Yakin</option>
					<option value="0.8"> Yakin</option>
					<option value="0.6"> Cukup Yakin</option>
					<option value="0.4"> Sedikit Yakin</option>
					<option value="0.2"> Tidak Yakin</option>
					</select>
				</div>
				</td>
			</tr>
			<tr>
				<td></td>
				<td><input type="submit" class="btn btn-info" value="Tambah"></td>
			</tr>
	</form>
</table>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>