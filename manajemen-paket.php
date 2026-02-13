<?php
include('config.php');

$page_title = 'Tambah Paket Wisata';
ob_start();
?>

<div class="row justify-content-center">
    <div class="col-lg-12 col-xl-12">
        <div class="dashboard-card">
            <div class="card-header">
                <i class="bi bi-suitcase-lg me-2"></i>Tambah Paket Wisata
            </div>
            <div class="card-body">
                <p class="text-muted mb-4">Silakan isi data paket wisata di bawah ini dengan benar</p>

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
                        <button class="btn btn-primary" type="submit">
                            <i class="bi bi-check-lg me-1"></i>Simpan
                        </button>
                        <a href="data-manajemen-paket.php" class="btn btn-secondary">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
include('layout.php');
?>
