<?php
include '../../config.php';

// Cek login
if($_SESSION['login'] != true) {
    header("Location: ../../login");
    exit;
}

// Ambil data dari form
$id = mysqli_real_escape_string($koneksi, $_POST['id']);
$nama_pelanggan = mysqli_real_escape_string($koneksi, $_POST['nama_pelanggan']);
$pesan = mysqli_real_escape_string($koneksi, $_POST['pesan']);
$rating = mysqli_real_escape_string($koneksi, $_POST['rating']);
$status = mysqli_real_escape_string($koneksi, $_POST['status']);
$tanggal = mysqli_real_escape_string($koneksi, $_POST['tanggal']);

// Query update
$query = "UPDATE testimoni SET nama_pelanggan = '$nama_pelanggan', pesan = '$pesan', rating = '$rating', status = '$status', tanggal = '$tanggal' WHERE id = '$id'";
$submit = mysqli_query($koneksi, $query);

if($submit) {
    // Redirect ke halaman data dengan pesan sukses
    header("Location: ../../data-manajemen-testimoni?status=success&message=Testimoni berhasil diupdate");
} else {
    // Redirect dengan pesan error
    header("Location: ../../edit-manajemen-testimoni?id=$id&status=error&message=Gagal mengupdate testimoni");
}
exit;
?>
