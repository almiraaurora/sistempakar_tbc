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
        <table class="table" style="width: 650px; ">
      <a href="TambahDataUji" class="btn btn-primary btn-sm active" role="button" aria-pressed="true">Tambah Data</a>
            <tr>
                  <th>No</th>
                  <th>G1</th>
                  <th>G2</th>
                  <th>G3</th>
                  <th>G4</th>
                  <th>G5</th>
                  <th>G6</th>
                  <th>G7</th>
                  <th>label</th>
                  <th>Update</th>
                  <th>Delete</th>
          </tr>
          <?php 
          $no = 1;
          foreach($tampil_datauji as $u){ 
          ?>
          <tr>
            <td><?php echo $no++ ?></td>
            <td><?php echo $u->Bobot_batuk ?></td>
            <td><?php echo $u->Bobot_batukberdarah ?></td>
            <td><?php echo $u->Bobot_sesaknafas ?></td>
            <td><?php echo $u->Bobot_demam ?></td>
            <td><?php echo $u->Bobot_keringat ?></td>
            <td><?php echo $u->Bobot_nafsumakan ?></td>
            <td><?php echo $u->Bobot_beratbadan ?></td>
            <td><?php echo $u->label ?></td>
            <td> 
            <a href="<?php echo site_url('FormUpdateDataUji/index/'.$u->id_datauji); ?>" class="btn btn-primary btn-sm active">Edit</a>

            </td>
            <td><form action="<?php echo site_url('TambahDataUji/delete_bobotdatauji/'.$u->id_datauji); ?>" method="post">
            <button type="submit" class="btn btn-primary btn-sm active" onclick="return confirm('Are you sure you want to delete this item?');">Delete</button>
          </form>
        </td>
		      </tr>
        <?php } ?>
</table>
<a href="Analisis/tampil_datauji" class="btn btn-primary btn-sm active" role="button" aria-pressed="true">Analisis</a>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</main>
</html>