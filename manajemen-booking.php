<?php
include('config.php');

// Fetch customers from database
$query_customer = mysqli_query($koneksi, "SELECT id, nama FROM manajemen_customer ORDER BY nama");
$customers = mysqli_fetch_all($query_customer, MYSQLI_ASSOC);

// Fetch packages from database
$query_paket = mysqli_query($koneksi, "SELECT id, nama_paket FROM manajemen_paket ORDER BY nama_paket");
$pakets = mysqli_fetch_all($query_paket, MYSQLI_ASSOC);

$page_title = 'Tambah Booking';
ob_start();
?>

<div class="row justify-content-center">
    <div class="col-lg-8 col-xl-6">
        <div class="dashboard-card">
            <div class="card-header">
                <i class="bi bi-calendar-plus me-2"></i>Tambah Booking Baru
            </div>
            <div class="card-body">
                <p class="text-muted mb-4">Silahkan isi data dibawah ini dengan benar.</p>

                <form method="POST" action="src/api/submit-manajemen-booking.php">
                    <div class="mb-3">
                        <label class="form-label">Customer :</label>
                        <select class="form-select" name="nama" required>
                            <option value="">Pilih Customer</option>
                            <?php foreach($customers as $customer): ?>
                                <option value="<?= htmlspecialchars($customer['nama']) ?>"><?= htmlspecialchars($customer['nama']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Paket :</label>
                        <select class="form-select" name="paket" required>
                            <option value="">Pilih Paket</option>
                            <?php foreach($pakets as $paket): ?>
                                <option value="<?= htmlspecialchars($paket['nama_paket']) ?>"><?= htmlspecialchars($paket['nama_paket']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="d-flex gap-2">
                        <button class="btn btn-primary" type="submit">
                            <i class="bi bi-check-lg me-1"></i>Kirim
                        </button>
                        <a href="data-manajemen-booking.php" class="btn btn-secondary">Batal</a>
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
