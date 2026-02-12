<?php
include('../../config.php');

$nama = $_POST['nama_paket'];
$durasi = $_POST['durasi'];
$lokasi = $_POST['lokasi'];
$harga = (int)$_POST['harga'];
$gambar = $_POST['gambar'];
$label = $_POST['label'] ?? "";
$rating = (int)$_POST['rating'] ?? 5;

$submit = mysqli_query($koneksi, "INSERT INTO manajemen_paket (nama_paket, durasi, lokasi, harga, gambar, label, rating) VALUES ('$nama', '$durasi', '$lokasi', $harga, '$gambar', '$label', $rating)");

if ($submit == TRUE) {
    header("location: ../../data-manajemen-paket.php?success=Data berhasil ditambahkan.");
} else {
    echo "Gagal Tersimpan";
}
?>
