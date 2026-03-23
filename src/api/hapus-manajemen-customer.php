<?php
include('../../config.php');

if(isset($_GET['id'])){
    $id = $_GET['id'];
    mysqli_query($koneksi, "DELETE FROM manajemen_customer WHERE id='$id'");
}

header("Location: ../../data-manajemen-customer");
exit;
?>
