<?php
include('../../config.php');
include('payment-status-helper.php');

if(isset($_GET['id'])){
    $id = (int) $_GET['id'];
    $query = mysqli_query($koneksi, "SELECT booking_id, bukti_transfer FROM manajemen_pembayaran WHERE id='$id'");
    $data = mysqli_fetch_assoc($query);
    $booking_id = (int) ($data['booking_id'] ?? 0);

    if (!empty($data['bukti_transfer'])) {
        $file_path = '../../' . $data['bukti_transfer'];
        if (file_exists($file_path)) {
            unlink($file_path);
        }
    }

    mysqli_query($koneksi, "DELETE FROM manajemen_pembayaran WHERE id='$id'");
    sync_booking_payment_status($koneksi, $booking_id);
}

header("Location: ../../data-manajemen-pembayaran");
exit;
?>
