<?php
include 'config.php';

if($_SESSION['login'] != true) {
    header("Location: login.php");
}

$page_title = 'Tambah Customer';
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
</head>
<body>

    <!-- Sidebar -->
    <aside class="sidebar" id="sidebar">
        <a href="index.php" class="sidebar-brand">
            <i class="bi bi-airplane-engines"></i>
            <span>CRM Travel</span>
        </a>

        <ul class="sidebar-nav">
            <!-- Dashboard -->
            <li class="nav-item">
                <a href="index.php" class="nav-link <?php echo $current_page === 'index.php' ? 'active' : ''; ?>">
                    <i class="bi bi-grid-1x2"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <span class="nav-label">Manajemen</span>

            <!-- Customer -->
            <li class="nav-item">
                <a href="#menuCustomer" class="nav-link" data-bs-toggle="collapse" aria-expanded="<?php echo in_array($current_page, ['manajemen-customer.php', 'data-manajemen-customer.php', 'edit-manajemen-customer.php']) ? 'true' : 'false'; ?>">
                    <i class="bi bi-people"></i>
                    <span>Customer</span>
                </a>
                <ul class="nav-submenu collapse <?php echo in_array($current_page, ['manajemen-customer.php', 'data-manajemen-customer.php', 'edit-manajemen-customer.php']) ? 'show active' : ''; ?>" id="menuCustomer">
                    <li class="nav-item">
                        <a href="data-manajemen-customer.php" class="nav-link <?php echo $current_page === 'data-manajemen-customer.php' ? 'active' : ''; ?>">
                            <span>Data Customer</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="manajemen-customer.php" class="nav-link <?php echo $current_page === 'manajemen-customer.php' ? 'active' : ''; ?>">
                            <span>Tambah Customer</span>
                        </a>
                    </li>
                </ul>
            </li>

            <!-- Booking -->
            <li class="nav-item">
                <a href="#menuBooking" class="nav-link" data-bs-toggle="collapse" aria-expanded="<?php echo in_array($current_page, ['manajemen-booking.php', 'data-manajemen-booking.php']) ? 'true' : 'false'; ?>">
                    <i class="bi bi-calendar-check"></i>
                    <span>Booking</span>
                </a>
                <ul class="nav-submenu collapse <?php echo in_array($current_page, ['manajemen-booking.php', 'data-manajemen-booking.php']) ? 'show active' : ''; ?>" id="menuBooking">
                    <li class="nav-item">
                        <a href="data-manajemen-booking.php" class="nav-link <?php echo $current_page === 'data-manajemen-booking.php' ? 'active' : ''; ?>">
                            <span>Data Booking</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="manajemen-booking.php" class="nav-link <?php echo $current_page === 'manajemen-booking.php' ? 'active' : ''; ?>">
                            <span>Tambah Booking</span>
                        </a>
                    </li>
                </ul>
            </li>

            <!-- Paket Wisata -->
            <li class="nav-item">
                <a href="#menuPaket" class="nav-link" data-bs-toggle="collapse" aria-expanded="<?php echo in_array($current_page, ['manajemen-paket.php', 'data-manajemen-paket.php', 'edit-manajemen-paket.php']) ? 'true' : 'false'; ?>">
                    <i class="bi bi-suitcase-lg"></i>
                    <span>Paket Wisata</span>
                </a>
                <ul class="nav-submenu collapse <?php echo in_array($current_page, ['manajemen-paket.php', 'data-manajemen-paket.php', 'edit-manajemen-paket.php']) ? 'show active' : ''; ?>" id="menuPaket">
                    <li class="nav-item">
                        <a href="data-manajemen-paket.php" class="nav-link <?php echo $current_page === 'data-manajemen-paket.php' ? 'active' : ''; ?>">
                            <span>Data Paket</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="manajemen-paket.php" class="nav-link <?php echo $current_page === 'manajemen-paket.php' ? 'active' : ''; ?>">
                            <span>Tambah Paket</span>
                        </a>
                    </li>
                </ul>
            </li>

            <!-- Pembayaran -->
            <li class="nav-item">
                <a href="#menuPembayaran" class="nav-link" data-bs-toggle="collapse" aria-expanded="<?php echo in_array($current_page, ['manajemen-pembayaran.php', 'data-manajemen-pembayaran.php', 'edit-manajemen-pembayaran.php']) ? 'true' : 'false'; ?>">
                    <i class="bi bi-credit-card"></i>
                    <span>Pembayaran</span>
                </a>
                <ul class="nav-submenu collapse <?php echo in_array($current_page, ['manajemen-pembayaran.php', 'data-manajemen-pembayaran.php', 'edit-manajemen-pembayaran.php']) ? 'show active   ' : ''; ?>" id="menuPembayaran">
                    <li class="nav-item">
                        <a href="data-manajemen-pembayaran.php" class="nav-link <?php echo $current_page === 'data-manajemen-pembayaran.php' ? 'active' : ''; ?>">
                            <span>Data Pembayaran</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="manajemen-pembayaran.php" class="nav-link <?php echo $current_page === 'manajemen-pembayaran.php' ? 'active' : ''; ?>">
                            <span>Tambah Pembayaran</span>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>

        <div class="sidebar-footer">
            <small>CRM Travel v1.0</small>
        </div>
    </aside>

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
            <div class="row">
                <div class="col-lg-12 col-xl-12">
                    <div class="dashboard-card">
                        <div class="card-header">
                            <i class="bi bi-person-plus me-2"></i>Tambah Customer Baru
                        </div>
                        <div class="card-body">
                            <p class="text-muted mb-4">Silakan isi data-dessous ini dengan benar</p>

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
