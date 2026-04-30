<?php
function sync_booking_payment_status($koneksi, $booking_id) {
    $booking_id = (int) $booking_id;
    if ($booking_id <= 0) {
        return;
    }

    $booking_query = mysqli_query($koneksi, "SELECT COALESCE(p.harga, 0) AS harga
                                             FROM manajemen_booking b
                                             LEFT JOIN manajemen_paket p ON b.paket_id = p.id
                                             WHERE b.id = '$booking_id'");
    $booking = mysqli_fetch_assoc($booking_query);
    if (!$booking) {
        return;
    }

    $payment_query = mysqli_query($koneksi, "SELECT COALESCE(SUM(jumlah), 0) AS total_bayar
                                             FROM manajemen_pembayaran
                                             WHERE booking_id = '$booking_id'");
    $payment = mysqli_fetch_assoc($payment_query);

    $harga = (int) ($booking['harga'] ?? 0);
    $total_bayar = (int) ($payment['total_bayar'] ?? 0);
    $status_pembayaran = ($harga > 0 && $total_bayar >= $harga) ? 1 : 0;

    mysqli_query($koneksi, "UPDATE manajemen_booking
                            SET status_pembayaran = '$status_pembayaran'
                            WHERE id = '$booking_id'");
}

function get_booking_label($koneksi, $booking_id) {
    $booking_id = (int) $booking_id;
    $query = mysqli_query($koneksi, "SELECT b.id,
                                            c.nama AS customer,
                                            p.nama_paket AS paket
                                     FROM manajemen_booking b
                                     LEFT JOIN manajemen_customer c ON b.customer_id = c.id
                                     LEFT JOIN manajemen_paket p ON b.paket_id = p.id
                                     WHERE b.id = '$booking_id'");
    $booking = mysqli_fetch_assoc($query);

    if (!$booking) {
        return '';
    }

    return 'ID' . $booking['id'] . ' - ' . ($booking['customer'] ?? '-') . ' - ' . ($booking['paket'] ?? '-');
}
?>
