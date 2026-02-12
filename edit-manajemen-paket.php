<?php
include('config.php');

$editData = null;

// Handle edit (ngambil data)
if (isset($_GET["id"]) && $_GET["id"]) {
    $id = (int)$_GET["id"];
    if ($id > 0) {
        $stmt = $koneksi->prepare("SELECT * FROM manajemen_paket WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $editData = $result->fetch_assoc();
        $stmt->close();
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $editData ? "Edit" : "Tambah"; ?> Paket - Admin</title>
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

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0 font-general"><?php echo $editData ? "Edit" : "Tambah"; ?> Paket Wisatata</h4>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="src/api/<?php echo $editData ? 'update-manajemen-paket.php' : 'submit-manajemen-paket.php'; ?>">
                            <?php if ($editData): ?>
                                <input type="hidden" name="id" value="<?php echo $editData['id']; ?>">
                            <?php endif; ?>

                            <div class="mb-3">
                                <label class="form-label">Nama Paket</label>
                                <input type="text" name="nama_paket" class="form-control" value="<?php echo htmlspecialchars($editData['nama_paket'] ?? ""); ?>" placeholder="Bali Paradise Escape" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Durasi</label>
                                <input type="text" name="durasi" class="form-control" value="<?php echo htmlspecialchars($editData['durasi'] ?? ""); ?>" placeholder="5 Hari 4 Malam" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Lokasi</label>
                                <input type="text" name="lokasi" class="form-control" value="<?php echo htmlspecialchars($editData['lokasi'] ?? ""); ?>" placeholder="Bali, Indonesia" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Harga (Rp)</label>
                                <input type="number" name="harga" class="form-control" value="<?php echo htmlspecialchars($editData['harga'] ?? ""); ?>" placeholder="4500000" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">URL Gambar</label>
                                <input type="url" name="gambar" class="form-control" value="<?php echo htmlspecialchars($editData['gambar'] ?? ""); ?>" placeholder="https://..." required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Label (Opsional)</label>
                                <input type="text" name="label" class="form-control" value="<?php echo htmlspecialchars($editData['label'] ?? ""); ?>" placeholder="Promo / Hot Deal">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Rating (1-5)</label>
                                <input type="number" name="rating" class="form-control" min="1" max="5" value="<?php echo htmlspecialchars($editData['rating'] ?? 5); ?>" required>
                            </div>

                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-primary">
                                    <?php echo $editData ? "Perbarui" : "Simpan"; ?>
                                </button>
                                <a href="data-manajemen-paket.php" class="btn btn-secondary">Batal</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
