<?php
include('config.php');

$id = $_GET['id'];
$query = mysqli_query($koneksi, "SELECT * FROM manajemen_pembayaran WHERE id='$id'");
$data = mysqli_fetch_array($query);

$page_title = 'Edit Pembayaran';
ob_start();
?>

<div class="row justify-content-center">
    <div class="col-lg-8 col-xl-6">
        <div class="dashboard-card">
            <div class="card-header">
                <i class="bi bi-pencil-square me-2"></i>Edit Pembayaran
            </div>
            <div class="card-body">
                <p class="text-muted mb-4">Silakan edit data pembayaran dengan benar</p>

                <form method="POST" action="src/api/update-manajemen-pembayaran.php">
                    <input type="hidden" name="id" value="<?php echo $data['id']; ?>">

                    <div class="mb-3">
                        <label class="form-label">Booking:</label>
                        <input class="form-control" type="text" name="booking" value="<?php echo htmlspecialchars($data['booking']); ?>">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Tanggal:</label>
                        <input class="form-control" type="date" name="tanggal" value="<?php echo $data['tanggal']; ?>">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Jumlah:</label>
                        <input class="form-control" type="text" name="jumlah" value="<?php echo htmlspecialchars($data['jumlah']); ?>">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Metode:</label>
                        <input class="form-control" type="text" name="metode" value="<?php echo htmlspecialchars($data['metode']); ?>">
                    </div>

                    <div class="d-flex gap-2">
                        <button class="btn btn-primary" type="submit">
                            <i class="bi bi-check-lg me-1"></i>Simpan
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
