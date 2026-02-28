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

            <span class="nav-label">Landing Page</span>

            <!-- Kategori -->
            <li class="nav-item">
                <a href="manajemen-kategori.php" class="nav-link <?php echo $current_page === 'manajemen-kategori.php' ? 'active' : ''; ?>">
                    <i class="bi bi-tags"></i>
                    <span>Kategori</span>
                </a>
            </li>

            <!-- Galeri -->
            <li class="nav-item">
                <a href="manajemen-galeri.php" class="nav-link <?php echo $current_page === 'manajemen-galeri.php' ? 'active' : ''; ?>">
                    <i class="bi bi-images"></i>
                    <span>Galeri</span>
                </a>
            </li>

            <!-- Testimoni -->
            <li class="nav-item">
                <a href="manajemen-testimoni.php" class="nav-link <?php echo $current_page === 'manajemen-testimoni.php' ? 'active' : ''; ?>">
                    <i class="bi bi-chat-quote"></i>
                    <span>Testimoni</span>
                </a>
            </li>

            <!-- Partner Maskapai -->
            <li class="nav-item">
                <a href="manajemen-partner.php" class="nav-link <?php echo $current_page === 'manajemen-partner.php' ? 'active' : ''; ?>">
                    <i class="bi bi-airplane"></i>
                    <span>Partner Maskapai</span>
                </a>
            </li>

            <!-- Klien Korporasi -->
            <li class="nav-item">
                <a href="manajemen-klien.php" class="nav-link <?php echo $current_page === 'manajemen-klien.php' ? 'active' : ''; ?>">
                    <i class="bi bi-building"></i>
                    <span>Klien Korporasi</span>
                </a>
            </li>

            <!-- Profil -->
            <li class="nav-item">
                <a href="#menuProfil" class="nav-link" data-bs-toggle="collapse" aria-expanded="<?php echo in_array($current_page, ['profil-kontak.php', 'profil-tentang.php', 'profil-medsos.php']) ? 'true' : 'false'; ?>">
                    <i class="bi bi-gear"></i>
                    <span>Profil</span>
                </a>
                <ul class="nav-submenu collapse <?php echo in_array($current_page, ['profil-kontak.php', 'profil-tentang.php', 'profil-medsos.php']) ? 'show active' : ''; ?>" id="menuProfil">
                    <li class="nav-item">
                        <a href="profil-kontak.php" class="nav-link <?php echo $current_page === 'profil-kontak.php' ? 'active' : ''; ?>">
                            <span>Nomor Kontak</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="profil-tentang.php" class="nav-link <?php echo $current_page === 'profil-tentang.php' ? 'active' : ''; ?>">
                            <span>Tentang Kami</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="profil-medsos.php" class="nav-link <?php echo $current_page === 'profil-medsos.php' ? 'active' : ''; ?>">
                            <span>Media Sosial</span>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>

        <div class="sidebar-footer">
            <small>CRM Travel v1.0</small>
        </div>
    </aside>
