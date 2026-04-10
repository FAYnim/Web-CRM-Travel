<?php
include 'config.php';

if($_SESSION['login'] != true) {
    header("Location: login");
}

$page_title = 'Tambah Klien Korporasi';
$current_page = pathinfo($_SERVER['SCRIPT_NAME'], PATHINFO_FILENAME);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($page_title) ? $page_title . ' - CRM Travel' : 'CRM Travel'; ?></title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <!-- Custom Dashboard CSS -->
    <link rel="stylesheet" href="src/css/dashboard.css">
</head>
<body>

    <!-- Sidebar -->
    <?php include "sidebar.php"; ?>

    <!-- Overlay for mobile -->
    <div class="sidebar-overlay" id="sidebarOverlay" onclick="toggleSidebar()"></div>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Top Header -->
        <header class="top-header">
            <div class="d-flex align-items-center gap-3">
                <button class="btn-sidebar-toggle" onclick="toggleSidebar()">
                    <i class="bi bi-list"></i>
                </button>
                <h1 class="page-title"><?php echo isset($page_title) ? $page_title : 'Dashboard'; ?></h1>
            </div>
            <div class="header-actions">
                <span class="text-muted small d-none d-md-inline">
                    <i class="bi bi-calendar3 me-1"></i>
                    <?php echo date('d M Y'); ?>
                </span>
            </div>
        </header>

        <!-- Page Content -->
        <div class="page-content">
            <!-- Alert Messages -->
            <?php if(isset($_GET['status']) && $_GET['status'] == 'error'): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-circle me-2"></i><?php echo htmlspecialchars($_GET['message']); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php endif; ?>

            <div class="row">
                <div class="col-lg-12 col-xl-12">
                    <div class="dashboard-card">
                        <div class="card-header">
                            <i class="bi bi-plus-circle me-2"></i>Tambah Klien Korporasi Baru
                        </div>
                        <div class="card-body">
                            <p class="text-muted mb-4">Silakan isi data klien korporasi dengan benar</p>

                            <form method="POST" action="src/api/submit-manajemen-klien-korporasi">
                                <!-- Informasi Perusahaan -->
                                <h6 class="text-primary mb-3"><i class="bi bi-building me-2"></i>Informasi Perusahaan</h6>
                                <div class="mb-3">
                                    <label for="nama_perusahaan" class="form-label">Nama Perusahaan <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="nama_perusahaan" name="nama_perusahaan" placeholder="Contoh: PT Telkom Indonesia" required>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="telepon" class="form-label">Telepon Perusahaan <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="telepon" name="telepon" placeholder="Contoh: (021) 12345678" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="email" class="form-label">Email Perusahaan</label>
                                        <input type="email" class="form-control" id="email" name="email" placeholder="Contoh: info@perusahaan.com">
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="alamat" class="form-label">Alamat Perusahaan <span class="text-danger">*</span></label>
                                    <textarea class="form-control" id="alamat" name="alamat" rows="3" placeholder="Alamat lengkap perusahaan" required></textarea>
                                </div>

                                <hr class="my-4">

                                <!-- Informasi PIC -->
                                <h6 class="text-primary mb-3"><i class="bi bi-person me-2"></i>Informasi PIC (Penanggung Jawab)</h6>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="nama_pic" class="form-label">Nama PIC <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="nama_pic" name="nama_pic" placeholder="Nama lengkap PIC" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="jabatan_pic" class="form-label">Jabatan PIC</label>
                                        <input type="text" class="form-control" id="jabatan_pic" name="jabatan_pic" placeholder="Contoh: Manager Travel & Event">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="telepon_pic" class="form-label">Telepon PIC <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="telepon_pic" name="telepon_pic" placeholder="Contoh: 0812-3456-7890" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="email_pic" class="form-label">Email PIC</label>
                                        <input type="email" class="form-control" id="email_pic" name="email_pic" placeholder="Contoh: pic@perusahaan.com">
                                    </div>
                                </div>

                                <hr class="my-4">

                                <!-- Informasi Lainnya -->
                                <h6 class="text-primary mb-3"><i class="bi bi-info-circle me-2"></i>Informasi Lainnya</h6>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="tanggal_bergabung" class="form-label">Tanggal Bergabung <span class="text-danger">*</span></label>
                                        <input type="date" class="form-control" id="tanggal_bergabung" name="tanggal_bergabung" value="<?php echo date('Y-m-d'); ?>" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                                        <select class="form-select" id="status" name="status" required>
                                            <option value="Aktif" selected>Aktif</option>
                                            <option value="Tidak Aktif">Tidak Aktif</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <label for="keterangan" class="form-label">Keterangan</label>
                                    <textarea class="form-control" id="keterangan" name="keterangan" rows="3" placeholder="Keterangan tambahan tentang klien korporasi"></textarea>
                                </div>

                                <div class="d-flex gap-2">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="bi bi-save me-2"></i>Simpan
                                    </button>
                                    <a href="data-manajemen-klien-korporasi" class="btn btn-secondary">
                                        <i class="bi bi-x-circle me-2"></i>Batal
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKHyMxg7QKlP8iI5tL1lNQokFkEExDfKxfmW0P32jJnNqT8hZ1Amn5D4o0aS7y2R" crossorigin="anonymous"></script>
    <!-- Custom Dashboard JS -->
    <script src="src/js/dashboard.js"></script>
</body>
</html>
