<?php
include('../../config.php');

$judul = $_POST['judul'];
$deskripsi = $_POST['deskripsi'] ?? '';

// handle upload gambar
$gambar = "";
if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] == 0) {
    $target_dir = "../../uploads/";
    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true);
    }
    $file_extension = strtolower(pathinfo($_FILES['gambar']['name'], PATHINFO_EXTENSION));
    $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
    
    if (in_array($file_extension, $allowed_extensions)) {
        $new_filename = 'gallery_' . uniqid() . '.' . $file_extension;
        $target_file = $target_dir . $new_filename;
        
        if (move_uploaded_file($_FILES['gambar']['tmp_name'], $target_file)) {
            $gambar = "uploads/" . $new_filename;
        }
    }
}

if ($gambar == "") {
    header("location: ../../manajemen-galeri.php?error=Gagal mengupload gambar.");
    exit;
}

$stmt = $koneksi->prepare("INSERT INTO galeri (judul, deskripsi, gambar) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $judul, $deskripsi, $gambar);

if ($stmt->execute()) {
    header("location: ../../manajemen-galeri.php?success=Foto berhasil ditambahkan ke galeri.");
} else {
    header("location: ../../manajemen-galeri.php?error=Gagal menyimpan data.");
}
$stmt->close();
?>
