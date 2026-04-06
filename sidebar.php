    <aside class="sidebar" id="sidebar">
<<<<<<< HEAD
        <a href="index.php" class="sidebar-brand">
=======
        <a href="index" class="sidebar-brand">
>>>>>>> 06752c650dbc56340aebe3dd4093532eaa753ef5
            <i class="bi bi-airplane-engines"></i>
            <span>CRM Travel</span>
        </a>

        <ul class="sidebar-nav">
            <!-- Dashboard -->
            <li class="nav-item">
<<<<<<< HEAD
                <a href="index.php" class="nav-link <?php echo $current_page === 'index.php' ? 'active' : ''; ?>">
=======
                <a href="index" class="nav-link <?php echo $current_page === 'index' ? 'active' : ''; ?>">
>>>>>>> 06752c650dbc56340aebe3dd4093532eaa753ef5
                    <i class="bi bi-grid-1x2"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <span class="nav-label">Manajemen</span>

            <!-- Customer -->
            <li class="nav-item">
<<<<<<< HEAD
                <a href="#menuCustomer" class="nav-link" data-bs-toggle="collapse" aria-expanded="<?php echo in_array($current_page, ['manajemen-customer.php', 'data-manajemen-customer.php', 'edit-manajemen-customer.php']) ? 'true' : 'false'; ?>">
                    <i class="bi bi-people"></i>
                    <span>Customer</span>
                </a>
                <ul class="nav-submenu collapse <?php echo in_array($current_page, ['manajemen-customer.php', 'data-manajemen-customer.php', 'edit-manajemen-customer.php']) ? 'show active' : ''; ?>" id="menuCustomer">
                    <li class="nav-item">
                        <a href="data-manajemen-customer.php" class="nav-link <?php echo $current_page === 'data-manajemen-customer.php' ? 'active' : ''; ?>">
=======
                <a href="#menuCustomer" class="nav-link" data-bs-toggle="collapse" aria-expanded="<?php echo in_array($current_page, ['manajemen-customer', 'data-manajemen-customer', 'edit-manajemen-customer']) ? 'true' : 'false'; ?>">
                    <i class="bi bi-people"></i>
                    <span>Customer</span>
                </a>
                <ul class="nav-submenu collapse <?php echo in_array($current_page, ['manajemen-customer', 'data-manajemen-customer', 'edit-manajemen-customer']) ? 'show active' : ''; ?>" id="menuCustomer">
                    <li class="nav-item">
                        <a href="data-manajemen-customer" class="nav-link <?php echo $current_page === 'data-manajemen-customer' ? 'active' : ''; ?>">
>>>>>>> 06752c650dbc56340aebe3dd4093532eaa753ef5
                            <span>Data Customer</span>
                        </a>
                    </li>
                    <li class="nav-item">
<<<<<<< HEAD
                        <a href="manajemen-customer.php" class="nav-link <?php echo $current_page === 'manajemen-customer.php' ? 'active' : ''; ?>">
=======
                        <a href="manajemen-customer" class="nav-link <?php echo $current_page === 'manajemen-customer' ? 'active' : ''; ?>">
>>>>>>> 06752c650dbc56340aebe3dd4093532eaa753ef5
                            <span>Tambah Customer</span>
                        </a>
                    </li>
                </ul>
            </li>

            <!-- Booking -->
            <li class="nav-item">
<<<<<<< HEAD
                <a href="#menuBooking" class="nav-link" data-bs-toggle="collapse" aria-expanded="<?php echo in_array($current_page, ['manajemen-booking.php', 'data-manajemen-booking.php']) ? 'true' : 'false'; ?>">
                    <i class="bi bi-calendar-check"></i>
                    <span>Booking</span>
                </a>
                <ul class="nav-submenu collapse <?php echo in_array($current_page, ['manajemen-booking.php', 'data-manajemen-booking.php']) ? 'show active' : ''; ?>" id="menuBooking">
                    <li class="nav-item">
                        <a href="data-manajemen-booking.php" class="nav-link <?php echo $current_page === 'data-manajemen-booking.php' ? 'active' : ''; ?>">
=======
                <a href="#menuBooking" class="nav-link" data-bs-toggle="collapse" aria-expanded="<?php echo in_array($current_page, ['manajemen-booking', 'data-manajemen-booking']) ? 'true' : 'false'; ?>">
                    <i class="bi bi-calendar-check"></i>
                    <span>Booking</span>
                </a>
                <ul class="nav-submenu collapse <?php echo in_array($current_page, ['manajemen-booking', 'data-manajemen-booking']) ? 'show active' : ''; ?>" id="menuBooking">
                    <li class="nav-item">
                        <a href="data-manajemen-booking" class="nav-link <?php echo $current_page === 'data-manajemen-booking' ? 'active' : ''; ?>">
>>>>>>> 06752c650dbc56340aebe3dd4093532eaa753ef5
                            <span>Data Booking</span>
                        </a>
                    </li>
                    <li class="nav-item">
<<<<<<< HEAD
                        <a href="manajemen-booking.php" class="nav-link <?php echo $current_page === 'manajemen-booking.php' ? 'active' : ''; ?>">
=======
                        <a href="manajemen-booking" class="nav-link <?php echo $current_page === 'manajemen-booking' ? 'active' : ''; ?>">
>>>>>>> 06752c650dbc56340aebe3dd4093532eaa753ef5
                            <span>Tambah Booking</span>
                        </a>
                    </li>
                </ul>
            </li>

            <!-- Paket Wisata -->
            <li class="nav-item">
<<<<<<< HEAD
                <a href="#menuPaket" class="nav-link" data-bs-toggle="collapse" aria-expanded="<?php echo in_array($current_page, ['manajemen-paket.php', 'data-manajemen-paket.php', 'edit-manajemen-paket.php']) ? 'true' : 'false'; ?>">
                    <i class="bi bi-suitcase-lg"></i>
                    <span>Paket Wisata</span>
                </a>
                <ul class="nav-submenu collapse <?php echo in_array($current_page, ['manajemen-paket.php', 'data-manajemen-paket.php', 'edit-manajemen-paket.php']) ? 'show active' : ''; ?>" id="menuPaket">
                    <li class="nav-item">
                        <a href="data-manajemen-paket.php" class="nav-link <?php echo $current_page === 'data-manajemen-paket.php' ? 'active' : ''; ?>">
=======
                <a href="#menuPaket" class="nav-link" data-bs-toggle="collapse" aria-expanded="<?php echo in_array($current_page, ['manajemen-paket', 'data-manajemen-paket', 'edit-manajemen-paket']) ? 'true' : 'false'; ?>">
                    <i class="bi bi-suitcase-lg"></i>
                    <span>Paket Wisata</span>
                </a>
                <ul class="nav-submenu collapse <?php echo in_array($current_page, ['manajemen-paket', 'data-manajemen-paket', 'edit-manajemen-paket']) ? 'show active' : ''; ?>" id="menuPaket">
                    <li class="nav-item">
                        <a href="data-manajemen-paket" class="nav-link <?php echo $current_page === 'data-manajemen-paket' ? 'active' : ''; ?>">
>>>>>>> 06752c650dbc56340aebe3dd4093532eaa753ef5
                            <span>Data Paket</span>
                        </a>
                    </li>
                    <li class="nav-item">
<<<<<<< HEAD
                        <a href="manajemen-paket.php" class="nav-link <?php echo $current_page === 'manajemen-paket.php' ? 'active' : ''; ?>">
=======
                        <a href="manajemen-paket" class="nav-link <?php echo $current_page === 'manajemen-paket' ? 'active' : ''; ?>">
>>>>>>> 06752c650dbc56340aebe3dd4093532eaa753ef5
                            <span>Tambah Paket</span>
                        </a>
                    </li>
                </ul>
            </li>

            <!-- Pembayaran -->
            <li class="nav-item">
<<<<<<< HEAD
                <a href="#menuPembayaran" class="nav-link" data-bs-toggle="collapse" aria-expanded="<?php echo in_array($current_page, ['manajemen-pembayaran.php', 'data-manajemen-pembayaran.php', 'edit-manajemen-pembayaran.php']) ? 'true' : 'false'; ?>">
                    <i class="bi bi-credit-card"></i>
                    <span>Pembayaran</span>
                </a>
                <ul class="nav-submenu collapse <?php echo in_array($current_page, ['manajemen-pembayaran.php', 'data-manajemen-pembayaran.php', 'edit-manajemen-pembayaran.php']) ? 'show active   ' : ''; ?>" id="menuPembayaran">
                    <li class="nav-item">
                        <a href="data-manajemen-pembayaran.php" class="nav-link <?php echo $current_page === 'data-manajemen-pembayaran.php' ? 'active' : ''; ?>">
=======
                <a href="#menuPembayaran" class="nav-link" data-bs-toggle="collapse" aria-expanded="<?php echo in_array($current_page, ['manajemen-pembayaran', 'data-manajemen-pembayaran', 'edit-manajemen-pembayaran']) ? 'true' : 'false'; ?>">
                    <i class="bi bi-credit-card"></i>
                    <span>Pembayaran</span>
                </a>
                <ul class="nav-submenu collapse <?php echo in_array($current_page, ['manajemen-pembayaran', 'data-manajemen-pembayaran', 'edit-manajemen-pembayaran']) ? 'show active   ' : ''; ?>" id="menuPembayaran">
                    <li class="nav-item">
                        <a href="data-manajemen-pembayaran" class="nav-link <?php echo $current_page === 'data-manajemen-pembayaran' ? 'active' : ''; ?>">
>>>>>>> 06752c650dbc56340aebe3dd4093532eaa753ef5
                            <span>Data Pembayaran</span>
                        </a>
                    </li>
                    <li class="nav-item">
<<<<<<< HEAD
                        <a href="manajemen-pembayaran.php" class="nav-link <?php echo $current_page === 'manajemen-pembayaran.php' ? 'active' : ''; ?>">
=======
                        <a href="manajemen-pembayaran" class="nav-link <?php echo $current_page === 'manajemen-pembayaran' ? 'active' : ''; ?>">
>>>>>>> 06752c650dbc56340aebe3dd4093532eaa753ef5
                            <span>Tambah Pembayaran</span>
                        </a>
                    </li>
                </ul>
            </li>

            <span class="nav-label">Landing Page</span>

            <!-- Kategori -->
            <li class="nav-item">
<<<<<<< HEAD
                <a href="#menuKategori" class="nav-link" data-bs-toggle="collapse" aria-expanded="<?php echo in_array($current_page, ['manajemen-kategori.php', 'data-manajemen-kategori.php', 'edit-manajemen-kategori.php']) ? 'true' : 'false'; ?>">
                    <i class="bi bi-tags"></i>
                    <span>Kategori</span>
                </a>
                <ul class="nav-submenu collapse <?php echo in_array($current_page, ['manajemen-kategori.php', 'data-manajemen-kategori.php', 'edit-manajemen-kategori.php']) ? 'show active' : ''; ?>" id="menuKategori">
                    <li class="nav-item">
                        <a href="data-manajemen-kategori.php" class="nav-link <?php echo $current_page === 'data-manajemen-kategori.php' ? 'active' : ''; ?>">
=======
                <a href="#menuKategori" class="nav-link" data-bs-toggle="collapse" aria-expanded="<?php echo in_array($current_page, ['manajemen-kategori', 'data-manajemen-kategori', 'edit-manajemen-kategori']) ? 'true' : 'false'; ?>">
                    <i class="bi bi-tags"></i>
                    <span>Kategori</span>
                </a>
                <ul class="nav-submenu collapse <?php echo in_array($current_page, ['manajemen-kategori', 'data-manajemen-kategori', 'edit-manajemen-kategori']) ? 'show active' : ''; ?>" id="menuKategori">
                    <li class="nav-item">
                        <a href="data-manajemen-kategori" class="nav-link <?php echo $current_page === 'data-manajemen-kategori' ? 'active' : ''; ?>">
>>>>>>> 06752c650dbc56340aebe3dd4093532eaa753ef5
                            <span>Data Kategori</span>
                        </a>
                    </li>
                    <li class="nav-item">
<<<<<<< HEAD
                        <a href="manajemen-kategori.php" class="nav-link <?php echo $current_page === 'manajemen-kategori.php' ? 'active' : ''; ?>">
=======
                        <a href="manajemen-kategori" class="nav-link <?php echo $current_page === 'manajemen-kategori' ? 'active' : ''; ?>">
>>>>>>> 06752c650dbc56340aebe3dd4093532eaa753ef5
                            <span>Tambah Kategori</span>
                        </a>
                    </li>
                </ul>
            </li>

            <!-- Galeri -->
            <li class="nav-item">
<<<<<<< HEAD
                <a href="#menuGaleri" class="nav-link" data-bs-toggle="collapse" aria-expanded="<?php echo in_array($current_page, ['manajemen-galeri.php', 'data-manajemen-galeri.php', 'edit-manajemen-galeri.php']) ? 'true' : 'false'; ?>">
                    <i class="bi bi-images"></i>
                    <span>Galeri</span>
                </a>
                <ul class="nav-submenu collapse <?php echo in_array($current_page, ['manajemen-galeri.php', 'data-manajemen-galeri.php', 'edit-manajemen-galeri.php']) ? 'show active' : ''; ?>" id="menuGaleri">
                    <li class="nav-item">
                        <a href="data-manajemen-galeri.php" class="nav-link <?php echo $current_page === 'data-manajemen-galeri.php' ? 'active' : ''; ?>">
=======
                <a href="#menuGaleri" class="nav-link" data-bs-toggle="collapse" aria-expanded="<?php echo in_array($current_page, ['manajemen-galeri', 'data-manajemen-galeri', 'edit-manajemen-galeri']) ? 'true' : 'false'; ?>">
                    <i class="bi bi-images"></i>
                    <span>Galeri</span>
                </a>
                <ul class="nav-submenu collapse <?php echo in_array($current_page, ['manajemen-galeri', 'data-manajemen-galeri', 'edit-manajemen-galeri']) ? 'show active' : ''; ?>" id="menuGaleri">
                    <li class="nav-item">
                        <a href="data-manajemen-galeri" class="nav-link <?php echo $current_page === 'data-manajemen-galeri' ? 'active' : ''; ?>">
>>>>>>> 06752c650dbc56340aebe3dd4093532eaa753ef5
                            <span>Data Galeri</span>
                        </a>
                    </li>
                    <li class="nav-item">
<<<<<<< HEAD
                        <a href="manajemen-galeri.php" class="nav-link <?php echo $current_page === 'manajemen-galeri.php' ? 'active' : ''; ?>">
=======
                        <a href="manajemen-galeri" class="nav-link <?php echo $current_page === 'manajemen-galeri' ? 'active' : ''; ?>">
>>>>>>> 06752c650dbc56340aebe3dd4093532eaa753ef5
                            <span>Tambah Galeri</span>
                        </a>
                    </li>
                </ul>
            </li>

            <!-- Testimoni -->
            <li class="nav-item">
<<<<<<< HEAD
                <a href="#menuTestimoni" class="nav-link" data-bs-toggle="collapse" aria-expanded="<?php echo in_array($current_page, ['manajemen-testimoni.php', 'data-manajemen-testimoni.php', 'edit-manajemen-testimoni.php']) ? 'true' : 'false'; ?>">
                    <i class="bi bi-chat-quote"></i>
                    <span>Testimoni</span>
                </a>
                <ul class="nav-submenu collapse <?php echo in_array($current_page, ['manajemen-testimoni.php', 'data-manajemen-testimoni.php', 'edit-manajemen-testimoni.php']) ? 'show active' : ''; ?>" id="menuTestimoni">
                    <li class="nav-item">
                        <a href="data-manajemen-testimoni.php" class="nav-link <?php echo $current_page === 'data-manajemen-testimoni.php' ? 'active' : ''; ?>">
=======
                <a href="#menuTestimoni" class="nav-link" data-bs-toggle="collapse" aria-expanded="<?php echo in_array($current_page, ['manajemen-testimoni', 'data-manajemen-testimoni', 'edit-manajemen-testimoni']) ? 'true' : 'false'; ?>">
                    <i class="bi bi-chat-quote"></i>
                    <span>Testimoni</span>
                </a>
                <ul class="nav-submenu collapse <?php echo in_array($current_page, ['manajemen-testimoni', 'data-manajemen-testimoni', 'edit-manajemen-testimoni']) ? 'show active' : ''; ?>" id="menuTestimoni">
                    <li class="nav-item">
                        <a href="data-manajemen-testimoni" class="nav-link <?php echo $current_page === 'data-manajemen-testimoni' ? 'active' : ''; ?>">
>>>>>>> 06752c650dbc56340aebe3dd4093532eaa753ef5
                            <span>Data Testimoni</span>
                        </a>
                    </li>
                    <li class="nav-item">
<<<<<<< HEAD
                        <a href="manajemen-testimoni.php" class="nav-link <?php echo $current_page === 'manajemen-testimoni.php' ? 'active' : ''; ?>">
=======
                        <a href="manajemen-testimoni" class="nav-link <?php echo $current_page === 'manajemen-testimoni' ? 'active' : ''; ?>">
>>>>>>> 06752c650dbc56340aebe3dd4093532eaa753ef5
                            <span>Tambah Testimoni</span>
                        </a>
                    </li>
                </ul>
            </li>

            <!-- Partner Maskapai -->
            <li class="nav-item">
<<<<<<< HEAD
                <a href="#menuPartner" class="nav-link" data-bs-toggle="collapse" aria-expanded="<?php echo in_array($current_page, ['manajemen-partner.php', 'data-manajemen-partner.php', 'edit-manajemen-partner.php']) ? 'true' : 'false'; ?>">
                    <i class="bi bi-airplane"></i>
                    <span>Partner Maskapai</span>
                </a>
                <ul class="nav-submenu collapse <?php echo in_array($current_page, ['manajemen-partner.php', 'data-manajemen-partner.php', 'edit-manajemen-partner.php']) ? 'show active' : ''; ?>" id="menuPartner">
                    <li class="nav-item">
                        <a href="data-manajemen-partner.php" class="nav-link <?php echo $current_page === 'data-manajemen-partner.php' ? 'active' : ''; ?>">
=======
                <a href="#menuPartner" class="nav-link" data-bs-toggle="collapse" aria-expanded="<?php echo in_array($current_page, ['manajemen-partner', 'data-manajemen-partner', 'edit-manajemen-partner']) ? 'true' : 'false'; ?>">
                    <i class="bi bi-airplane"></i>
                    <span>Partner Maskapai</span>
                </a>
                <ul class="nav-submenu collapse <?php echo in_array($current_page, ['manajemen-partner', 'data-manajemen-partner', 'edit-manajemen-partner']) ? 'show active' : ''; ?>" id="menuPartner">
                    <li class="nav-item">
                        <a href="data-manajemen-partner" class="nav-link <?php echo $current_page === 'data-manajemen-partner' ? 'active' : ''; ?>">
>>>>>>> 06752c650dbc56340aebe3dd4093532eaa753ef5
                            <span>Data Partner</span>
                        </a>
                    </li>
                    <li class="nav-item">
<<<<<<< HEAD
                        <a href="manajemen-partner.php" class="nav-link <?php echo $current_page === 'manajemen-partner.php' ? 'active' : ''; ?>">
=======
                        <a href="manajemen-partner" class="nav-link <?php echo $current_page === 'manajemen-partner' ? 'active' : ''; ?>">
>>>>>>> 06752c650dbc56340aebe3dd4093532eaa753ef5
                            <span>Tambah Partner</span>
                        </a>
                    </li>
                </ul>
            </li>

            <!-- Klien Korporasi -->
            <li class="nav-item">
<<<<<<< HEAD
                <a href="#menuKlienKorporasi" class="nav-link" data-bs-toggle="collapse" aria-expanded="<?php echo in_array($current_page, ['manajemen-klien-korporasi.php', 'data-manajemen-klien-korporasi.php', 'edit-manajemen-klien-korporasi.php']) ? 'true' : 'false'; ?>">
                    <i class="bi bi-building"></i>
                    <span>Klien Korporasi</span>
                </a>
                <ul class="nav-submenu collapse <?php echo in_array($current_page, ['manajemen-klien-korporasi.php', 'data-manajemen-klien-korporasi.php', 'edit-manajemen-klien-korporasi.php']) ? 'show active' : ''; ?>" id="menuKlienKorporasi">
                    <li class="nav-item">
                        <a href="data-manajemen-klien-korporasi.php" class="nav-link <?php echo $current_page === 'data-manajemen-klien-korporasi.php' ? 'active' : ''; ?>">
=======
                <a href="#menuKlienKorporasi" class="nav-link" data-bs-toggle="collapse" aria-expanded="<?php echo in_array($current_page, ['manajemen-klien-korporasi', 'data-manajemen-klien-korporasi', 'edit-manajemen-klien-korporasi']) ? 'true' : 'false'; ?>">
                    <i class="bi bi-building"></i>
                    <span>Klien Korporasi</span>
                </a>
                <ul class="nav-submenu collapse <?php echo in_array($current_page, ['manajemen-klien-korporasi', 'data-manajemen-klien-korporasi', 'edit-manajemen-klien-korporasi']) ? 'show active' : ''; ?>" id="menuKlienKorporasi">
                    <li class="nav-item">
                        <a href="data-manajemen-klien-korporasi" class="nav-link <?php echo $current_page === 'data-manajemen-klien-korporasi' ? 'active' : ''; ?>">
>>>>>>> 06752c650dbc56340aebe3dd4093532eaa753ef5
                            <span>Data Klien Korporasi</span>
                        </a>
                    </li>
                    <li class="nav-item">
<<<<<<< HEAD
                        <a href="manajemen-klien-korporasi.php" class="nav-link <?php echo $current_page === 'manajemen-klien-korporasi.php' ? 'active' : ''; ?>">
=======
                        <a href="manajemen-klien-korporasi" class="nav-link <?php echo $current_page === 'manajemen-klien-korporasi' ? 'active' : ''; ?>">
>>>>>>> 06752c650dbc56340aebe3dd4093532eaa753ef5
                            <span>Tambah Klien Korporasi</span>
                        </a>
                    </li>
                </ul>
            </li>

            <!-- Setting Profil -->
            <li class="nav-item">
<<<<<<< HEAD
                <a href="setting-profil.php" class="nav-link <?php echo $current_page === 'setting-profil.php' ? 'active' : ''; ?>">
=======
                <a href="setting-profil" class="nav-link <?php echo $current_page === 'setting-profil' ? 'active' : ''; ?>">
>>>>>>> 06752c650dbc56340aebe3dd4093532eaa753ef5
                    <i class="bi bi-gear"></i>
                    <span>Setting Profil</span>
                </a>
            </li>
        </ul>

        <div class="sidebar-footer">
            <small>CRM Travel v1.0</small>
        </div>
    </aside>
