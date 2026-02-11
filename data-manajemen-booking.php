<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Booking</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
<body>
    <?php include ('navbar.php'); ?>

    <div class="container col-md mt-5">
    <h1>Data Booking</h1>
    <p> Berikut adalah data yang sudah terdaftar. </p>
    
    <a href="manajemen-booking.php" class="btn btn-primary mb-3">Tambah Booking Baru</a>

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
    $data = mysqli_query($koneksi,"SELECT b.id, c.nama as customer, p.nama_paket as paket, b.tanggal 
                                     FROM manajemen_booking b 
                                     LEFT JOIN manajemen_customer c ON b.customer_id = c.id 
                                     LEFT JOIN manajemen_paket p ON b.paket_id = p.id 
                                     ORDER BY b.id DESC");
    while($baris = mysqli_fetch_array($data)){
    ?>
            <tr>
                <td><?php echo $baris['customer']; ?></td>
                <td><?php echo $baris['paket']; ?></td>
                <td><?php echo $baris['tanggal']; ?></td>
                <td>
                    <a href="hapus-manajemen-booking.php?id=<?php echo $baris['id'] ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</a>
                </td>
            </tr>
    <?php } ?>
        </tbody>
    </table>
    </div>
</body>
</html>
