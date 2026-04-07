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
$query = "DELETE FROM klien_korporasi WHERE id = '$id'";
$submit = mysqli_query($koneksi, $query);

if($submit) {
    // Redirect ke halaman data dengan pesan sukses
    header("Location: ../../data-manajemen-klien-korporasi?status=success&message=Klien korporasi berhasil dihapus");
} else {
    // Redirect dengan pesan error
    header("Location: ../../data-manajemen-klien-korporasi?status=error&message=Gagal menghapus klien korporasi");
}
exit;
?>
