<?php
$page_title = 'Tambah Customer';
ob_start();
?>

<div class="row justify-content-center">
    <div class="col-lg-8 col-xl-6">
        <div class="dashboard-card">
            <div class="card-header">
                <i class="bi bi-person-plus me-2"></i>Tambah Customer Baru
            </div>
            <div class="card-body">
                <p class="text-muted mb-4">Silakan isi data dibawah ini dengan benar</p>

                <form method="POST" action="src/api/submit-manajemen-customer.php">
                    <div class="mb-3">
                        <label class="form-label">Nama:</label>
                        <input class="form-control" type="text" name="nama" placeholder="Isi Dengan Nama..." required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email:</label>
                        <input class="form-control" type="email" name="email" placeholder="Isi Dengan Email..." required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Handphone:</label>
                        <input class="form-control" type="number" name="handphone" placeholder="Isi Dengan No.HP..." required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Alamat:</label>
                        <input class="form-control" type="text" name="alamat" placeholder="Isi Dengan Alamat..." required>
                    </div>

                    <div class="d-flex gap-2">
                        <button class="btn btn-primary" type="submit">
                            <i class="bi bi-check-lg me-1"></i>Submit
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
