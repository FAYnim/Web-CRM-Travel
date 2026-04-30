<?php
include('../../config.php');
include('payment-status-helper.php');

$booking_id = isset($_POST['booking_id']) ? (int) $_POST['booking_id'] : 0;
$booking = mysqli_real_escape_string($koneksi, get_booking_label($koneksi, $booking_id));
$tanggal = mysqli_real_escape_string($koneksi, $_POST['tanggal']);
$jumlah = (int) $_POST['jumlah'];
$metode = mysqli_real_escape_string($koneksi, $_POST['metode']);
$bukti_transfer = "";

if ($booking_id <= 0 || empty($booking)) {
    echo "Booking tidak valid";
    exit;
}

if (isset($_FILES['bukti_transfer']) && $_FILES['bukti_transfer']['error'] == 0) {
    $target_dir = "../../uploads/";
    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    $file_extension = strtolower(pathinfo($_FILES['bukti_transfer']['name'], PATHINFO_EXTENSION));
    $allowed_extensions = ['jpg', 'jpeg', 'png', 'webp', 'pdf'];

    if (!in_array($file_extension, $allowed_extensions)) {
        echo "Format bukti transfer tidak didukung";
        exit;
    }

    $new_filename = 'bukti_pembayaran_' . uniqid() . '.' . $file_extension;
    $target_file = $target_dir . $new_filename;

    if (move_uploaded_file($_FILES['bukti_transfer']['tmp_name'], $target_file)) {
        $bukti_transfer = "uploads/" . $new_filename;
    } else {
        echo "Gagal mengupload bukti transfer";
        exit;
    }
}

$submit = mysqli_query($koneksi,"INSERT INTO manajemen_pembayaran (booking_id,booking,tanggal,jumlah,metode,bukti_transfer) VALUES ('$booking_id','$booking','$tanggal','$jumlah','$metode','$bukti_transfer')");

if($submit == TRUE){
    sync_booking_payment_status($koneksi, $booking_id);
    // echo "Berhasil Tersimpan ke Database";
	header("Location: ../../data-manajemen-pembayaran");
}else{
    echo "Gagal Tersimpan";
}
?>
