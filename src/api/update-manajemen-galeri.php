<?php
include('../../config.php');

$id = (int)$_POST['id'];
$judul = $_POST['judul'];
$deskripsi = $_POST['deskripsi'] ?? '';

// Ambil gambar lama
$stmt = $koneksi->prepare("SELECT gambar FROM galeri WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_assoc();
$stmt->close();

$gambar = $data['gambar'] ?? '';

// handle upload gambar baru jika ada
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
            // Hapus gambar lama jika ada
            if (!empty($gambar)) {
                $old_file_path = '../../' . $gambar;
                if (file_exists($old_file_path)) {
                    unlink($old_file_path);
                }
            }
            $gambar = "uploads/" . $new_filename;
        }
    }
}

$stmt = $koneksi->prepare("UPDATE galeri SET judul = ?, deskripsi = ?, gambar = ? WHERE id = ?");
$stmt->bind_param("sssi", $judul, $deskripsi, $gambar, $id);

if ($stmt->execute()) {
    header("location: ../../manajemen-galeri.php?success=Foto berhasil diperbarui.");
} else {
    header("location: ../../manajemen-galeri.php?error=Gagal memperbarui data.");
}
$stmt->close();
?>
