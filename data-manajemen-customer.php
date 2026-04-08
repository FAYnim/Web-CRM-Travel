<?php
include 'config.php';

if($_SESSION['login'] != true) {
    header("Location: login");
}

$page_title = 'Data Customer';
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
            <div class="dashboard-card">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <span><i class="bi bi-people me-2"></i>Data Customer</span>
                    <a href="manajemen-customer" class="btn btn-primary btn-sm">
                        <i class="bi bi-person-plus me-1"></i>Tambah Customer Baru
                    </a>
                </div>
                <div class="card-body p-0">
                    <p class="text-muted px-3 pt-3 mb-3">Berikut adalah data yang sudah terdaftar</p>
                    <div class="table-responsive">
                        <table class="table table-dashboard">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Handphone</th>
                                    <th>Alamat</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $data = mysqli_query($koneksi, "SELECT * FROM manajemen_customer");
                                $no = 0;
                                while ($baris = mysqli_fetch_array($data)){
                                    $no++;
                                ?>
                                <tr>
                                    <td><?php echo $no; ?></td>
                                    <td><?php echo htmlspecialchars($baris['nama']); ?></td>
                                    <td><?php echo htmlspecialchars($baris['email']); ?></td>
                                    <td><?php echo htmlspecialchars($baris['handphone']); ?></td>
                                    <td><?php echo htmlspecialchars($baris['alamat']); ?></td>
                                    <td>
                                        <a href="edit-manajemen-customer?id=<?php echo $baris['id'] ?>" class="btn btn-sm btn-warning">
                                            <i class="bi bi-pencil"></i> Edit
                                        </a>
                                        <a href="src/api/hapus-manajemen-customer?id=<?php echo $baris['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                            <i class="bi bi-trash"></i> Hapus
                                        </a>
                                    </td>
                                </tr>
                                <?php } ?>
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
