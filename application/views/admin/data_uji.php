
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Data Uji</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="<?php base_url()?> assets/img/favicon.png" rel="icon">
  <link href="<?php base_url()?> assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="<?php base_url()?> assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?php base_url()?> assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="<?php base_url()?> assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="<?php base_url()?> assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="<?php base_url()?> assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="<?php base_url()?> assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="<?php base_url()?> assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="<?php base_url()?>assets/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: NiceAdmin
  * Updated: Sep 18 2023 with Bootstrap v5.3.2
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>
<body>
<main id="main" class="main">
	<table class="container" style="width: 650px; ">
	<a class="btn btn-primary" href="FormCSV2" role="button">Import Data</a>
	<!-- <button type="button" class="btn btn-primary">
		Import Data
	</button> -->
	<form action="<?php echo base_url('TambahDataUji/tambah_bobotdatauji');?>" method="post">
	<!-- <div class="form-group">
		<label for="exampleFormControlFile1">Example file input</label>
		<input type="file" class="form-control-file" id="exampleFormControlFile1" accept="csv">
	</div> -->
		

			<tr>
				<td>G1</td>
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
				<td>G2</td>
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
				<td>G3</td>
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
				<td>G4</td>
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
				<td>G5</td>
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
				<td>G6</td>
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
				<td>G7</td>
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
				<td>label</td>
				<td>
				<div class="form-group col">
					<label for="exampleFormControlSelect1">pilih sesuai kondisi anda</label>
					<select class="form-control" id="exampleFormControlSelect1" name="label">
					<option value="1"> Ya</option>
					<option value="0"> Tidak</option>
					</select>
				</div>
				</td>
			</tr>
			<tr>
				<td></td>
				<td><input type="submit" class="btn btn-primary" value="Tambah"></td>
			</tr>
	</form>
	<!-- Modal -->
<!-- <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Tambah Data Latih</h5>
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
	  <form action="" method="post">
      <div class="modal-body">
			<label for="csv_file">Choose CSV File:</label>
			<input type="file" name="csv_file" required>
			<br><br>
      </div>
        
      <div class="modal-footer">
	 	<button type="Submit" class="btn btn-primary" name="submit ">Save changes</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
	  </form>
    </div>
  </div>
</div> -->
</table>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</main>
</html>