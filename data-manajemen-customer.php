<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.min.js" integrity="sha384-G/EV+4j2dNv+tEPo3++6LCgdCROaejBqfUeNjuKAiuXbjrxilcCdDz6ZAVfHWe1Y" crossorigin="anonymous"></script>
</head>
<body>
    <?php include('navbar.php'); ?>

    <div class="container mt-5">
    <h1>Data Formulir</h1>
    <p>Berikut adalah data yang sudah terdaftar</p>

    <table class="table">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Nama</th>
                <th scope="col">Email</th>
                <th scope="col">Handphone</th>
                <th scope="col">Alamat</th>
                <th scope="col">Opsi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            include('koneksi.php');
            $data = mysqli_query($koneksi, "SELECT * FROM data");
            $no = 0;
            while ($baris = mysqli_fetch_array($data)){
                $no++;
            ?>
            <tr>
                <td class="baris"><?php echo $no; ?></td>
                <td class="baris"><?php echo $baris['nama']; ?></td>
                <td class="baris"><?php echo $baris['email']; ?></td>
                <td class="baris"><?php echo $baris['handphone']; ?></td>
                <td class="baris"><?php echo $baris['alamat']; ?></td>
            </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
    </div>
</body>
</html>