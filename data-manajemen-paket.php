<?php
include('config.php');

// Ambil semua data paket
$paketList = [];
$result = $koneksi->query("SELECT * FROM manajemen_paket ORDER BY id DESC");
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $paketList[] = $row;
    }
}

$successMsg = $_GET['success'] ?? '';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paket Wisatata Unggulan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
    <link href="https://api.fontshare.com/v2/css?f[]=satoshi@700,500,400&f[]=general-sans@600,500&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <style>
        body {
            font-family: 'Satoshi', sans-serif;
        }
        
        .font-general {
            font-family: 'General Sans', sans-serif;
        }
        
        .scroll-container {
            scrollbar-width: none;
            -ms-overflow-style: none;
        }
        
        .scroll-container::-webkit-scrollbar {
            display: none;
        }
        
        .package-card {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .package-card:active {
            transform: scale(0.98);
        }
        
        .star-icon {
            transition: color 0.2s ease;
        }
        
        .scroll-smooth {
            scroll-behavior: smooth;
        }
    </style>
</head>

<?php include('navbar.php'); ?>

<body>

    <div class="w-full min-h-screen flex flex-col bg-white scroll-smooth">
        <main class="flex-1 overflow-y-auto pt-8 pb-8">
            <!-- Section Header -->
            <div class="px-6 mb-6 text-center">
                <h1 class="text-2xl font-bold text-gray-900 mb-2 font-general">Paket Wisatata Unggulan</h1>
                <p class="text-sm text-gray-600 leading-relaxed max-w-2xl mx-auto">Temukan pengalaman perjalanan terbaik dengan paket wisata pilihan kami yang dirancang khusus untuk liburan sempurna Anda</p>
            </div>
            
            <!-- Grid Container -->
            <div class="px-6 mb-8">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

                    <?php if (!$paketList): ?>
                        <div class="col-span-full text-center text-gray-500">Belum ada paket yang ditambahkan.</div>
                    <?php else: ?>
                        <?php foreach ($paketList as $p): ?>
                            <div class="package-card bg-white rounded-2xl overflow-hidden shadow-sm" style="box-shadow: 0 4px 12px rgba(0,0,0,0.08);">
                                <div class="relative h-48 overflow-hidden">
                                    <img src="<?php echo htmlspecialchars($p["gambar"]); ?>" alt="<?php echo htmlspecialchars($p["nama_paket"]); ?>" class="w-full h-full object-cover">
                                    <?php if (!empty($p["label"])): ?>
                                        <div class="absolute top-3 right-3 bg-teal-500 text-white text-xs font-medium px-3 py-1 rounded-full">
                                            <?php echo htmlspecialchars($p["label"]); ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="p-5">
                                    <h3 class="text-lg font-bold text-gray-900 mb-2"><?php echo htmlspecialchars($p["nama_paket"]); ?></h3>
                                    <div class="flex items-center gap-2 mb-3">
                                        <iconify-icon icon="lucide:calendar" class="text-gray-500 text-base"></iconify-icon>
                                        <span class="text-sm text-gray-600"><?php echo htmlspecialchars($p["durasi"]); ?></span>
                                    </div>
                                    <div class="flex items-center gap-2 mb-4">
                                        <iconify-icon icon="lucide:map-pin" class="text-gray-500 text-base"></iconify-icon>
                                        <span class="text-sm text-gray-600"><?php echo htmlspecialchars($p["lokasi"]); ?></span>
                                    </div>
                                    <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                                        <div>
                                            <p class="text-xs text-gray-500 mb-1">Mulai dari</p>
                                            <p class="text-xl font-bold text-teal-600">Rp <?php echo number_format((int)$p["harga"], 0, ",", "."); ?></p>
                                        </div>
                                        <div class="flex items-center gap-1">
                                            <?php for ($i = 1; $i <= 5; $i++): ?>
                                                <iconify-icon icon="lucide:star" class="star-icon text-base <?php echo ($i <= (int)$p["rating"]) ? "text-yellow-400" : "text-gray-300"; ?>"></iconify-icon>
                                            <?php endfor; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>

                </div>
            </div>
            
            <!-- Admin Panel Section -->
            <div class="px-6 mb-8">
                <hr class="mb-6">
                <div class="text-center mb-4">
                    <h2 class="text-xl font-bold text-gray-900 font-general">Panel Admin</h2>
                    <p class="text-sm text-gray-600">Kelola data paket wisata</p>
                </div>

                <?php if ($successMsg): ?>
                    <div class="alert alert-success text-center mb-4"><?php echo htmlspecialchars($successMsg); ?></div>
                <?php endif; ?>

                <div class="card mx-auto" style="max-width: 800px;">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5 class="card-title mb-0 font-general">Daftar Paket</h5>
                            <a href="manajemen-paket.php" class="btn btn-primary btn-sm">Tambah Paket Baru</a>
                        </div>
                        
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Paket</th>
                                        <th>Durasi</th>
                                        <th>Lokasi</th>
                                        <th>Harga</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!$paketList): ?>
                                        <tr>
                                            <td colspan="6" class="text-center text-muted py-4">Belum ada data paket.</td>
                                        </tr>
                                    <?php else: ?>
                                        <?php $no = 1; ?>
                                        <?php foreach ($paketList as $p): ?>
                                            <tr>
                                                <td><?php echo $no++; ?></td>
                                                <td>
                                                    <?php echo htmlspecialchars($p['nama_paket']); ?>
                                                    <?php if (!empty($p['label'])): ?>
                                                        <span class="badge bg-info"><?php echo htmlspecialchars($p['label']); ?></span>
                                                    <?php endif; ?>
                                                </td>
                                                <td><?php echo htmlspecialchars($p['durasi']); ?></td>
                                                <td><?php echo htmlspecialchars($p['lokasi']); ?></td>
                                                <td>Rp <?php echo number_format((int)$p['harga'], 0, ",", "."); ?></td>
                                                <td>
                                                    <a href="edit-manajemen-paket.php?id=<?php echo $p['id']; ?>" class="btn btn-sm btn-warning">Edit</a>
                                                    <a href="src/api/hapus-manajemen-paket.php?id=<?php echo $p['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            
        </main>
    </div>
</body>
</html>
