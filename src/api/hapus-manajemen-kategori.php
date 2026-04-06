<?php
include '../../config.php';

// Cek login
if($_SESSION['login'] != true) {
<<<<<<< HEAD
    header("Location: ../../login.php");
=======
    header("Location: ../../login");
>>>>>>> 06752c650dbc56340aebe3dd4093532eaa753ef5
    exit;
}

// Ambil ID dari URL
$id = mysqli_real_escape_string($koneksi, $_GET['id']);

// Query delete
$query = "DELETE FROM kategori WHERE id = '$id'";
$submit = mysqli_query($koneksi, $query);

if(mysqli_query($koneksi, $query)) {
    // Redirect ke halaman data dengan pesan sukses
<<<<<<< HEAD
    header("Location: ../../data-manajemen-kategori.php?status=success&message=Kategori berhasil dihapus");
} else {
    // Redirect dengan pesan error
    header("Location: ../../data-manajemen-kategori.php?status=error&message=Gagal menghapus kategori");
}
exit;
?>
=======
    header("Location: ../../data-manajemen-kategori?status=success&message=Kategori berhasil dihapus");
} else {
    // Redirect dengan pesan error
    header("Location: ../../data-manajemen-kategori?status=error&message=Gagal menghapus kategori");
}
exit;
?>
>>>>>>> 06752c650dbc56340aebe3dd4093532eaa753ef5
