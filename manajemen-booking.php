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
    <p> Silahkan isi data dibawah ini dengan benar. </p>

    <form method="POST" action="submit.php">
        
        <div class="mb-3">
    <label>Customer :</label>
    <select class="form-control" name="nama" required>
        <option value=""> Pilih Customer </option>
        <option value="Andi">Andi</option>
        <option value="Budi">Budi</option>
        <option value="Siti">Siti</option>
    </select>
</div>

<div class="mb-3">
    <label>Paket :</label>
    <select class="form-control" name="paket" required>
        <option value=""> Pilih Paket </option>
        <option value="Paket A">Paket A</option>
        <option value="Paket B">Paket B</option>
        <option value="Paket C">Paket C</option>
    </select>
</div>

        <button class="btn btn-primary" type="submit">Kirim</button>
    </form>

    </div> 
</body>
</html>