<?php
include('../../config.php');

$id = (int)$_GET['id'];

// Ambil data gambar untuk dihapus dari folder
$stmt = $koneksi->prepare("SELECT gambar FROM galeri WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_assoc();
$stmt->close();

// Hapus file gambar jika ada
if ($data && !empty($data['gambar'])) {
    $file_path = '../../' . $data['gambar'];
    if (file_exists($file_path)) {
        unlink($file_path);
    }
}

// Hapus data dari database
$stmt = $koneksi->prepare("DELETE FROM galeri WHERE id = ?");
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    header("location: ../../manajemen-galeri.php?success=Foto berhasil dihapus dari galeri.");
} else {
    header("location: ../../manajemen-galeri.php?error=Gagal menghapus foto.");
}
$stmt->close();
?>
