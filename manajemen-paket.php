<?php

// config database

$dbHost = "localhost";
$dbUser = "root";
$dbPass = "";
$dbName = "web_crm_travel"; // ganti sesuai nama database di phpmyadmin

$conn = new mysqli($dbHost, $dbUser, $dbPass, $dbName);
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// helper

function e($str)
{
    echo $str ?? "";
}

$errors = [];
$successMsg = "";
$editData = null;

// database hapus

if (isset($_GET["action"]) && $_GET["action"] === "delete") {
    $id = (int)($_GET["id"] ?? 0);
    if ($id > 0) {
        $stmt = $conn->prepare("DELETE FROM manajemen_paket WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();
        $successMsg = "Data berhasil dihapus.";
    }
}

// handle tambah / update 

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $action = $_POST["action"] ?? "";

    $nama = trim($_POST["nama_paket"] ?? "");
    $durasi = trim($_POST["durasi"] ?? "");
    $lokasi = trim($_POST["lokasi"] ?? "");
    $harga = (int)($_POST["harga"] ?? 0);
    $gambar = trim($_POST["gambar"] ?? "");
    $label = trim($_POST["label"] ?? "");
    $rating = (int)($_POST["rating"] ?? 5);

    if ($nama === "") $errors[] = "Nama paket wajib diisi.";
    if ($durasi === "") $errors[] = "Durasi wajib diisi.";
    if ($lokasi === "") $errors[] = "Lokasi wajib diisi.";
    if ($harga <= 0) $errors[] = "Harga harus lebih dari 0.";
    if ($gambar === "") $errors[] = "URL gambar wajib diisi.";
    if ($rating < 1 || $rating > 5) $errors[] = "Rating harus 1 - 5.";

    if (!$errors) {
        if ($action === "create") {
            $stmt = $conn->prepare("INSERT INTO manajemen_paket (nama_paket, durasi, lokasi, harga, gambar, label, rating) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("sssissi", $nama, $durasi, $lokasi, $harga, $gambar, $label, $rating);
            $stmt->execute();
            $stmt->close();
            $successMsg = "Data berhasil ditambahkan.";
        }

        if ($action === "update") {
            $id = (int)($_POST["id"] ?? 0);
            if ($id > 0) {
                $stmt = $conn->prepare("UPDATE manajemen_paket SET nama_paket = ?, durasi = ?, lokasi = ?, harga = ?, gambar = ?, label = ?, rating = ? WHERE id = ?");
                $stmt->bind_param("sssissii", $nama, $durasi, $lokasi, $harga, $gambar, $label, $rating, $id);
                $stmt->execute();
                $stmt->close();
                $successMsg = "Data berhasil diperbarui.";
            }
        }
    }
}

// handle edit (ngambil data)

if (isset($_GET["action"]) && $_GET["action"] === "edit") {
    $id = (int)($_GET["id"] ?? 0);
    if ($id > 0) {
        $stmt = $conn->prepare("SELECT * FROM manajemen_paket WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $editData = $result->fetch_assoc();
        $stmt->close();
    }
}

// ambil semua data paket

$paketList = [];
$result = $conn->query("SELECT * FROM manajemen_paket ORDER BY id DESC");
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $paketList[] = $row;
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paket Wisata Unggulan</title>
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

    <?php include 'crud-manajemen_paket.php'; ?>

    <div class="w-full min-h-screen flex flex-col bg-white scroll-smooth">
        <main class="flex-1 overflow-y-auto pt-8 pb-8">
            <!-- Section Header -->
            <div class="px-6 mb-6 text-center">
                <h1 class="text-2xl font-bold text-gray-900 mb-2 font-general">Paket Wisata Unggulan</h1>
                <p class="text-sm text-gray-600 leading-relaxed max-w-2xl mx-auto">Temukan pengalaman perjalanan terbaik dengan paket wisata pilihan kami yang dirancang khusus untuk liburan sempurna Anda</p>
                <div class="mt-4 flex items-center justify-center gap-3">
                    <span class="h-px w-14 bg-gradient-to-r from-transparent via-amber-300 to-transparent"></span>
                    <span class="h-2 w-2 rounded-full bg-amber-400 shadow-[0_0_12px_rgba(251,191,36,0.6)]"></span>
                    <span class="h-px w-14 bg-gradient-to-r from-transparent via-amber-300 to-transparent"></span>
                </div>
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
                                    <img src="<?php e($p["gambar"]); ?>" alt="<?php e($p["nama_paket"]); ?>" class="w-full h-full object-cover">
                                    <?php if (!empty($p["label"])): ?>
                                        <div class="absolute top-3 right-3 bg-teal-500 text-white text-xs font-medium px-3 py-1 rounded-full">
                                            <?php e($p["label"]); ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="p-5">
                                    <h3 class="text-lg font-bold text-gray-900 mb-2"><?php e($p["nama_paket"]); ?></h3>
                                    <div class="flex items-center gap-2 mb-3">
                                        <iconify-icon icon="lucide:calendar" class="text-gray-500 text-base"></iconify-icon>
                                        <span class="text-sm text-gray-600"><?php e($p["durasi"]); ?></span>
                                    </div>
                                    <div class="flex items-center gap-2 mb-4">
                                        <iconify-icon icon="lucide:map-pin" class="text-gray-500 text-base"></iconify-icon>
                                        <span class="text-sm text-gray-600"><?php e($p["lokasi"]); ?></span>
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
            
            <!-- CTA Button -->
            <div class="px-6">
                <a href="#view-all-packages" id="cta-view-all-btn" class="block w-full bg-teal-600 text-white text-center py-4 rounded-xl font-medium text-base active:bg-teal-700 transition-colors" style="min-height: 44px;">
                    Lihat Semua Paket
                </a>
            </div>
            
        </main>
    </div>
</body>
</html>
