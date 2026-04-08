<?php
include 'config.php';

if($_SESSION['login'] != true) {
    header("Location: login");
}

$page_title = 'Setting Profil';
$current_page = pathinfo($_SERVER['SCRIPT_NAME'], PATHINFO_FILENAME);

// Ambil data profil dari database
$query = "SELECT * FROM profil WHERE id = 1";
$result = mysqli_query($koneksi, $query);
$profil = mysqli_fetch_assoc($result);

// Jika data profil belum ada, buat default
if(!$profil) {
    $profil = [
        'nama_perusahaan' => '',
        'email' => '',
        'telepon' => '',
        'whatsapp' => '',
        'alamat' => '',
        'tentang_kami' => '',
        'facebook' => '',
        'instagram' => '',
        'twitter' => '',
        'youtube' => '',
        'linkedin' => ''
    ];
}
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
            <!-- Alert Messages -->
            <?php if(isset($_GET['status']) && $_GET['status'] == 'success'): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle me-2"></i>Data profil berhasil disimpan!
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php endif; ?>

            <?php if(isset($_GET['status']) && $_GET['status'] == 'error'): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-circle me-2"></i><?php echo htmlspecialchars($_GET['message']); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php endif; ?>

            <div class="row">
                <div class="col-lg-12">
                    <div class="dashboard-card">
                        <div class="card-header">
                            <i class="bi bi-gear me-2"></i>Pengaturan Profil Perusahaan
                        </div>
                        <div class="card-body">
                            <p class="text-muted mb-4">Kelola informasi profil perusahaan Anda</p>

                            <form method="POST" action="src/api/submit-setting-profil">
                                <!-- Nav Tabs -->
                                <ul class="nav nav-tabs mb-4" id="profilTab" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link active" id="kontak-tab" data-bs-toggle="tab" data-bs-target="#kontak" type="button" role="tab" aria-controls="kontak" aria-selected="true">
                                            <i class="bi bi-telephone me-1"></i>Informasi Kontak
                                        </button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="tentang-tab" data-bs-toggle="tab" data-bs-target="#tentang" type="button" role="tab" aria-controls="tentang" aria-selected="false">
                                            <i class="bi bi-info-circle me-1"></i>Tentang Kami
                                        </button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="medsos-tab" data-bs-toggle="tab" data-bs-target="#medsos" type="button" role="tab" aria-controls="medsos" aria-selected="false">
                                            <i class="bi bi-share me-1"></i>Media Sosial
                                        </button>
                                    </li>
                                </ul>

                                <!-- Tab Content -->
                                <div class="tab-content" id="profilTabContent">
                                    <!-- Tab Informasi Kontak -->
                                    <div class="tab-pane fade show active" id="kontak" role="tabpanel" aria-labelledby="kontak-tab">
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label for="nama_perusahaan" class="form-label">Nama Perusahaan <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="nama_perusahaan" name="nama_perusahaan" value="<?php echo htmlspecialchars($profil['nama_perusahaan']); ?>" required>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                                <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($profil['email']); ?>" required>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label for="telepon" class="form-label">Telepon <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="telepon" name="telepon" value="<?php echo htmlspecialchars($profil['telepon']); ?>" placeholder="021-1234567" required>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="whatsapp" class="form-label">WhatsApp</label>
                                                <input type="text" class="form-control" id="whatsapp" name="whatsapp" value="<?php echo htmlspecialchars($profil['whatsapp']); ?>" placeholder="08123456789">
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="alamat" class="form-label">Alamat <span class="text-danger">*</span></label>
                                            <textarea class="form-control" id="alamat" name="alamat" rows="3" required><?php echo htmlspecialchars($profil['alamat']); ?></textarea>
                                        </div>
                                    </div>

                                    <!-- Tab Tentang Kami -->
                                    <div class="tab-pane fade" id="tentang" role="tabpanel" aria-labelledby="tentang-tab">
                                        <div class="mb-3">
                                            <label for="tentang_kami" class="form-label">Deskripsi Perusahaan <span class="text-danger">*</span></label>
                                            <textarea class="form-control" id="tentang_kami" name="tentang_kami" rows="8" required><?php echo htmlspecialchars($profil['tentang_kami']); ?></textarea>
                                            <small class="text-muted">Ceritakan tentang perusahaan Anda, visi, misi, dan layanan yang ditawarkan.</small>
                                        </div>
                                    </div>

                                    <!-- Tab Media Sosial -->
                                    <div class="tab-pane fade" id="medsos" role="tabpanel" aria-labelledby="medsos-tab">
                                        <div class="mb-3">
                                            <label for="facebook" class="form-label"><i class="bi bi-facebook me-1"></i>Facebook</label>
                                            <input type="url" class="form-control" id="facebook" name="facebook" value="<?php echo htmlspecialchars($profil['facebook']); ?>" placeholder="https://facebook.com/username">
                                        </div>
                                        <div class="mb-3">
                                            <label for="instagram" class="form-label"><i class="bi bi-instagram me-1"></i>Instagram</label>
                                            <input type="url" class="form-control" id="instagram" name="instagram" value="<?php echo htmlspecialchars($profil['instagram']); ?>" placeholder="https://instagram.com/username">
                                        </div>
                                        <div class="mb-3">
                                            <label for="twitter" class="form-label"><i class="bi bi-twitter me-1"></i>Twitter</label>
                                            <input type="url" class="form-control" id="twitter" name="twitter" value="<?php echo htmlspecialchars($profil['twitter']); ?>" placeholder="https://twitter.com/username">
                                        </div>
                                        <div class="mb-3">
                                            <label for="youtube" class="form-label"><i class="bi bi-youtube me-1"></i>YouTube</label>
                                            <input type="url" class="form-control" id="youtube" name="youtube" value="<?php echo htmlspecialchars($profil['youtube']); ?>" placeholder="https://youtube.com/channel/...">
                                        </div>
                                        <div class="mb-3">
                                            <label for="linkedin" class="form-label"><i class="bi bi-linkedin me-1"></i>LinkedIn</label>
                                            <input type="url" class="form-control" id="linkedin" name="linkedin" value="<?php echo htmlspecialchars($profil['linkedin']); ?>" placeholder="https://linkedin.com/company/...">
                                        </div>
                                    </div>
                                </div>

                                <!-- Submit Button -->
                                <div class="d-flex gap-2 mt-4">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="bi bi-save me-1"></i>Simpan Perubahan
                                    </button>
                                    <a href="index" class="btn btn-secondary">Batal</a>
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
