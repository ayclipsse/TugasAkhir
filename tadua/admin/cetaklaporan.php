<?php
include('../koneksi.php');
include ('auth.php');
if (isset($_POST['start_date']) && isset($_POST['end_date'])) {
    $startDate = $_POST['start_date'];
    $endDate = $_POST['end_date'];
    $formattedStartDate = date("Y-m-d", strtotime($startDate));
    $formattedEndDate = date("Y-m-d", strtotime($endDate));
    $query = "SELECT m.nama_menu, d.qty, d.total_harga, t.create_date, t.nama, t.no_antrian, t.id_transaksi
              FROM detail d 
              JOIN menu m ON d.id_menu = m.id_menu
              JOIN transaksi t ON d.id_transaksi = t.id_transaksi
              WHERE DATE(t.create_date) BETWEEN '$formattedStartDate' AND '$formattedEndDate' 
              ORDER BY t.create_date ASC";

    $result = mysqli_query($koneksi, $query);
    if ($result && mysqli_num_rows($result) > 0) {
        $totalPrice = 0;
        $data = []; 

        while ($transaksi = mysqli_fetch_assoc($result)) {
            $data[] = $transaksi;
            $totalPrice += $transaksi['total_harga'];
        }
    } else {
        echo "Tidak ada transaksi antara $formattedStartDate dan $formattedEndDate!";
        exit;
    }
} else {
    echo "Tanggal transaksi tidak ada!";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Struk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .container {
            margin-top: 50px;
            max-width: 900px;
        }

        .struk {
            background-color: #fff;
            border: 1px solid #dee2e6;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }

        .struk h2 {
            color: #495057;
            margin-bottom: 20px;
        }

        .struk hr {
            margin: 20px 0;
        }

        table {
            margin-top: 20px;
        }

        .table thead {
            background-color: #6c757d;
            color: white;
        }

        .table td,
        .table th {
            vertical-align: middle;
        }

        .total {
            font-size: 1.25rem;
            font-weight: bold;
            margin-top: 20px;
        }

        @media print {
            .no-print {
                display: none;
            }

            body {
                background-color: white;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="struk">
            <h2 class="text-center">Struk Laporan</h2>
            <hr>
            <table class="table table-bordered">
                <tbody>
                    <?php
                    if (!empty($data)) {
                        $previousDate = null;
                        $a = 1;

                        foreach ($data as $transaksi) {
                            $currentDate = date("d-m-Y", strtotime($transaksi['create_date']));
                            if ($previousDate != $currentDate) {
                                if ($previousDate != null) {
                                    echo "</tbody></table></div>";
                                }

                                echo "<div class='table-wrapper print-table'>";
                                echo "<table class='table table-striped table-bordered'>
                            <thead>
                            <h3>Tanggal: $currentDate</h3>
                            <tr>
                            <th scope='col'>No</th>
                            <th scope='col'>Nama</th>
                            <th scope='col'>No Antrian</th>
                            <th scope='col'>Tanggal</th>
                            <th scope='col'>Status</th>
                            <th scope='col'>Keterangan</th>
                            </tr>
                            </thead>
                            <tbody>
                            ";

                                $previousDate = $currentDate;
                            }
                            echo "<tr>
                    <td>$a</td>
                    <td>{$transaksi['nama']}</td>
                    <td>{$transaksi['no_antrian']}</td>
                    <td>$currentDate</td>
                    <td>lunas</td>
                    <td>";
                            $id_transaksi = $transaksi['id_transaksi'];
                            $detail_query = "SELECT m.nama_menu, d.qty, d.total_harga 
                                 FROM detail d 
                                 JOIN menu m ON d.id_menu = m.id_menu 
                                 WHERE d.id_transaksi = $id_transaksi";
                            $detail_result = mysqli_query($koneksi, $detail_query);

                            if (mysqli_num_rows($detail_result) > 0) {
                                echo "<ul>";
                                while ($detail_row = mysqli_fetch_array($detail_result)) {
                                    echo "<li>{$detail_row['nama_menu']} ({$detail_row['qty']} pcs) - Rp " . number_format($detail_row['total_harga'], 0, ',', '.') . "</li>";
                                }
                                echo "</ul>";
                            } else {
                                echo "Tidak ada detail pesanan";
                            }
                            echo "</td></tr>";
                            $a++;
                        }
                        echo "</tbody></table>";
                    }
                    ?>
                    <h4 class="text-end">Total Pendapatan: Rp <?php echo number_format($totalPrice, 0, ',', '.'); ?></h4>
                </tbody>
            </table>
            <button onclick="window.print();" class="btn btn-primary no-print">Cetak Struk</button>
            <a href="laporan.php" class="btn btn-secondary no-print">Kembali</a>
        </div>
        <br>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>