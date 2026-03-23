<?php
include 'config.php';

if($_SESSION['login'] != true) {
    header("Location: login");
}

$id = $_GET['id'];
$query = mysqli_query($koneksi, "SELECT * FROM manajemen_customer WHERE id='$id'");
$data = mysqli_fetch_array($query);

$page_title = 'Edit Customer';
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
                        <i class="bi bi-pencil-square me-2"></i>Edit Customer
                    </div>
                    <div class="card-body">
                        <p class="text-muted mb-4">Silakan edit data ini dengan benar</p>

                        <form method="POST" action="src/api/update-manajemen-customer">
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
                                <a href="data-manajemen-customer" class="btn btn-secondary">Batal</a>
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
