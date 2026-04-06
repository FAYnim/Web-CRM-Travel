<?php
include('../../config.php');

if(isset($_GET['id'])){
    $id = $_GET['id'];
    mysqli_query($koneksi, "DELETE FROM manajemen_customer WHERE id='$id'");
}

<<<<<<< HEAD
header("Location: ../../data-manajemen-customer.php");
=======
header("Location: ../../data-manajemen-customer");
>>>>>>> 06752c650dbc56340aebe3dd4093532eaa753ef5
exit;
?>
