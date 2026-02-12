<?php
// Determine current page for active state highlighting
$current_page = basename($_SERVER['SCRIPT_NAME']);
?>
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
            <a href="#menuCustomer" class="nav-link <?php echo in_array($current_page, ['manajemen-customer.php', 'data-manajemen-customer.php', 'edit-manajemen-customer.php']) ? 'active' : ''; ?>" data-bs-toggle="collapse" aria-expanded="<?php echo in_array($current_page, ['manajemen-customer.php', 'data-manajemen-customer.php', 'edit-manajemen-customer.php']) ? 'true' : 'false'; ?>">
                <i class="bi bi-people"></i>
                <span>Customer</span>
            </a>
            <ul class="nav-submenu collapse <?php echo in_array($current_page, ['manajemen-customer.php', 'data-manajemen-customer.php', 'edit-manajemen-customer.php']) ? 'show' : ''; ?>" id="menuCustomer">
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
            <a href="#menuBooking" class="nav-link <?php echo in_array($current_page, ['manajemen-booking.php', 'data-manajemen-booking.php']) ? 'active' : ''; ?>" data-bs-toggle="collapse" aria-expanded="<?php echo in_array($current_page, ['manajemen-booking.php', 'data-manajemen-booking.php']) ? 'true' : 'false'; ?>">
                <i class="bi bi-calendar-check"></i>
                <span>Booking</span>
            </a>
            <ul class="nav-submenu collapse <?php echo in_array($current_page, ['manajemen-booking.php', 'data-manajemen-booking.php']) ? 'show' : ''; ?>" id="menuBooking">
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
            <a href="#menuPaket" class="nav-link <?php echo in_array($current_page, ['manajemen-paket.php', 'data-manajemen-paket.php', 'edit-manajemen-paket.php']) ? 'active' : ''; ?>" data-bs-toggle="collapse" aria-expanded="<?php echo in_array($current_page, ['manajemen-paket.php', 'data-manajemen-paket.php', 'edit-manajemen-paket.php']) ? 'true' : 'false'; ?>">
                <i class="bi bi-suitcase-lg"></i>
                <span>Paket Wisata</span>
            </a>
            <ul class="nav-submenu collapse <?php echo in_array($current_page, ['manajemen-paket.php', 'data-manajemen-paket.php', 'edit-manajemen-paket.php']) ? 'show' : ''; ?>" id="menuPaket">
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
            <a href="#menuPembayaran" class="nav-link <?php echo in_array($current_page, ['manajemen-pembayaran.php', 'data-manajemen-pembayaran.php', 'edit-manajemen-pembayaran.php']) ? 'active' : ''; ?>" data-bs-toggle="collapse" aria-expanded="<?php echo in_array($current_page, ['manajemen-pembayaran.php', 'data-manajemen-pembayaran.php', 'edit-manajemen-pembayaran.php']) ? 'true' : 'false'; ?>">
                <i class="bi bi-credit-card"></i>
                <span>Pembayaran</span>
            </a>
            <ul class="nav-submenu collapse <?php echo in_array($current_page, ['manajemen-pembayaran.php', 'data-manajemen-pembayaran.php', 'edit-manajemen-pembayaran.php']) ? 'show' : ''; ?>" id="menuPembayaran">
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
