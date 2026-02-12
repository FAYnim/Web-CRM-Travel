<?php
include('../../config.php');

$id = (int)$_POST['id'];
$nama = $_POST['nama_paket'];
$durasi = $_POST['durasi'];
$lokasi = $_POST['lokasi'];
$harga = (int)$_POST['harga'];
$gambar = $_POST['gambar'];
$label = $_POST['label'] ?? "";
$rating = (int)$_POST['rating'] ?? 5;

$update = mysqli_query($koneksi, "UPDATE manajemen_paket SET nama_paket = '$nama', durasi = '$durasi', lokasi = '$lokasi', harga = $harga, gambar = '$gambar', label = '$label', rating = $rating WHERE id = $id");

if ($update == TRUE) {
    header("location: ../../data-manajemen-paket.php?success=Data berhasil diperbarui.");
} else {
    echo "Gagal Memperbarui";
}
?>
