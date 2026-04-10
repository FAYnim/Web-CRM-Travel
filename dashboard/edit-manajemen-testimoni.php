<?php
include 'config.php';

if($_SESSION['login'] != true) {
    header("Location: login");
}

$id = $_GET['id'];
$query = mysqli_query($koneksi, "SELECT * FROM testimoni WHERE id='$id'");
$data = mysqli_fetch_array($query);

$page_title = 'Edit Testimoni';
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

            <div class="row justify-content-center">
                <div class="dashboard-card">
                    <div class="card-header">
                        <i class="bi bi-pencil-square me-2"></i>Edit Testimoni
                    </div>
                    <div class="card-body">
                        <p class="text-muted mb-4">Silakan edit data testimoni dengan benar</p>

                        <form method="POST" action="src/api/update-manajemen-testimoni">
                            <input type="hidden" name="id" value="<?php echo $data['id']; ?>">

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Nama Pelanggan <span class="text-danger">*</span></label>
                                    <input class="form-control" type="text" name="nama_pelanggan" value="<?php echo htmlspecialchars($data['nama_pelanggan']); ?>" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Tanggal</label>
                                    <input class="form-control" type="date" name="tanggal" value="<?php echo $data['tanggal']; ?>">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Pesan Testimoni <span class="text-danger">*</span></label>
                                <textarea class="form-control" name="pesan" rows="4" required><?php echo htmlspecialchars($data['pesan']); ?></textarea>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Rating <span class="text-danger">*</span></label>
                                    <select class="form-select" name="rating" required>
                                        <option value="5" <?php echo ($data['rating'] == 5) ? 'selected' : ''; ?>>⭐⭐⭐⭐⭐ (5 - Sangat Baik)</option>
                                        <option value="4" <?php echo ($data['rating'] == 4) ? 'selected' : ''; ?>>⭐⭐⭐⭐ (4 - Baik)</option>
                                        <option value="3" <?php echo ($data['rating'] == 3) ? 'selected' : ''; ?>>⭐⭐⭐ (3 - Cukup)</option>
                                        <option value="2" <?php echo ($data['rating'] == 2) ? 'selected' : ''; ?>>⭐⭐ (2 - Kurang)</option>
                                        <option value="1" <?php echo ($data['rating'] == 1) ? 'selected' : ''; ?>>⭐ (1 - Buruk)</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Status</label>
                                    <select class="form-select" name="status">
                                        <option value="Aktif" <?php echo ($data['status'] == 'Aktif') ? 'selected' : ''; ?>>Aktif</option>
                                        <option value="Tidak Aktif" <?php echo ($data['status'] == 'Tidak Aktif') ? 'selected' : ''; ?>>Tidak Aktif</option>
                                    </select>
                                </div>
                            </div>

                            <div class="d-flex gap-2">
                                <button class="btn btn-primary" type="submit">
                                    <i class="bi bi-check-lg me-1"></i>Simpan
                                </button>
                                <a href="data-manajemen-testimoni" class="btn btn-secondary">Batal</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

    <!-- Sidebar Toggle Script -->
    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebarOverlay');
            sidebar.classList.toggle('show');
            overlay.classList.toggle('show');
        }

        // Close sidebar on window resize to desktop
        window.addEventListener('resize', function() {
            if (window.innerWidth >= 992) {
                const sidebar = document.getElementById('sidebar');
                const overlay = document.getElementById('sidebarOverlay');
                sidebar.classList.remove('show');
                overlay.classList.remove('show');
            }
        });
    </script>
</body>
</html>
