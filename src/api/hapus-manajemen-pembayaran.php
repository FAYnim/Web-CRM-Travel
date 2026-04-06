<?php
include('../../config.php');

if(isset($_GET['id'])){
    $id = $_GET['id'];
    mysqli_query($koneksi, "DELETE FROM manajemen_pembayaran WHERE id='$id'");
}

<<<<<<< HEAD
header("Location: ../../data-manajemen-pembayaran.php");
=======
header("Location: ../../data-manajemen-pembayaran");
>>>>>>> 06752c650dbc56340aebe3dd4093532eaa753ef5
exit;
?>
