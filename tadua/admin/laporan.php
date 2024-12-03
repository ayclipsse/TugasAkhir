<?php
include('../koneksi.php');
include('auth.php');
$startDate = '';
$endDate = '';

if (isset($_POST['start_date']) && isset($_POST['end_date'])) {
    $startDate = $_POST['start_date'];
    $endDate = $_POST['end_date'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pelanggan - Warung Djeng Nita</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            background-image: url('bg.png');
            background-size: cover;
            background-repeat: no-repeat;
            background-color: #6B4423;
            color: black;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        h2,
        h3 {
            text-shadow: 0 0 10px white;
        }

        .table {
            border-radius: 10px;
        }

        .table th,
        .table td {
            vertical-align: middle;
            text-align: center;
        }

        .table-striped tbody tr:nth-of-type(odd) {
            background-color: #6d4c41;
        }

        .table-striped tbody tr:nth-of-type(even) {
            background-color: #8d6e63;
        }

        .table-wrapper {
            max-height: 400px;
            max-width: 100%;
            overflow-y: auto;
            overflow-x: auto;
            background-color: #fff;
            border-radius: 15px;
            padding: 10px;
        }

        @media print {
            .no-print {
                display: none;
            }

            .print-table {
                display: block;
            }
        }
    </style>
</head>

<body>
    <?php
    include('navbar.php')
    ?>

    <div class="container my-5 no-print">
        <h4 class="text-center mb-4" style="color: #fff;">Cari Transaksi Berdasarkan Tanggal</h4>
        <form method="POST" class="row justify-content-center align-items-end">
            <div class="col-md-3">
                <label for="start_date" class="form-label" style="color: #fff;">Dari Tanggal:</label>
                <input type="date" id="start_date" name="start_date" class="form-control" required>
            </div>
            <div class="col-md-3">
                <label for="end_date" class="form-label" style="color: #fff;">Sampai Tanggal:</label>
                <input type="date" id="end_date" name="end_date" class="form-control" required>
            </div>
            <div class="col-md-2 d-grid">
                <button class="btn btn-primary mt-3" type="submit">
                    Cari
                </button>
            </div>
        </form>
    </div>
    <div class="container px-4">

        <div class='table-wrapper print-table'>
            <?php
            if ($startDate && $endDate) {
                $formattedStartDate = date("Y-m-d", strtotime($startDate));
                $formattedEndDate = date("Y-m-d", strtotime($endDate));

                $q = "SELECT * FROM transaksi WHERE DATE(create_date) BETWEEN '$formattedStartDate' AND '$formattedEndDate' ORDER BY create_date ASC";
                $result = mysqli_query($koneksi, $q);

                $previousDate = null;
                $a = 1;
                $totalPrice = 0;

                echo "<table class='table table-striped table-bordered'>
                <thead>
                <tr>
                    <th scope='col'>No</th>
                    <th scope='col'>Nama</th>
                    <th scope='col'>No Antrian</th>
                    <th scope='col'>Tanggal</th>
                    <th scope='col'>Status</th>
                    <th scope='col'>Keterangan</th>
                </tr>
                </thead>
                <tbody>";

                while ($row = mysqli_fetch_array($result)) {
                    $currentDate = date("d-m-Y", strtotime($row['create_date']));
                    if ($previousDate != $currentDate) {
                        $previousDate = $currentDate;
                    }

                    $id_transaksi = $row['id_transaksi'];
                    $detail_query = "SELECT m.nama_menu, d.qty, d.total_harga 
                             FROM detail d 
                             JOIN menu m ON d.id_menu = m.id_menu 
                             WHERE d.id_transaksi = $id_transaksi";
                    $detail_result = mysqli_query($koneksi, $detail_query);

                    if (mysqli_num_rows($detail_result) > 0) {
                        echo "<tr>
                    <td>$a</td>
                    <td>{$row['nama']}</td>
                    <td>{$row['no_antrian']}</td>
                    <td>$currentDate</td>
                    <td>lunas</td>
                    <td><ul>";

                        while ($detail_row = mysqli_fetch_array($detail_result)) {
                            echo "<li>{$detail_row['nama_menu']} ({$detail_row['qty']} pcs) - Rp {$detail_row['total_harga']}</li>";
                            $totalPrice += $detail_row['total_harga'];
                        }
                        echo "</ul>Total Harga: Rp " . $totalPrice;
                        echo "</td></tr>";
                    } else {
                        echo "<tr>
                    <td>$a</td>
                    <td>{$row['nama']}</td>
                    <td>{$row['no_antrian']}</td>
                    <td>$currentDate</td>
                    <td>lunas</td>
                    <td>Tidak ada detail pesanan</td>
                </tr>";
                    }
                    $a++;
                }

                echo "</tbody></table></div>"; ?>
                <form method="POST" class=" align-items-end" action="cetaklaporan.php">
                    <div class="col-md-3">
                        <input type="hidden" id="start_date" name="start_date" class="form-control" value="<?= $startDate ?>">
                        <input type="hidden" id="end_date" name="end_date" class="form-control" value="<?= $endDate ?>">
                    </div>
                    <div class="col-md-2 d-grid">
                        <button class="btn btn-primary mt-3" type="submit">
                            Cetak
                        </button>
                    </div>
                </form>
            <?php
            }
            ?>

            <br>
            <br>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>