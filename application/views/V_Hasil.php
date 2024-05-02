<!DOCTYPE html>
<html>

<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Data View</title>
</head>
<body>
    <?php
    $symptoms = ['Bobot_batuk', 'Bobot_batukberdarah', 'Bobot_sesaknafas', 'Bobot_demam', 'Bobot_keringat', 'Bobot_nafsumakan', 'Bobot_beratbadan'];
    $CFModel = new M_hasil(); // Ganti dengan nama model Anda
    $masses = $CFModel->getCFdata($symptoms);
    $combined_mass = $CFModel->tampil_hasil($masses);

    // Tampilkan hasil perhitungan CF
    echo "<h2>Hasil Perhitungan Massa Gabungan:</h2>";
    //echo "Massa Gabungan: " . $masses;
    echo "Massa Gabungan: " . $combined_mass;
    ?>
  
</body>
</html>