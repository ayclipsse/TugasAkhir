<?php
include('../koneksi.php');
include('auth.php');
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
            color: #ffffff;
        }

        .navbar {
            background-color: rgba(255, 255, 255, 0.9);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
        }

        .navbar-brand h3 {
            color: #6d4c41;
        }

        h2 {
            text-shadow: 0 0 10px #ffb74d;
            margin-bottom: 20px;
        }

        .table {
            border-radius: 10px;
            overflow: hidden;
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

        .btn-success {
            border-radius: 20px;
        }

        .footer {
            text-align: center;
            padding: 20px 0;
            background-color: rgba(0, 0, 0, 0.7);
            color: #ffffff;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>

<body>
    <?php
    include('navbar.php')
    ?>


    <div class="container my-5">
        <h2>Data Pelanggan</h2>
        <div class="table-wrapper" style="max-height: 400px; overflow-y: auto;">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama</th>
                        <th scope="col">No Antrian</th>
                        <th scope="col">Status</th>
                        <th scope="col">Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $a = 1;
                    $q = "SELECT * FROM transaksi ORDER BY create_date DESC, no_antrian DESC";
                    $result = mysqli_query($koneksi, $q);
                    while ($row = mysqli_fetch_array($result)) {
                        echo "<tr>
                    <td>$a</td>
                    <td>$row[nama]</td>
                    <td>$row[no_antrian]</td>
                    <td>lunas</td>
                    <td>
                    <a href='detailpesanan.php?id_transaksi=$row[id_transaksi]' class='btn btn-success'>PESANAN</a>
                    </td>
                    </tr>";
                        $a++;
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>