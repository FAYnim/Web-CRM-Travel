<?php
include '../../config.php';

// Cek login
if($_SESSION['login'] != true) {
    header("Location: ../../login");
    exit;
}

// Ambil ID dari URL
$id = mysqli_real_escape_string($koneksi, $_GET['id']);

// Query delete
$query = "DELETE FROM partner_maskapai WHERE id = '$id'";

if(mysqli_query($koneksi, $query)) {
    // Redirect ke halaman data dengan pesan sukses
    header("Location: ../../data-manajemen-partner?status=success&message=Partner maskapai berhasil dihapus");
} else {
    // Redirect dengan pesan error
    header("Location: ../../data-manajemen-partner?status=error&message=Gagal menghapus partner maskapai");
}
exit;
?>
