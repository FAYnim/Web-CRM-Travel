<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Booking</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
<body></body>
</head>
<body>
    <?php include ('navbar.php'); ?>

    <div class="container col-md mt-5">
    <h1>Data Booking</h1>
    <p> Berikut adalah data yang sudah terdaftar. </p>

    <table class="table">
        <thead>
            <tr>
                <th scope="col">Customer</th>
                <th scope="col">Paket</th>
                <th scope="col">Tanggal Booking</th>
                <th scope="col">Opsi</th>
            </tr>
        </thead>
        <tbody class="table-group-divider">
            <?php
    include('config.php');
    $data = mysqli_query($config,"SELECT * FROM data");
    while($baris = mysqli_fetch_array($data)){

    ?>
            <tr>
                <td><?php echo $baris ['customer']; ?></td>
                <td><?php echo $baris ['paket']; ?></td>
                <td><?php echo $baris ['tanggal_booking']; ?></td>
                <td>
                    <a href="edit.php?id=<?php echo $baris['id'] ?>">Edit</a>
                    <a href="hapus.php?id=<?php echo $baris['id'] ?>">Hapus</a>
                </td>
            </tr>
    </div>
    <?php } ?>
        </tbody>
    </table>
</body>
</html>