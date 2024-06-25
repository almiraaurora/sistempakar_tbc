<!-- hasil_view.php -->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Analisis</title>
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
<div class="row justify-content-center">
<div class="col-auto">
    <table class="table" style="width: 650px; ">
    <h3>Analisis Data Latih</h3>
        <tr>
            <th>No</th>
            <th>G1</th>
            <th>G2</th>
            <th>G3</th>
            <th>G4</th>
            <th>G5</th>
            <th>G6</th>
            <th>G7</th>
            <th>Hasil</th>
            <th>Label</th>
            <th>Label Setelah</th>
            <!-- Tambahkan kolom untuk atribut lainnya di sini -->
        </tr>
        <?php $no=1; 
        foreach ($tampil_analisisuji as $a){?>
            <tr>
                <td><?php echo $no++ ?></td>
                <td><?php echo $a->Bobotuji_batuk ?></td>
                <td><?php echo $a->Bobotuji_batukberdarah ?></td>
                <td><?php echo $a->Bobotuji_sesaknafas ?></td>
                <td><?php echo $a->Bobotuji_demam ?></td>
                <td><?php echo $a->Bobotuji_keringat ?></td>
                <td><?php echo $a->Bobotuji_nafsumakan ?></td>
                <td><?php echo $a->Bobotuji_beratbadan ?></td>
                <td><?php echo $a->Hasil_perhitunganuji ?></td>
                <td><?php echo $a->label_uji ?></td>
                <td><?php echo $a->labeluji_setelah ?></td>
                <!-- Tambahkan kolom untuk atribut lainnya di sini -->
            </tr>
        <?php } ?>
    </table>
    <table class="table" style="width: 650px; ">
        <h3>Confusion matrix</h3>
        <tr>
            <th>No</th>
            <th>TP</th>
            <th>TN</th>
            <th>FP</th>
            <th>FN</th>
            <th>Accuracy</th>
            <th>Precision</th>
            <th>Recall</th>
            <th>F1 Score</th>
        </tr>
        <?php $no=1; 
        if (!empty($getLatestConfusionMatrixUji) && is_array($getLatestConfusionMatrixUji)) { ?>
            <tr>
                <td><?php echo $no++; ?></td>
                <td><?php echo $getLatestConfusionMatrixUji['TP']; ?></td>
                <td><?php echo $getLatestConfusionMatrixUji['TN']; ?></td>
                <td><?php echo $getLatestConfusionMatrixUji['FP']; ?></td>
                <td><?php echo $getLatestConfusionMatrixUji['FN']; ?></td>
                <td><?php echo $getLatestConfusionMatrixUji['Accuracy']; ?></td>
                <td><?php echo $getLatestConfusionMatrixUji['Precission']; ?></td>
                <td><?php echo $getLatestConfusionMatrixUji['Recall']; ?></td>
                <td><?php echo $getLatestConfusionMatrixUji['F1_Score']; ?></td>
            </tr>
        <?php } else { ?>
            <tr>
                <td colspan="9">No data available</td>
            </tr>
        <?php } ?>

    </table>
    </div>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

</body>
</html>
