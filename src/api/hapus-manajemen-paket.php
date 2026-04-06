<?php
include('../../config.php');

$id = (int)$_GET['id'];

$delete = mysqli_query($koneksi, "DELETE FROM manajemen_paket WHERE id = $id");

if ($delete == TRUE) {
<<<<<<< HEAD
    header("location: ../../data-manajemen-paket.php?success=Data berhasil dihapus.");
=======
    header("location: ../../data-manajemen-paket?success=Data berhasil dihapus.");
>>>>>>> 06752c650dbc56340aebe3dd4093532eaa753ef5
} else {
    echo "Gagal Menghapus";
}
?>
