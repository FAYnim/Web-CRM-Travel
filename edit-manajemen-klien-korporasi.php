<?php
include 'config.php';

if($_SESSION['login'] != true) {
    header("Location: login");
}

$id = isset($_GET['id']) ? $_GET['id'] : '';
if(empty($id)) {
    header("Location: data-manajemen-klien-korporasi");
    exit;
}

$query = mysqli_query($koneksi, "SELECT * FROM klien_korporasi WHERE id='$id'");
if(mysqli_num_rows($query) == 0) {
    header("Location: data-manajemen-klien-korporasi?status=error&message=Data tidak ditemukan");
    exit;
}
$data = mysqli_fetch_array($query);

$page_title = 'Edit Klien Korporasi';
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
            <!-- Alert Messages -->
            <?php if(isset($_GET['status']) && $_GET['status'] == 'error'): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-circle me-2"></i><?php echo htmlspecialchars($_GET['message']); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php endif; ?>

            <div class="row">
                <div class="col-lg-12 col-xl-12">
                    <div class="dashboard-card">
                        <div class="card-header">
                            <i class="bi bi-pencil-square me-2"></i>Edit Klien Korporasi
                        </div>
                        <div class="card-body">
                            <p class="text-muted mb-4">Silakan edit data klien korporasi dengan benar</p>

                            <form method="POST" action="src/api/update-manajemen-klien-korporasi">
                                <input type="hidden" name="id" value="<?php echo $data['id']; ?>">

                                <!-- Informasi Perusahaan -->
                                <h6 class="text-primary mb-3"><i class="bi bi-building me-2"></i>Informasi Perusahaan</h6>
                                <div class="mb-3">
                                    <label for="nama_perusahaan" class="form-label">Nama Perusahaan <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="nama_perusahaan" name="nama_perusahaan" value="<?php echo htmlspecialchars($data['nama_perusahaan']); ?>" required>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="telepon" class="form-label">Telepon Perusahaan <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="telepon" name="telepon" value="<?php echo htmlspecialchars($data['telepon']); ?>" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="email" class="form-label">Email Perusahaan</label>
                                        <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($data['email']); ?>">
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="alamat" class="form-label">Alamat Perusahaan <span class="text-danger">*</span></label>
                                    <textarea class="form-control" id="alamat" name="alamat" rows="3" required><?php echo htmlspecialchars($data['alamat']); ?></textarea>
                                </div>

                                <hr class="my-4">

                                <!-- Informasi PIC -->
                                <h6 class="text-primary mb-3"><i class="bi bi-person me-2"></i>Informasi PIC (Penanggung Jawab)</h6>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="nama_pic" class="form-label">Nama PIC <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="nama_pic" name="nama_pic" value="<?php echo htmlspecialchars($data['nama_pic']); ?>" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="jabatan_pic" class="form-label">Jabatan PIC</label>
                                        <input type="text" class="form-control" id="jabatan_pic" name="jabatan_pic" value="<?php echo htmlspecialchars($data['jabatan_pic']); ?>">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="telepon_pic" class="form-label">Telepon PIC <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="telepon_pic" name="telepon_pic" value="<?php echo htmlspecialchars($data['telepon_pic']); ?>" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="email_pic" class="form-label">Email PIC</label>
                                        <input type="email" class="form-control" id="email_pic" name="email_pic" value="<?php echo htmlspecialchars($data['email_pic']); ?>">
                                    </div>
                                </div>

                                <hr class="my-4">

                                <!-- Informasi Lainnya -->
                                <h6 class="text-primary mb-3"><i class="bi bi-info-circle me-2"></i>Informasi Lainnya</h6>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="tanggal_bergabung" class="form-label">Tanggal Bergabung <span class="text-danger">*</span></label>
                                        <input type="date" class="form-control" id="tanggal_bergabung" name="tanggal_bergabung" value="<?php echo $data['tanggal_bergabung']; ?>" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                                        <select class="form-select" id="status" name="status" required>
                                            <option value="Aktif" <?php echo ($data['status'] == 'Aktif') ? 'selected' : ''; ?>>Aktif</option>
                                            <option value="Tidak Aktif" <?php echo ($data['status'] == 'Tidak Aktif') ? 'selected' : ''; ?>>Tidak Aktif</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <label for="keterangan" class="form-label">Keterangan</label>
                                    <textarea class="form-control" id="keterangan" name="keterangan" rows="3"><?php echo htmlspecialchars($data['keterangan']); ?></textarea>
                                </div>

                                <div class="d-flex gap-2">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="bi bi-save me-2"></i>Update
                                    </button>
                                    <a href="data-manajemen-klien-korporasi" class="btn btn-secondary">
                                        <i class="bi bi-x-circle me-2"></i>Batal
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKHyMxg7QKlP8iI5tL1lNQokFkEExDfKxfmW0P32jJnNqT8hZ1Amn5D4o0aS7y2R" crossorigin="anonymous"></script>
    <!-- Custom Dashboard JS -->
    <script src="src/js/dashboard.js"></script>
</body>
</html>
