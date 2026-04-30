<?php
include 'config.php';

if($_SESSION['login'] != true) {
    header("Location: login");
}

$query_booking = mysqli_query($koneksi, "SELECT b.id,
                                                c.nama AS customer,
                                                p.nama_paket AS paket,
                                                p.harga AS harga
                                         FROM manajemen_booking b
                                         LEFT JOIN manajemen_customer c ON b.customer_id = c.id
                                         LEFT JOIN manajemen_paket p ON b.paket_id = p.id
                                         ORDER BY b.id DESC");
$bookings = mysqli_fetch_all($query_booking, MYSQLI_ASSOC);

$page_title = 'Tambah Pembayaran';
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
                <div class="col-lg-12 col-xl-12">
                    <div class="dashboard-card">
                        <div class="card-header">
                            <i class="bi bi-cash-stack me-2"></i>Tambah Pembayaran Baru
                        </div>
                        <div class="card-body">
                            <p class="text-muted mb-4">Silakan isi data di bawah ini dengan benar</p>

                            <form method="POST" action="src/api/submit-manajemen-pembayaran" enctype="multipart/form-data">
                                
                                <div class="mb-3">
                                    <label class="form-label">Kode Booking</label>
                                    <select autofocus name="booking_id" id="bookingSelect" class="form-select" required>
                                        <option value="">Pilih Kode Booking</option>
                                        <?php foreach($bookings as $booking): ?>
                                            <?php $kode_booking = 'ID' . $booking['id'] . ' - ' . ($booking['customer'] ?? '-') . ' - ' . ($booking['paket'] ?? '-'); ?>
                                            <option value="<?php echo (int) $booking['id']; ?>" data-harga="<?php echo (int) ($booking['harga'] ?? 0); ?>">
                                                <?php echo htmlspecialchars($kode_booking); ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                    <div id="hargaPaketBox" class="alert alert-info mt-3 d-none">
                                        <div class="small text-muted">Harga Paket</div>
                                        <div class="fw-semibold" id="hargaPaketText">Rp 0</div>
                                    </div>
                                    <?php if(empty($bookings)): ?>
                                        <div class="form-text text-danger">Belum ada data booking. Tambahkan booking terlebih dahulu.</div>
                                    <?php endif; ?>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Jumlah:</label>
                                    <input class="form-control" type="number" min="0" name="jumlah" placeholder="Isi dengan jumlah yang dibayarkan" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Tanggal Pembayaran:</label>
                                    <input class="form-control" type="date" name="tanggal" placeholder="Isi Dengan Tanggal..." required>
                                </div>

                                <div class="mb-3">
<label class="form-label">Metode Pembayaran</label>

<div class="form-check">
<input class="form-check-input" type="radio" name="metode" value="transfer bank" required>
<label class="form-check-label">
<i class="fa-solid fa-building-columns text-primary"></i>
Transfer Bank
</label>
</div>

<div class="form-check">
<input class="form-check-input" type="radio" name="metode" value="qris">
<label class="form-check-label">
<i class="fa-solid fa-qrcode text-success"></i>
QRIS
</label>
</div>

<div class="form-check">
<input class="form-check-input" type="radio" name="metode" value="cash">
<label class="form-check-label">
<i class="fa-solid fa-money-bill text-warning"></i>
Cash
</label>
</div>

</div>

<div class="mb-3">
<label class="form-label">Upload Bukti Transfer</label>
<input type="file" name="bukti_transfer" class="form-control" accept=".jpg,.jpeg,.png,.webp,.pdf">
</div>

<button class="btn btn-success">
<i class="fa-solid fa-floppy-disk"></i> Simpan Pembayaran
</button>
                                    <a href="data-manajemen-pembayaran" class="btn btn-secondary">Batal</a>
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

        const bookingSelect = document.getElementById('bookingSelect');
        const hargaPaketBox = document.getElementById('hargaPaketBox');
        const hargaPaketText = document.getElementById('hargaPaketText');

        function updateHargaPaket() {
            const selectedOption = bookingSelect.options[bookingSelect.selectedIndex];
            const harga = Number(selectedOption.dataset.harga || 0);

            if (!bookingSelect.value || harga <= 0) {
                hargaPaketBox.classList.add('d-none');
                hargaPaketText.textContent = 'Rp 0';
                return;
            }

            hargaPaketText.textContent = new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                maximumFractionDigits: 0
            }).format(harga);
            hargaPaketBox.classList.remove('d-none');
        }

        bookingSelect.addEventListener('change', updateHargaPaket);
    </script>
</body>
</html>




