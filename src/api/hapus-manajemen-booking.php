<?php
include('config.php');

$id = $_GET['id'];

$hapus = mysqli_query($koneksi, "DELETE FROM manajemen_booking WHERE id = '$id'");

if($hapus == TRUE){
    echo "<script>alert('Data berhasil dihapus');</script>";
    echo "<script>window.location.href='data-manajemen-booking.php';</script>";
}else{
    echo "<script>alert('Data gagal dihapus');</script>";
    echo "<script>window.location.href='data-manajemen-booking.php';</script>";
}
?>
