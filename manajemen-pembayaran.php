<?php
$page_title = 'Tambah Pembayaran';
ob_start();
?>

<div class="row justify-content-center">
    <div class="col-lg-8 col-xl-6">
        <div class="dashboard-card">
            <div class="card-header">
                <i class="bi bi-cash-stack me-2"></i>Tambah Pembayaran Baru
            </div>
            <div class="card-body">
                <p class="text-muted mb-4">Silakan isi data dibawah ini dengan benar</p>

                <form method="POST" action="src/api/submit-manajemen-pembayaran.php">
                    <div class="mb-3">
                        <label class="form-label">Nomer:</label>
                        <input class="form-control" type="text" name="nomer" placeholder="Isi Dengan Nomer..." required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Booking:</label>
                        <input class="form-control" type="text" name="booking" placeholder="Isi Dengan Booking..." required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Tanggal:</label>
                        <input class="form-control" type="date" name="tanggal" placeholder="Isi Dengan Tanggal..." required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Jumlah:</label>
                        <input class="form-control" type="text" name="jumlah" placeholder="Isi Dengan Jumlah..." required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Metode:</label>
                        <input class="form-control" type="text" name="metode" placeholder="Isi Dengan Metode..." required>
                    </div>

                    <div class="d-flex gap-2">
                        <button class="btn btn-primary" type="submit">
                            <i class="bi bi-check-lg me-1"></i>Submit
                        </button>
                        <a href="data-manajemen-pembayaran.php" class="btn btn-secondary">Batal</a>
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
