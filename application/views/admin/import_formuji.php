<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Form</title>
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

    <meta charset="UTF-8">
    <title>Import Form</title>
</head>
<body>
<main id="main" class="main">
	<table class="container" style="width: 650px; ">
    <form action="<?php echo site_url('FormCSV2/process'); ?>" method="post" enctype="multipart/form-data">
        <label for="file">Pilih file CSV:</label>
        <input type="file" name="file" id="file" accept=".csv">
        <input type="submit" name="import" value="Import">
    </form>
</body>
</html>