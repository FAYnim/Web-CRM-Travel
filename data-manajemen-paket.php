<?php
include 'config.php';

if($_SESSION['login'] != true) {
    header("Location: login");
}

// Ambil semua data paket
$paketList = [];
$result = $koneksi->query("SELECT * FROM manajemen_paket ORDER BY id DESC");
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $paketList[] = $row;
    }
}

$successMsg = $_GET['success'] ?? '';

$page_title = 'Data Paket Wisata';
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
            <?php if ($successMsg): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle me-2"></i><?php echo htmlspecialchars($successMsg); ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>

            <!-- Package Cards Grid -->
            <div class="row g-3 mb-4">
                <?php if (!$paketList): ?>
                    <div class="col-12">
                        <div class="dashboard-card">
                            <div class="card-body text-center text-muted py-5">
                                <i class="bi bi-suitcase-lg" style="font-size: 3rem;"></i>
                                <p class="mt-3">Belum ada paket yang ditambahkan.</p>
                                <a href="manajemen-paket" class="btn btn-primary btn-sm">Tambah Paket Pertama</a>
                            </div>
                        </div>
                    </div>
                <?php else: ?>
                    <?php foreach ($paketList as $p): ?>
                        <div class="col-sm-6 col-lg-4">
                            <div class="dashboard-card h-100">
                                <div style="height: 200px; overflow: hidden;">
                                    <img src="<?php echo htmlspecialchars($p['gambar']); ?>"
                                         alt="<?php echo htmlspecialchars($p['nama_paket']); ?>"
                                         class="w-100 h-100" style="object-fit: cover;">
                                </div>
                                <?php if (!empty($p['label'])): ?>
                                    <span class="badge bg-success position-absolute" style="top: 12px; right: 12px;">
                                        <?php echo htmlspecialchars($p['label']); ?>
                                    </span>
                                <?php endif; ?>
                                <div class="card-body p-3">
                                    <h6 class="fw-bold mb-2"><?php echo htmlspecialchars($p['nama_paket']); ?></h6>
                                    <div class="d-flex align-items-center gap-2 text-muted small mb-1">
                                        <i class="bi bi-calendar3"></i>
                                        <span><?php echo htmlspecialchars($p['durasi']); ?></span>
                                    </div>
                                    <div class="d-flex align-items-center gap-2 text-muted small mb-3">
                                        <i class="bi bi-geo-alt"></i>
                                        <span><?php echo htmlspecialchars($p['lokasi']); ?></span>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between pt-2 border-top">
                                        <div>
                                            <small class="text-muted d-block">Mulai dari</small>
                                            <span class="fw-bold text-success">Rp <?php echo number_format((int)$p['harga'], 0, ',', '.'); ?></span>
                                        </div>
                                        <div>
                                            <?php for ($i = 1; $i <= 5; $i++): ?>
                                                <i class="bi bi-star-fill small <?php echo ($i <= (int)$p['rating']) ? 'text-warning' : 'text-secondary opacity-25'; ?>"></i>
                                            <?php endfor; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>

            <!-- Admin Panel Table -->
            <div class="dashboard-card">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <span><i class="bi bi-gear me-2"></i>Panel Admin - Daftar Paket</span>
                    <a href="manajemen-paket" class="btn btn-primary btn-sm">
                        <i class="bi bi-plus-circle me-1"></i>Tambah Paket Baru
                    </a>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-dashboard">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Paket</th>
                                    <th>Durasi</th>
                                    <th>Lokasi</th>
                                    <th>Harga</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!$paketList): ?>
                                    <tr>
                                        <td colspan="6" class="text-center text-muted py-4">Belum ada data paket.</td>
                                    </tr>
                                <?php else: ?>
                                    <?php $no = 1; ?>
                                    <?php foreach ($paketList as $p): ?>
                                        <tr>
                                            <td><?php echo $no++; ?></td>
                                            <td>
                                                <?php echo htmlspecialchars($p['nama_paket']); ?>
                                                <?php if (!empty($p['label'])): ?>
                                                    <span class="badge bg-info"><?php echo htmlspecialchars($p['label']); ?></span>
                                                <?php endif; ?>
                                            </td>
                                            <td><?php echo htmlspecialchars($p['durasi']); ?></td>
                                            <td><?php echo htmlspecialchars($p['lokasi']); ?></td>
                                            <td>Rp <?php echo number_format((int)$p['harga'], 0, ',', '.'); ?></td>
                                            <td>
                                                <a href="edit-manajemen-paket?id=<?php echo $p['id']; ?>" class="btn btn-sm btn-warning">
                                                    <i class="bi bi-pencil"></i> Edit
                                                </a>
                                                <a href="src/api/hapus-manajemen-paket?id=<?php echo $p['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                                    <i class="bi bi-trash"></i> Hapus
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
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
