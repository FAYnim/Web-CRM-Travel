<?php
include 'config.php';

if($_SESSION['login'] != true) {
    header("Location: login");
}

$page_title = 'Tambah Paket Wisata';
$current_page = pathinfo($_SERVER['SCRIPT_NAME'], PATHINFO_FILENAME);

$kategoriList = [];
$kategoriResult = $koneksi->query("SELECT id, nama_kategori FROM kategori ORDER BY nama_kategori ASC");
if ($kategoriResult) {
    while ($kategori = $kategoriResult->fetch_assoc()) {
        $kategoriList[] = $kategori;
    }
}

$kategoriKosong = empty($kategoriList);
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
                            <i class="bi bi-suitcase-lg me-2"></i>Tambah Paket Wisata
                        </div>
                        <div class="card-body">
                            <p class="text-muted mb-4">Silakan isi data paket wisata di bawah ini dengan benar</p>

                            <?php if(isset($_GET['status']) && $_GET['status'] == 'error'): ?>
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <i class="bi bi-exclamation-circle me-2"></i><?php echo htmlspecialchars($_GET['message']); ?>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            <?php endif; ?>

                            <?php if ($kategoriKosong): ?>
                                <div class="alert alert-warning d-flex align-items-start gap-2" role="alert">
                                    <i class="bi bi-exclamation-triangle-fill"></i>
                                    <div>
                                        <strong>Belum ada kategori.</strong>
                                        Buat kategori terlebih dahulu sebelum menambahkan paket wisata.
                                        <div class="mt-2">
                                            <a href="manajemen-kategori" class="btn btn-sm btn-warning">
                                                <i class="bi bi-plus-circle me-1"></i>Buat Kategori
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>

                                <form method="POST" action="src/api/submit-manajemen-paket" enctype="multipart/form-data">
                                <fieldset <?php echo $kategoriKosong ? 'disabled' : ''; ?>>
                                <div class="mb-3">
                                    <label class="form-label">Nama Paket:</label>
                                    <input autofocus class="form-control" type="text" name="nama_paket" placeholder="Contoh: Bali Paradise Escape" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Durasi:</label>
                                    <div class="row g-2">
                                        <div class="col">
                                            <input class="form-control" type="number" name="durasi_hari" min="1" placeholder="Hari" required>
                                        </div>
                                        <div class="col">
                                            <input class="form-control" type="number" name="durasi_malam" min="0" placeholder="Malam" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Lokasi:</label>
                                    <input class="form-control" type="text" name="lokasi" placeholder="Contoh: Bali, Indonesia" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Kategori:</label>
                                    <select class="form-select" name="kategori_id" required>
                                        <option value="">Pilih Kategori</option>
                                        <?php foreach ($kategoriList as $kategori): ?>
                                            <option value="<?php echo $kategori['id']; ?>"><?php echo htmlspecialchars($kategori['nama_kategori']); ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Harga (Rp):</label>
                                    <input class="form-control" type="text" name="harga" maxlength="18" placeholder="Contoh: 4500000" required oninput="this.value=this.value.replace(/[^0-9]/g,'');">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Upload Gambar:</label>
                                    <input class="form-control" type="file" name="gambar" accept="image/*" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Label:</label>
                                    <div>
                                        <?php $labelOptions = ['Promo', 'Hot Deal', 'Best Seller', 'Baru', 'Spesial']; ?>
                                        <?php foreach ($labelOptions as $label): ?>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="label" id="label_<?php echo $label; ?>" value="<?php echo $label; ?>">
                                                <label class="form-check-label" for="label_<?php echo $label; ?>"><?php echo $label; ?></label>
                                            </div>
                                        <?php endforeach; ?>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="label" id="label_none" value="" checked>
                                            <label class="form-check-label" for="label_none">Tanpa Label</label>
                                        </div>
                                    </div>
                                </div>

                                 <div class="mb-3">
                                     <label class="form-label">Rating (1-5):</label>
                                     <input class="form-control" type="number" name="rating" min="1" max="5" value="5" required>
                                 </div>

                                 <div class="mb-3">
                                     <label class="form-label">Deskripsi Paket:</label>
                                     <textarea class="form-control" name="deskripsi" rows="3" maxlength="10000" placeholder="Masukkan detail paket wisata seperti itinerari singkat."></textarea>
                                 </div>

                                 <div class="mb-3">
                                     <label class="form-label">Destinasi:</label>
                                     <textarea class="form-control" name="destinasi" rows="4" placeholder="Contoh:&#10;• Pantai Kuta&#10;• Pura Tanah Lot&#10;• Ubud Monkey Forest"></textarea>
                                     <small class="text-muted">Gunakan baris baru atau simbol (•) untuk daftar destinasi.</small>
                                 </div>

                                 <div class="mb-3">
                                     <label class="form-label">Fasilitas Include:</label>
                                     <textarea class="form-control" name="fasilitas_include" rows="4" placeholder="Contoh:&#10;• Tiket Pesawat PP&#10;• Hotel Bintang 4&#10;• Makan 3x Sehari&#10;• Tour Guide Profesional"></textarea>
                                 </div>

                                 <div class="mb-3">
                                     <label class="form-label">Fasilitas Exclude:</label>
                                     <textarea class="form-control" name="fasilitas_exclude" rows="3" placeholder="Contoh:&#10;• Pengeluaran Pribadi&#10;• Tip Guide/Driver&#10;• Asuransi Perjalanan Tambahan"></textarea>
                                 </div>

                                 <div class="mb-3">
                                     <label class="form-label">Syarat & Ketentuan:</label>
                                     <textarea class="form-control" name="syarat_ketentuan" rows="4" placeholder="Contoh:&#10;• DP minimal 30% dari total biaya&#10;• Pelunasan H-7 keberangkatan&#10;• Perubahan jadwal mengikuti ketersediaan"></textarea>
                                 </div>

                                 <div class="d-flex gap-2">
                                     <button class="btn btn-primary" type="submit">
                                         <i class="bi bi-check-lg me-1"></i>Simpan
                                     </button>
                                     <a href="data-manajemen-paket" class="btn btn-secondary">Batal</a>
                                 </div>
                                </fieldset>
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
