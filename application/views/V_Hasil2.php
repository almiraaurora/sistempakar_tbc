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
            <!-- Tambahkan kolom untuk atribut lainnya di sini -->
        </tr>
        <?php foreach ($cf_data as $data): ?>
            <tr>
                <td><?php echo $data['Bobot_batuk']; ?></td>
                <td><?php echo $data['Bobot_batukberdarah']; ?></td>
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
