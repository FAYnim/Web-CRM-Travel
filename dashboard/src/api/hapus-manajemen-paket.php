<?php
include('../../config.php');

$id = (int)$_GET['id'];

$delete = mysqli_query($koneksi, "DELETE FROM manajemen_paket WHERE id = $id");

if ($delete == TRUE) {
    header("location: ../../data-manajemen-paket?success=Data berhasil dihapus.");
} else {
    echo "Gagal Menghapus";
}
?>
