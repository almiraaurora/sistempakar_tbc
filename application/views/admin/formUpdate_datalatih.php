<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Analisis</title>
    <meta content="" name="description">
    <meta content="" name="keywords">
    <!-- Favicons -->
    <link href="<?php echo base_url('assets/img/favicon.png'); ?>" rel="icon">
    <link href="<?php echo base_url('assets/img/apple-touch-icon.png'); ?>" rel="apple-touch-icon">
    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    <!-- Vendor CSS Files -->
    <link href="<?php echo base_url('assets/vendor/bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/vendor/bootstrap-icons/bootstrap-icons.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/vendor/boxicons/css/boxicons.min.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/vendor/quill/quill.snow.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/vendor/quill/quill.bubble.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/vendor/remixicon/remixicon.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/vendor/simple-datatables/style.css'); ?>" rel="stylesheet">
    <!-- Template Main CSS File -->
    <link href="<?php echo base_url('assets/css/style.css'); ?>" rel="stylesheet">
</head>
<body>
<main id="main" class="main">
    <table class="table" style="width: 650px;">
        <h3>Update Data Latih</h3>
        <?php if (isset($u)): ?>
        <form action="<?php echo site_url('FormUpdateDatalatih/update_bobotdatalatih'); ?>" method="post">
            <input type="hidden" name="id" value="<?php echo $u->id_datalatih; ?>">
            <input type="text" name="Bobot_batuk" value="<?php echo $u->Bobot_batuk; ?>" class="form-control">
            <input type="text" name="Bobot_batukberdarah" value="<?php echo $u->Bobot_batukberdarah; ?>" class="form-control">
            <input type="text" name="Bobot_sesaknafas" value="<?php echo $u->Bobot_sesaknafas; ?>" class="form-control">
            <input type="text" name="Bobot_demam" value="<?php echo $u->Bobot_demam; ?>" class="form-control">
            <input type="text" name="Bobot_keringat" value="<?php echo $u->Bobot_keringat; ?>" class="form-control">
            <input type="text" name="Bobot_nafsumakan" value="<?php echo $u->Bobot_nafsumakan; ?>" class="form-control">
            <input type="text" name="Bobot_beratbadan" value="<?php echo $u->Bobot_beratbadan; ?>" class="form-control">
            <input type="text" name="label" value="<?php echo $u->label; ?>" class="form-control">
            <button type="submit" class="btn btn-primary mt-3">Update</button>
        </form>
        <?php else: ?>
            <p>Data tidak ditemukan.</p>
        <?php endif; ?>
    </table>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>
