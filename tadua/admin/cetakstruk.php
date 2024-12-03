<?php
include('../koneksi.php');
include('auth.php');
if (isset($_GET['id_transaksi'])) {
    $id_transaksi = $_GET['id_transaksi'];
}
$q = "SELECT * FROM transaksi WHERE id_transaksi=$id_transaksi";
$result = mysqli_query($koneksi, $q);
$rw = mysqli_fetch_array($result);
$query = "SELECT m.nama_menu, d.qty, d.total_harga
                 FROM detail d 
                 JOIN menu m ON d.id_menu = m.id_menu 
                 WHERE d.id_transaksi=$id_transaksi";
$detail_result = mysqli_query($koneksi, $query);
$total_query = "SELECT SUM(total_harga) AS total_harga FROM detail WHERE id_transaksi = $id_transaksi";
$total_result = mysqli_query($koneksi, $total_query);
$total_row = mysqli_fetch_array($total_result);
$total_harga = $total_row['total_harga'] ?? 0;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk Pesanan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-image: url('bg.png');
            background-size: cover;
            background-repeat: no-repeat;
            font-family: Arial, sans-serif;
        }

        .container {
            max-width: 800px;
            margin: 50px auto;
            background-color: #FFF;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            padding: 30px;
        }

        .receipt-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .receipt-header h2 {
            font-size: 2.2rem;
            font-weight: bold;
        }

        .receipt-header h5 {
            color: #333;
        }

        .receipt-details {
            border-top: 2px solid #EEE;
            border-bottom: 2px solid #EEE;
            padding: 10px 0;
        }

        .receipt-details p {
            margin: 0;
            font-weight: 500;
        }

        .list-group-item {
            border: none;
            border-bottom: 1px solid #DDD;
            padding: 10px 0;
        }

        .list-group-item:last-child {
            border-bottom: none;
        }

        .total-price {
            text-align: right;
            font-size: 1.5rem;
            font-weight: bold;
            margin-top: 20px;
            border-top: 2px solid #EEE;
            padding-top: 10px;
        }

        .btn-block {
            display: block;
            width: 100%;
            background-color: #6B4423;
            color: #FFF;
            border: none;
            padding: 15px;
            border-radius: 8px;
            font-size: 1.2rem;
            cursor: pointer;
            text-transform: uppercase;
            transition: background-color 0.3s ease;
        }

        .btn-block:hover {
            background-color: #5A381C;
        }

        @media print {
            .btn-block {
                display: none;
            }
        }
        @media (max-width: 768px) {
            .container {
                padding: 20px;
            }

            .form-tambah {
                padding: 30px;
            }

            .btn-warning {
                width: 100%;
                font-size: 1.1rem;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="receipt-header">
            <h2>Warung DJENG NITA</h2>
            <h5>Terima kasih telah mengunjungi restoran kami!</h5>
            <h6>JL. Kamboja atas NO. 27, RT 05/RW 08, Kelurahan Pesanggrahan, Kecamatan Batu, Kota Batu, Malang, Jawa Timur, 65313 </h6>
            <h6>No Telp 08123456789</h6>
        </div>
        <div class="receipt-details">
            <p>Tanggal: <?= ($rw['create_date']) ?></p>
            <p>Nama: <?= ($rw['nama']) ?></p>
            <p>No Antrian: <?= ($rw['no_antrian']) ?></p>
        </div>
        <h4 class="mt-4">Detail Pesanan</h4>
        <ul class="list-group mb-4">
            <?php while ($row = mysqli_fetch_array($detail_result)) { ?>
                <li class="list-group-item d-flex justify-content-between">
                    <span><?= htmlspecialchars($row['nama_menu']) ?> (<?= htmlspecialchars($row['qty']) ?>)</span>
                    <span>Rp. <?= number_format($row['total_harga'], 0, ',', '.') ?></span>
                </li>
            <?php } ?>
        </ul>
        <div class="total-price">
            Total Harga: Rp. <?= number_format($total_harga, 0, ',', '.') ?>
            <a href="detailpesanan.php?id_transaksi=<?= $id_transaksi?>" onclick="window.print()" class="btn btn-block mt-4">Cetak Struk</a>
        </div>
    </div>
</body>

</html>