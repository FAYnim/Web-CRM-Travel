<?php
include('../../config.php');

if(isset($_GET['id'])){
    $id = $_GET['id'];
    mysqli_query($koneksi, "DELETE FROM manajemen_pembayaran WHERE id='$id'");
}

header("Location: ../../data-manajemen-pembayaran");
exit;
?>
