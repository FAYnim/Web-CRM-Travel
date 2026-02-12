<?php
include('config.php');

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

ob_start();
?>

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
                <a href="data-manajemen-customer.php" class="text-decoration-none small">Lihat semua <i class="bi bi-arrow-right"></i></a>
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
                <a href="data-manajemen-booking.php" class="text-decoration-none small">Lihat semua <i class="bi bi-arrow-right"></i></a>
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
                <a href="data-manajemen-paket.php" class="text-decoration-none small">Lihat semua <i class="bi bi-arrow-right"></i></a>
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
                <a href="data-manajemen-pembayaran.php" class="text-decoration-none small">Lihat semua <i class="bi bi-arrow-right"></i></a>
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
                    <a href="manajemen-customer.php" class="btn btn-outline-primary btn-sm">
                        <i class="bi bi-person-plus me-1"></i> Tambah Customer
                    </a>
                    <a href="manajemen-booking.php" class="btn btn-outline-success btn-sm">
                        <i class="bi bi-calendar-plus me-1"></i> Tambah Booking
                    </a>
                    <a href="manajemen-paket.php" class="btn btn-outline-warning btn-sm">
                        <i class="bi bi-plus-circle me-1"></i> Tambah Paket
                    </a>
                    <a href="manajemen-pembayaran.php" class="btn btn-outline-info btn-sm">
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
                <a href="data-manajemen-booking.php" class="btn btn-sm btn-outline-secondary">Lihat Semua</a>
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
                <a href="data-manajemen-pembayaran.php" class="btn btn-sm btn-outline-secondary">Lihat Semua</a>
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

<?php
$content = ob_get_clean();
include('layout.php');
?>
