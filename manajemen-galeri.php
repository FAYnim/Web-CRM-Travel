<?php
include 'config.php';

if($_SESSION['login'] != true) {
    header("Location: login.php");
}

// Ambil semua data galeri
$galeriList = [];
$result = $koneksi->query("SELECT * FROM galeri ORDER BY id DESC");
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $galeriList[] = $row;
    }
}

// Handle edit mode
$editData = null;
if (isset($_GET["edit"]) && $_GET["edit"]) {
    $editId = (int)$_GET["edit"];
    if ($editId > 0) {
        $stmt = $koneksi->prepare("SELECT * FROM galeri WHERE id = ?");
        $stmt->bind_param("i", $editId);
        $stmt->execute();
        $result = $stmt->get_result();
        $editData = $result->fetch_assoc();
        $stmt->close();
    }
}

$successMsg = $_GET['success'] ?? '';
$errorMsg = $_GET['error'] ?? '';

$page_title = 'Manajemen Galeri';
$current_page = basename($_SERVER['SCRIPT_NAME']);
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
        .gallery-card {
            position: relative;
            overflow: hidden;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .gallery-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
        }
        .gallery-card .card-img-wrapper {
            height: 220px;
            overflow: hidden;
        }
        .gallery-card img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }
        .gallery-card:hover img {
            transform: scale(1.05);
        }
        .gallery-card .card-body {
            padding: 1rem;
        }
        .gallery-card .card-title {
            font-size: 1rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: #333;
        }
        .gallery-card .card-text {
            font-size: 0.875rem;
            color: #666;
            display: -webkit-box;
            /* -webkit-line-clamp: 2; */
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        .gallery-card .card-actions {
            position: absolute;
            top: 10px;
            right: 10px;
            display: flex;
            gap: 5px;
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        .gallery-card:hover .card-actions {
            opacity: 1;
        }
        .gallery-card .card-actions .btn {
            width: 32px;
            height: 32px;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.2);
        }
        .empty-gallery {
            text-align: center;
            padding: 4rem 2rem;
            color: #6c757d;
        }
        .empty-gallery i {
            font-size: 4rem;
            margin-bottom: 1rem;
            opacity: 0.5;
        }
        .form-section {
            background: #f8f9fa;
            border-radius: 12px;
            padding: 1.5rem;
            margin-bottom: 2rem;
        }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <?= include "sidebar.php" ?>

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
            <?php if ($successMsg): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle me-2"></i><?php echo htmlspecialchars($successMsg); ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>

            <?php if ($errorMsg): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="bi bi-exclamation-circle me-2"></i><?php echo htmlspecialchars($errorMsg); ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>

            <!-- Form Section -->
            <div class="form-section">
                <h5 class="mb-3">
                    <i class="bi bi-<?php echo $editData ? 'pencil-square' : 'plus-circle'; ?> me-2"></i>
                    <?php echo $editData ? 'Edit Foto Galeri' : 'Tambah Foto ke Galeri'; ?>
                </h5>
                <form method="POST" action="src/api/<?php echo $editData ? 'update-manajemen-galeri.php' : 'submit-manajemen-galeri.php'; ?>" enctype="multipart/form-data">
                    <?php if ($editData): ?>
                        <input type="hidden" name="id" value="<?php echo $editData['id']; ?>">
                    <?php endif; ?>

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Judul Foto <span class="text-danger">*</span></label>
                            <input type="text" name="judul" class="form-control" 
                                   value="<?php echo htmlspecialchars($editData['judul'] ?? ''); ?>" 
                                   placeholder="Masukkan judul foto" required>
                        </div>

                        <div class="col-md-5 mb-3">
                            <label class="form-label">Deskripsi</label>
                            <input type="text" name="deskripsi" class="form-control" 
                                   value="<?php echo htmlspecialchars($editData['deskripsi'] ?? ''); ?>" 
                                   placeholder="Deskripsi singkat foto (opsional)">
                        </div>

                        <div class="col-md-3 mb-3">
                            <label class="form-label">
                                <?php echo $editData ? 'Ganti Gambar' : 'Upload Gambar'; ?>
                                <?php if (!$editData): ?><span class="text-danger">*</span><?php endif; ?>
                            </label>
                            <input type="file" name="gambar" class="form-control" accept="image/*" <?php echo $editData ? '' : 'required'; ?>>
                            <?php if ($editData && $editData['gambar']): ?>
                                <small class="text-muted">Biarkan kosong jika tidak ingin mengganti gambar</small>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-check-lg me-1"></i>
                            <?php echo $editData ? 'Update' : 'Simpan'; ?>
                        </button>
                        <?php if ($editData): ?>
                            <a href="manajemen-galeri.php" class="btn btn-secondary">
                                <i class="bi bi-x-lg me-1"></i>Batal
                            </a>
                        <?php endif; ?>
                    </div>
                </form>
            </div>

            <!-- Gallery Grid -->
            <h5 class="mb-3"><i class="bi bi-grid-3x3-gap me-2"></i>Koleksi Galeri</h5>
            
            <?php if (!$galeriList): ?>
                <div class="empty-gallery">
                    <i class="bi bi-images"></i>
                    <h5>Galeri Masih Kosong</h5>
                    <p class="mb-0">Silakan tambahkan foto pertama Anda menggunakan form di atas.</p>
                </div>
            <?php else: ?>
                <div class="row g-4">
                    <?php foreach ($galeriList as $item): ?>
                        <div class="col-sm-6 col-md-4 col-lg-3">
                            <div class="gallery-card h-100">
                                <div class="card-actions">
                                    <a href="manajemen-galeri.php?edit=<?php echo $item['id']; ?>" 
                                       class="btn btn-warning btn-sm" title="Edit">
                                        <i class="bi bi-pencil-fill text-white"></i>
                                    </a>
                                    <a href="src/api/hapus-manajemen-galeri.php?id=<?php echo $item['id']; ?>" 
                                       class="btn btn-danger btn-sm" title="Hapus"
                                       onclick="return confirm('Apakah Anda yakin ingin menghapus foto ini?')">
                                        <i class="bi bi-trash-fill"></i>
                                    </a>
                                </div>
                                <div class="card-img-wrapper">
                                    <img src="<?php echo htmlspecialchars($item['gambar']); ?>" 
                                         alt="<?php echo htmlspecialchars($item['judul']); ?>"
                                         onerror="this.src='https://via.placeholder.com/400x300?text=No+Image'">
                                </div>
                                <div class="card-body">
                                    <h6 class="card-title"><?php echo htmlspecialchars($item['judul']); ?></h6>
                                    <?php if (!empty($item['deskripsi'])): ?>
                                        <p class="card-text"><?php echo htmlspecialchars($item['deskripsi']); ?></p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
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
