<?php
include('../../config.php');

$id = (int)$_POST['id'];
$nama = $_POST['nama_paket'];
$durasi_hari = (int)$_POST['durasi_hari'];
$durasi_malam = (int)$_POST['durasi_malam'];
$durasi = $durasi_hari . " Hari " . $durasi_malam . " Malam";
$lokasi = $_POST['lokasi'];
$harga = (int)$_POST['harga'];
$label = $_POST['label'] ?? "";
$rating = (int)$_POST['rating'] ?? 5;
$deskripsi = htmlspecialchars($_POST['deskripsi'] ?? "");
$destinasi = htmlspecialchars($_POST['destinasi'] ?? "");
$fasilitas_include = htmlspecialchars($_POST['fasilitas_include'] ?? "");
$fasilitas_exclude = htmlspecialchars($_POST['fasilitas_exclude'] ?? "");
$syarat_ketentuan = htmlspecialchars($_POST['syarat_ketentuan'] ?? "");

$gambar = $_POST['gambar'] ?? "";
if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] == 0) {
    $target_dir = "../../uploads/";
    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true);
    }
    $file_extension = strtolower(pathinfo($_FILES['gambar']['name'], PATHINFO_EXTENSION));
    $new_filename = uniqid() . '.' . $file_extension;
    $target_file = $target_dir . $new_filename;
    
    if (move_uploaded_file($_FILES['gambar']['tmp_name'], $target_file)) {
        $gambar = "uploads/" . $new_filename;
    }
}

if($gambar == "") {
 	$query = "UPDATE manajemen_paket SET nama_paket = '$nama', durasi = '$durasi', lokasi = '$lokasi', harga = $harga, label = '$label', rating = $rating, deskripsi = '$deskripsi', destinasi = '$destinasi', fasilitas_include = '$fasilitas_include', fasilitas_exclude = '$fasilitas_exclude', syarat_ketentuan = '$syarat_ketentuan' WHERE id = $id";
 } else {
 	$query = "UPDATE manajemen_paket SET nama_paket = '$nama', durasi = '$durasi', lokasi = '$lokasi', harga = $harga, gambar = '$gambar', label = '$label', rating = $rating, deskripsi = '$deskripsi', destinasi = '$destinasi', fasilitas_include = '$fasilitas_include', fasilitas_exclude = '$fasilitas_exclude', syarat_ketentuan = '$syarat_ketentuan' WHERE id = $id";
 }
$update = mysqli_query($koneksi, $query);

if ($update == TRUE) {
    header("location: ../../data-manajemen-paket?success=Data berhasil diperbarui.");
} else {
    echo "Gagal Memperbarui";
}
?>
