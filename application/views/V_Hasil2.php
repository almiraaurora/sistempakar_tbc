<!-- hasil_view.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Data Hasil</title>
</head>
<body>
    <h1>Data Certainty Factor (CF)</h1>
    <table border="1">
        <tr>
            <th>Bobot Batuk</th>
            <th>Bobot Batuk Berdarah</th>
            <th>Bobot Sesak Nafas</th>
            <th>Bobot Demam</th>
            <th>Bobot Keringat</th>
            <th>Bobot Nafsu Makan</th>
            <th>Bobot Berat Badan</th>
            <!-- Tambahkan kolom untuk atribut lainnya di sini -->
        </tr>
        <?php foreach ($cf_data as $data): ?>
            <tr>
                <td><?php echo $data['Bobot_batuk']; ?></td>
                <td><?php echo $data['Bobot_batukberdarah']; ?></td>
                <td><?php echo $data['Bobot_sesaknafas']; ?></td>
                <td><?php echo $data['Bobot_demam']; ?></td>
                <td><?php echo $data['Bobot_keringat']; ?></td>
                <td><?php echo $data['Bobot_nafsumakan']; ?></td>
                <td><?php echo $data['Bobot_beratbadan']; ?></td>
                <!-- Tambahkan kolom untuk atribut lainnya di sini -->
            </tr>
        <?php endforeach; ?>
    </table>

    <h1>Hasil Dempster-Shafer (DS)</h1>
    <table border="1">
        <tr>
            <th>Massa Gabungan</th>
            <!-- Tambahkan kolom untuk atribut lainnya jika diperlukan -->
        </tr>
        <?php foreach ($ds_data as $ds): ?>
            <tr>
                <td><?php echo $ds->cf; ?></td>
                <!-- Tambahkan kolom untuk atribut lainnya jika diperlukan -->
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
