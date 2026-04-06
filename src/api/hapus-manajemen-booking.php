<?php
include('../../config.php');

$id = $_GET['id'];

$hapus = mysqli_query($koneksi, "DELETE FROM manajemen_booking WHERE id = '$id'");

if($hapus == TRUE){
<<<<<<< HEAD
    header("Location: ../../data-manajemen-booking.php");
=======
    header("Location: ../../data-manajemen-booking");
>>>>>>> 06752c650dbc56340aebe3dd4093532eaa753ef5
}else{
    echo "Gagal Terhapus";
}
?>
