<?php
include('config.php');

$id = $_GET['id'];
$query = mysqli_query($koneksi, "SELECT * FROM manajemen_customer WHERE id='$id'");
$data = mysqli_fetch_array($query);

$page_title = 'Edit Customer';
ob_start();
?>

<div class="row justify-content-center">
    <div class="col-lg-8 col-xl-6">
        <div class="dashboard-card">
            <div class="card-header">
                <i class="bi bi-pencil-square me-2"></i>Edit Customer
            </div>
            <div class="card-body">
                <p class="text-muted mb-4">Silakan edit data dibawah ini dengan benar</p>

                <form method="POST" action="src/api/update-manajemen-customer.php">
                    <input type="hidden" name="id" value="<?php echo $data['id']; ?>">

                    <div class="mb-3">
                        <label class="form-label">Nama:</label>
                        <input class="form-control" type="text" name="nama" value="<?php echo htmlspecialchars($data['nama']); ?>">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email:</label>
                        <input class="form-control" type="email" name="email" value="<?php echo htmlspecialchars($data['email']); ?>">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Handphone:</label>
                        <input class="form-control" type="text" name="handphone" value="<?php echo htmlspecialchars($data['handphone']); ?>">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Alamat:</label>
                        <input class="form-control" type="text" name="alamat" value="<?php echo htmlspecialchars($data['alamat']); ?>">
                    </div>

                    <div class="d-flex gap-2">
                        <button class="btn btn-primary" type="submit">
                            <i class="bi bi-check-lg me-1"></i>Simpan
                        </button>
                        <a href="data-manajemen-customer.php" class="btn btn-secondary">Batal</a>
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
