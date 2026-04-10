<?php
include('../../config.php');

$id = (int)$_POST['id'];
$judul = $_POST['judul'];
$deskripsi = $_POST['deskripsi'] ?? '';

// Ambil gambar lama
$result = mysqli_query($koneksi, "SELECT gambar FROM galeri WHERE id = $id");
$data = mysqli_fetch_assoc($result);

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

$update = mysqli_query($koneksi, "UPDATE galeri SET judul = '$judul', deskripsi = '$deskripsi', gambar = '$gambar' WHERE id = $id");

if ($update == TRUE) {
    header("location: ../../data-manajemen-galeri?status=success&message=Foto berhasil diperbarui.");
} else {
    header("location: ../../data-manajemen-galeri?status=error&message=Gagal memperbarui data.");
}
?>
