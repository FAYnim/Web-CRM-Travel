<?php
include('config.php');

$page_title = 'Data Customer';
ob_start();
?>

<div class="dashboard-card">
    <div class="card-header d-flex align-items-center justify-content-between">
        <span><i class="bi bi-people me-2"></i>Data Customer</span>
        <a href="manajemen-customer.php" class="btn btn-primary btn-sm">
            <i class="bi bi-person-plus me-1"></i>Tambah Customer Baru
        </a>
    </div>
    <div class="card-body p-0">
        <p class="text-muted px-3 pt-3 mb-3">Berikut adalah data yang sudah terdaftar</p>
        <div class="table-responsive">
            <table class="table table-dashboard">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Handphone</th>
                        <th>Alamat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $data = mysqli_query($koneksi, "SELECT * FROM manajemen_customer");
                    $no = 0;
                    while ($baris = mysqli_fetch_array($data)){
                        $no++;
                    ?>
                    <tr>
                        <td><?php echo $no; ?></td>
                        <td><?php echo htmlspecialchars($baris['nama']); ?></td>
                        <td><?php echo htmlspecialchars($baris['email']); ?></td>
                        <td><?php echo htmlspecialchars($baris['handphone']); ?></td>
                        <td><?php echo htmlspecialchars($baris['alamat']); ?></td>
                        <td>
                            <a href="edit-manajemen-customer.php?id=<?php echo $baris['id'] ?>" class="btn btn-sm btn-warning">
                                <i class="bi bi-pencil"></i> Edit
                            </a>
                            <a href="src/api/hapus-manajemen-customer.php?id=<?php echo $baris['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
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
