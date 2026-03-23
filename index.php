<?php
include 'config.php';

// print_r($_SESSION);
if($_SESSION['login'] != true) {
    header("Location: login");
}

$page_title = 'Dashboard';

// Get statistics
$total_customer = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) as total FROM manajemen_customer"))['total'];
$total_booking = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) as total FROM manajemen_booking"))['total'];
$total_paket = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) as total FROM manajemen_paket"))['total'];
$total_pembayaran = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) as total FROM manajemen_pembayaran"))['total'];

// Get total revenue
$total_revenue = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COALESCE(SUM(jumlah), 0) as total FROM manajemen_pembayaran"))['total'];

// Get recent bookings (last 5)
$recent_bookings = mysqli_query($koneksi, "SELECT b.id, c.nama as customer, p.nama_paket as paket, b.tanggal 
                                            FROM manajemen_booking b 
                                            LEFT JOIN manajemen_customer c ON b.customer_id = c.id 
                                            LEFT JOIN manajemen_paket p ON b.paket_id = p.id 
                                            ORDER BY b.id DESC LIMIT 5");

// Get recent payments (last 5)
$recent_payments = mysqli_query($koneksi, "SELECT * FROM manajemen_pembayaran ORDER BY id DESC LIMIT 5");

// Determine current page for active state highlighting
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
            <!-- Stat Cards -->
            <div class="row g-3 mb-4">
                <div class="col-sm-6 col-xl-3">
                    <div class="stat-card">
                        <div class="d-flex align-items-start justify-content-between">
                            <div>
                                <p class="stat-label">Total Customer</p>
                                <p class="stat-value"><?php echo number_format($total_customer); ?></p>
                            </div>
                            <div class="stat-icon bg-primary-subtle">
                                <i class="bi bi-people"></i>
                            </div>
                        </div>
                        <div class="mt-3">
                            <a href="data-manajemen-customer" class="text-decoration-none small">Lihat semua <i class="bi bi-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-3">
                    <div class="stat-card">
                        <div class="d-flex align-items-start justify-content-between">
                            <div>
                                <p class="stat-label">Total Booking</p>
                                <p class="stat-value"><?php echo number_format($total_booking); ?></p>
                            </div>
                            <div class="stat-icon bg-success-subtle">
                                <i class="bi bi-calendar-check"></i>
                            </div>
                        </div>
                        <div class="mt-3">
                            <a href="data-manajemen-booking" class="text-decoration-none small">Lihat semua <i class="bi bi-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-3">
                    <div class="stat-card">
                        <div class="d-flex align-items-start justify-content-between">
                            <div>
                                <p class="stat-label">Total Paket</p>
                                <p class="stat-value"><?php echo number_format($total_paket); ?></p>
                            </div>
                            <div class="stat-icon bg-warning-subtle">
                                <i class="bi bi-suitcase-lg"></i>
                            </div>
                        </div>
                        <div class="mt-3">
                            <a href="data-manajemen-paket" class="text-decoration-none small">Lihat semua <i class="bi bi-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-3">
                    <div class="stat-card">
                        <div class="d-flex align-items-start justify-content-between">
                            <div>
                                <p class="stat-label">Total Pendapatan</p>
                                <p class="stat-value" style="font-size: 1.4rem;">Rp <?php echo number_format($total_revenue, 0, ',', '.'); ?></p>
                            </div>
                            <div class="stat-icon bg-info-subtle">
                                <i class="bi bi-credit-card"></i>
                            </div>
                        </div>
                        <div class="mt-3">
                            <a href="data-manajemen-pembayaran" class="text-decoration-none small">Lihat semua <i class="bi bi-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="row g-3 mb-4">
                <div class="col-12">
                    <div class="dashboard-card">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <span><i class="bi bi-lightning me-2"></i>Aksi Cepat</span>
                        </div>
                        <div class="card-body">
                            <div class="d-flex flex-wrap gap-2">
                                <a href="manajemen-customer" class="btn btn-outline-primary btn-sm">
                                    <i class="bi bi-person-plus me-1"></i> Tambah Customer
                                </a>
                                <a href="manajemen-booking" class="btn btn-outline-success btn-sm">
                                    <i class="bi bi-calendar-plus me-1"></i> Tambah Booking
                                </a>
                                <a href="manajemen-paket" class="btn btn-outline-warning btn-sm">
                                    <i class="bi bi-plus-circle me-1"></i> Tambah Paket
                                </a>
                                <a href="manajemen-pembayaran" class="btn btn-outline-info btn-sm">
                                    <i class="bi bi-cash-stack me-1"></i> Tambah Pembayaran
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Data Tables -->
            <div class="row g-3">
                <!-- Recent Bookings -->
                <div class="col-lg-6">
                    <div class="dashboard-card">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <span><i class="bi bi-calendar-check me-2"></i>Booking Terbaru</span>
                            <a href="data-manajemen-booking" class="btn btn-sm btn-outline-secondary">Lihat Semua</a>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-dashboard">
                                    <thead>
                                        <tr>
                                            <th>Customer</th>
                                            <th>Paket</th>
                                            <th>Tanggal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (mysqli_num_rows($recent_bookings) > 0): ?>
                                            <?php while ($row = mysqli_fetch_assoc($recent_bookings)): ?>
                                            <tr>
                                                <td>
                                                    <i class="bi bi-person-circle me-1 text-muted"></i>
                                                    <?php echo htmlspecialchars($row['customer'] ?? '-'); ?>
                                                </td>
                                                <td><?php echo htmlspecialchars($row['paket'] ?? '-'); ?></td>
                                                <td>
                                                    <span class="text-muted">
                                                        <?php echo $row['tanggal'] ? date('d M Y', strtotime($row['tanggal'])) : '-'; ?>
                                                    </span>
                                                </td>
                                            </tr>
                                            <?php endwhile; ?>
                                        <?php else: ?>
                                            <tr>
                                                <td colspan="3" class="text-center text-muted py-4">Belum ada data booking</td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Payments -->
                <div class="col-lg-6">
                    <div class="dashboard-card">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <span><i class="bi bi-credit-card me-2"></i>Pembayaran Terbaru</span>
                            <a href="data-manajemen-pembayaran" class="btn btn-sm btn-outline-secondary">Lihat Semua</a>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-dashboard">
                                    <thead>
                                        <tr>
                                            <th>Booking</th>
                                            <th>Jumlah</th>
                                            <th>Metode</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (mysqli_num_rows($recent_payments) > 0): ?>
                                            <?php while ($row = mysqli_fetch_assoc($recent_payments)): ?>
                                            <tr>
                                                <td><?php echo htmlspecialchars($row['booking']); ?></td>
                                                <td>
                                                    <span class="fw-semibold text-success">
                                                        Rp <?php echo number_format($row['jumlah'], 0, ',', '.'); ?>
                                                    </span>
                                                </td>
                                                <td>
                                                    <span class="badge <?php echo $row['metode'] === 'transfer' ? 'bg-primary' : 'bg-secondary'; ?>">
                                                        <?php echo htmlspecialchars($row['metode']); ?>
                                                    </span>
                                                </td>
                                            </tr>
                                            <?php endwhile; ?>
                                        <?php else: ?>
                                            <tr>
                                                <td colspan="3" class="text-center text-muted py-4">Belum ada data pembayaran</td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
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
