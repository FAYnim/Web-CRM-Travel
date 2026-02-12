<?php
include('config.php');

$page_title = 'Data Pembayaran';
ob_start();
?>

<div class="dashboard-card">
    <div class="card-header d-flex align-items-center justify-content-between">
        <span><i class="bi bi-credit-card me-2"></i>Data Pembayaran</span>
        <a href="manajemen-pembayaran.php" class="btn btn-primary btn-sm">
            <i class="bi bi-cash-stack me-1"></i>Tambah Pembayaran Baru
        </a>
    </div>
    <div class="card-body p-0">
        <p class="text-muted px-3 pt-3 mb-3">Berikut adalah data yang sudah membayar</p>
        <div class="table-responsive">
            <table class="table table-dashboard">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Booking</th>
                        <th>Jumlah</th>
                        <th>Metode</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $data = mysqli_query($koneksi, "SELECT * FROM manajemen_pembayaran");
                    $no = 0;
                    while($baris = mysqli_fetch_array($data)){
                        $no++;
                    ?>
                    <tr>
                        <td><?php echo $no; ?></td>
                        <td><?php echo htmlspecialchars($baris['booking']); ?></td>
                        <td>
                            <span class="fw-semibold text-success">
                                Rp <?php echo number_format($baris['jumlah'], 0, ',', '.'); ?>
                            </span>
                        </td>
                        <td>
                            <span class="badge <?php echo $baris['metode'] === 'transfer' ? 'bg-primary' : 'bg-secondary'; ?>">
                                <?php echo htmlspecialchars($baris['metode']); ?>
                            </span>
                        </td>
                        <td><?php echo $baris['tanggal'] ? date('d M Y', strtotime($baris['tanggal'])) : '-'; ?></td>
                        <td>
                            <a href="edit-manajemen-pembayaran.php?id=<?php echo $baris['id'] ?>" class="btn btn-sm btn-warning">
                                <i class="bi bi-pencil"></i> Edit
                            </a>
                            <a href="src/api/hapus-manajemen-pembayaran.php?id=<?php echo $baris['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                <i class="bi bi-trash"></i> Hapus
                            </a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
include('layout.php');
?>
