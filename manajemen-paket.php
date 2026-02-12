<?php
include('config.php');
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Paket Wisatata</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <link href="https://api.fontshare.com/v2/css?f[]=satoshi@700,500,400&f[]=general-sans@600,500&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Satoshi', sans-serif;
        }
        .font-general {
            font-family: 'General Sans', sans-serif;
        }
    </style>
</head>
<body>
    <?php include('navbar.php'); ?>

    <div class="container col-md-6 mt-5">
        <h1 class="font-general">Tambah Paket Wisatata</h1>
        <p>Silakan isi data paket wisata di bawah ini dengan benar</p>

        <form method="POST" action="src/api/submit-manajemen-paket.php">
            <div class="mb-3">
                <label class="form-label">Nama Paket:</label>
                <input class="form-control" type="text" name="nama_paket" placeholder="Contoh: Bali Paradise Escape" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Durasi:</label>
                <input class="form-control" type="text" name="durasi" placeholder="Contoh: 5 Hari 4 Malam" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Lokasi:</label>
                <input class="form-control" type="text" name="lokasi" placeholder="Contoh: Bali, Indonesia" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Harga (Rp):</label>
                <input class="form-control" type="number" name="harga" placeholder="Contoh: 4500000" required>
            </div>

            <div class="mb-3">
                <label class="form-label">URL Gambar:</label>
                <input class="form-control" type="url" name="gambar" placeholder="https://..." required>
            </div>

            <div class="mb-3">
                <label class="form-label">Label (Opsional):</label>
                <input class="form-control" type="text" name="label" placeholder="Contoh: Promo, Hot Deal">
            </div>

            <div class="mb-3">
                <label class="form-label">Rating (1-5):</label>
                <input class="form-control" type="number" name="rating" min="1" max="5" value="5" required>
            </div>

            <div class="d-flex gap-2">
                <button class="btn btn-primary" type="submit">Simpan</button>
                <a href="data-manajemen-paket.php" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</body>
</html>
