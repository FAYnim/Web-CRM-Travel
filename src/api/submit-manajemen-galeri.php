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
    header("location: ../../manajemen-galeri?status=error&message=Gagal mengupload gambar.");
    exit;
}

$submit = mysqli_query($koneksi, "INSERT INTO galeri (judul, deskripsi, gambar) VALUES ('$judul', '$deskripsi', '$gambar')");

if ($submit == TRUE) {
    header("location: ../../data-manajemen-galeri?status=success&message=Foto berhasil ditambahkan ke galeri.");
} else {
    header("location: ../../data-manajemen-galeri?status=error&message=Gagal menyimpan data.");
}
?>
