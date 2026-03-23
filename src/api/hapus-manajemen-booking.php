<?php
include('../../config.php');

$id = $_GET['id'];

$hapus = mysqli_query($koneksi, "DELETE FROM manajemen_booking WHERE id = '$id'");

if($hapus == TRUE){
    header("Location: ../../data-manajemen-booking");
}else{
    echo "Gagal Terhapus";
}
?>
