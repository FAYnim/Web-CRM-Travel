<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Manajemen Pembayaran</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f8;
            padding: 20px;
        }

        h2 {
            text-align: center;
        }

        .container {
            max-width: 900px;
            margin: auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }

        form {
            margin-bottom: 30px;
        }

        label {
            font-weight: bold;
        }

        input, select {
            width: 100%;
            padding: 8px;
            margin: 6px 0 15px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        button {
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .btn-simpan {
            background: #28a745;
            color: white;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table th, table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
        }

        table th {
            background: #007bff;
            color: white;
        }

        .btn-edit {
            background: #ffc107;
            color: black;
        }

        .btn-hapus {
            background: #dc3545;
            color: white;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Manajemen Pembayaran</h2>

    <!-- Form Input Pembayaran -->
    <form>
        <label>Booking</label>
        <input type="text" placeholder="Kode / Nama Booking">

        <label>Tanggal Pembayaran</label>
        <input type="date">

        <label>Jumlah Pembayaran</label>
        <input type="number" placeholder="Masukkan jumlah">

        <label>Metode Pembayaran</label>
        <select>
            <option>-- Pilih Metode --</option>
            <option>Transfer Bank</option>
            <option>Cash</option>
            <option>E-Wallet</option>
        </select>

        <button type="submit" class="btn-simpan">Simpan Pembayaran</button>
    </form>

    <!-- Tabel Riwayat Pembayaran -->
    <h3>Riwayat Pembayaran</h3>
    <table>
        <tr>
            <th>No</th>
            <th>Booking</th>
            <th>Tanggal</th>
            <th>Jumlah</th>
            <th>Metode</th>
            <th>Aksi</th>
        </tr>
        <tr>
            <td>1</td>
            <td>BK-001</td>
            <td>2026-02-05</td>
            <td>Rp 500.000</td>
            <td>Transfer Bank</td>
            <td>
                <button class="btn-edit">Edit</button>
                <button class="btn-hapus">Hapus</button>
            </td>
        </tr>
    </table>
</div>

</body>
</html>
