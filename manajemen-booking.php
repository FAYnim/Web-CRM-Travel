<?php
include('config.php');

// Fetch customers from database
$query_customer = mysqli_query($koneksi, "SELECT id, nama FROM manajemen_customer ORDER BY nama");
$customers = mysqli_fetch_all($query_customer, MYSQLI_ASSOC);

// Fetch packages from database
$query_paket = mysqli_query($koneksi, "SELECT id, nama_paket FROM manajemen_paket ORDER BY nama_paket");
$pakets = mysqli_fetch_all($query_paket, MYSQLI_ASSOC);
?>
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
    <?php include('navbar.php'); ?>

    <div class="container col-md-6 mt-5">
    <h1>Manajemen Booking</h1>
    <p> Silahkan isi data dessous ini dengan benar. </p>

    <form method="POST" action="submit-manajemen-booking.php">
        
        <div class="mb-3">
    <label>Customer :</label>
    <select class="form-control" name="nama" required>
        <option value=""> Pilih Customer </option>
        <?php foreach($customers as $customer): ?>
            <option value="<?= htmlspecialchars($customer['nama']) ?>"><?= htmlspecialchars($customer['nama']) ?></option>
        <?php endforeach; ?>
    </select>
</div>

<div class="mb-3">
    <label>Paket :</label>
    <select class="form-control" name="paket" required>
        <option value=""> Pilih Paket </option>
        <?php foreach($pakets as $paket): ?>
            <option value="<?= htmlspecialchars($paket['nama_paket']) ?>"><?= htmlspecialchars($paket['nama_paket']) ?></option>
        <?php endforeach; ?>
    </select>
</div>

        <button class="btn btn-primary" type="submit">Kirim</button>
    </form>

    </div> 
</body>
</html>
