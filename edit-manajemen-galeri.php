<?php
include 'config.php';

if($_SESSION['login'] != true) {
    header("Location: login");
}

// Ambil data galeri berdasarkan ID
$editData = null;
if (isset($_GET["id"]) && $_GET["id"]) {
    $editId = (int)$_GET["id"];
    if ($editId > 0) {
        $result = mysqli_query($koneksi, "SELECT * FROM galeri WHERE id = $editId");
        $editData = mysqli_fetch_assoc($result);
    }
}

// Jika data tidak ditemukan, redirect ke data galeri
if (!$editData) {
    header("Location: data-manajemen-galeri?status=error&message=Data tidak ditemukan");
    exit;
}

$page_title = 'Edit Galeri';
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
    <style>
        .current-image {
            max-width: 300px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
    </style>
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
                            <i class="bi bi-pencil-square me-2"></i>Edit Foto Galeri
                        </div>
                        <div class="card-body">
                            <p class="text-muted mb-4">Silakan edit data foto dengan mengisi form di bawah ini</p>

                            <form method="POST" action="src/api/update-manajemen-galeri" enctype="multipart/form-data">
                                <input type="hidden" name="id" value="<?php echo $editData['id']; ?>">

                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <label for="judul" class="form-label">Judul Foto <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="judul" name="judul" 
                                               value="<?php echo htmlspecialchars($editData['judul']); ?>" 
                                               placeholder="Masukkan judul foto" required>
                                    </div>

                                    <div class="col-md-5 mb-3">
                                        <label for="deskripsi" class="form-label">Deskripsi</label>
                                        <input type="text" class="form-control" id="deskripsi" name="deskripsi" 
                                               value="<?php echo htmlspecialchars($editData['deskripsi'] ?? ''); ?>" 
                                               placeholder="Deskripsi singkat foto (opsional)">
                                    </div>

                                    <div class="col-md-3 mb-3">
                                        <label for="gambar" class="form-label">Ganti Gambar</label>
                                        <input type="file" class="form-control" id="gambar" name="gambar" accept="image/*">
                                        <small class="text-muted">Biarkan kosong jika tidak ingin mengganti gambar</small>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <label class="form-label">Gambar Saat Ini</label>
                                    <div>
                                        <img src="<?php echo htmlspecialchars($editData['gambar']); ?>" 
                                             alt="<?php echo htmlspecialchars($editData['judul']); ?>"
                                             class="current-image"
                                             onerror="this.src='https://via.placeholder.com/300x200?text=No+Image'">
                                    </div>
                                </div>

                                <div class="d-flex gap-2">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="bi bi-check-lg me-1"></i>Update
                                    </button>
                                    <a href="data-manajemen-galeri" class="btn btn-secondary">Batal</a>
                                </div>
                            </form>
                        </div>
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
