<?php
include 'config.php';

if($_SESSION['login'] != true) {
    header("Location: login");
}

$editData = null;

// Handle edit (ngambil data)
if (isset($_GET["id"]) && $_GET["id"]) {
    $id = (int)$_GET["id"];
    if ($id > 0) {
        $stmt = $koneksi->prepare("SELECT * FROM manajemen_paket WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $editData = $result->fetch_assoc();
        $stmt->close();
    }
}

$page_title = $editData ? 'Edit Paket Wisata' : 'Tambah Paket Wisata';
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
            <div class="row justify-content-center">
                <div class="dashboard-card">
                    <div class="card-header">
                        <i class="bi bi-<?php echo $editData ? 'pencil-square' : 'suitcase-lg'; ?> me-2"></i>
                        <?php echo $editData ? 'Edit' : 'Tambah'; ?> Paket Wifi
                    </div>
                    <div class="card-body">
                        <form method="POST" action="src/api/<?php echo $editData ? 'update-manajemen-paket' : 'submit-manajemen-paket'; ?>" enctype="multipart/form-data">
                            <?php if ($editData): ?>
                                <input type="hidden" name="id" value="<?php echo $editData['id']; ?>">
                            <?php endif; ?>

                            <div class="mb-3">
                                <label class="form-label">Nama Paket</label>
                                <input type="text" name="nama_paket" class="form-control" value="<?php echo htmlspecialchars($editData['nama_paket'] ?? ''); ?>" placeholder="Bali Paradise Escape" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Durasi</label>
                                <div class="row g-2">
                                    <div class="col">
                                        <input type="number" name="durasi_hari" class="form-control" min="1" value="<?php echo isset($editData['durasi']) ? (int)explode(' ', $editData['durasi'])[0] : ''; ?>" placeholder="Hari" required>
                                    </div>
                                    <div class="col">
                                        <input type="number" name="durasi_malam" class="form-control" min="0" value="<?php echo isset($editData['durasi']) ? (int)explode(' ', $editData['durasi'])[2] : ''; ?>" placeholder="Malam" required>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Lokasi</label>
                                <input type="text" name="lokasi" class="form-control" value="<?php echo htmlspecialchars($editData['lokasi'] ?? ''); ?>" placeholder="Bali, Indonesia" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Harga (Rp)</label>
                                <input type="text" name="harga" class="form-control" maxlength="18" value="<?php echo htmlspecialchars($editData['harga'] ?? ''); ?>" placeholder="4500000" required oninput="this.value=this.value.replace(/[^0-9]/g,'');">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Upload Gambar</label>
                                <input type="file" name="gambar" class="form-control" accept="image/*" <?php echo empty($editData['gambar']) ? 'required' : ''; ?>>
                                <?php if (!empty($editData['gambar'])): ?>
                                    <div class="mt-2">
                                        <img src="<?php echo htmlspecialchars($editData['gambar']); ?>" alt="Preview" style="max-width: 200px; max-height: 150px;">
                                    </div>
                                <?php endif; ?>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Label</label>
                                <div>
                                    <?php $labelOptions = ['Promo', 'Hot Deal', 'Best Seller', 'Baru', 'Spesial']; ?>
                                    <?php foreach ($labelOptions as $label): ?>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="label" id="label_<?php echo $label; ?>" value="<?php echo $label; ?>" <?php echo (isset($editData['label']) && $editData['label'] == $label) ? 'checked' : ''; ?>>
                                            <label class="form-check-label" for="label_<?php echo $label; ?>"><?php echo $label; ?></label>
                                        </div>
                                    <?php endforeach; ?>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="label" id="label_none" value="" <?php echo (empty($editData['label'])) ? 'checked' : ''; ?>>
                                        <label class="form-check-label" for="label_none">Tanpa Label</label>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Rating (1-5)</label>
                                <input type="number" name="rating" class="form-control" min="1" max="5" value="<?php echo htmlspecialchars($editData['rating'] ?? 5); ?>" required>
                            </div>

                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-check-lg me-1"></i><?php echo $editData ? 'Perbarui' : 'Simpan'; ?>
                                </button>
                                <a href="data-manajemen-paket" class="btn btn-secondary">Batal</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.ivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

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
