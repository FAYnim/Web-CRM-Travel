<?php
include('../../config.php');

$id = (int)$_GET['id'];

// Ambil data gambar untuk dihapus dari folder
$result = mysqli_query($koneksi, "SELECT gambar FROM galeri WHERE id = $id");
$data = mysqli_fetch_assoc($result);

// Hapus file gambar jika ada
if ($data && !empty($data['gambar'])) {
    $file_path = '../../' . $data['gambar'];
    if (file_exists($file_path)) {
        unlink($file_path);
    }
}

// Hapus data dari database
$delete = mysqli_query($koneksi, "DELETE FROM galeri WHERE id = $id");

if ($delete == TRUE) {
    header("location: ../../data-manajemen-galeri?status=success&message=Foto berhasil dihapus dari galeri.");
} else {
    header("location: ../../data-manajemen-galeri?status=error&message=Gagal menghapus foto.");
}
?>
