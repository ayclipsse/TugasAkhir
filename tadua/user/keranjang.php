<?php
include('../koneksi.php');
$id_transaksi = $_GET['id_transaksi'];

if (isset($_POST['hapus'])) {
    $id = $_POST['id_detail'];
    $ambilqt = mysqli_query($koneksi, "SELECT qty FROM detail WHERE id_detail=$id");
    $row = mysqli_fetch_assoc($ambilqt);
    $ambilqty = mysqli_query($koneksi, "SELECT qty_total FROM transaksi WHERE id_transaksi=$id_transaksi");
    $rowdt = mysqli_fetch_assoc($ambilqty);
    $new_qt = $rowdt['qty_total'] - $row['qty'];
    $q = mysqli_query($koneksi, "UPDATE transaksi SET qty_total = $new_qt");
    $id = $koneksi->real_escape_string($id);
    $sql = "DELETE FROM detail WHERE id_detail = '$id'";
    if ($koneksi->query($sql) === TRUE) {
        header("Location: keranjang.php?id_transaksi=$id_transaksi");
        exit();
    } else {
        echo "<div class='alert alert-danger' role='alert'>Error deleting record: " . $koneksi->error . "</div>";
    }
    $koneksi->close();
}
if (isset($_POST['order'])) {
    $total = $_POST['total'];
    $total = $koneksi->real_escape_string($total);
    $sql = "UPDATE transaksi SET total_harga = $total, qty_total = (SELECT SUM(qty) FROM detail WHERE id_transaksi = $id_transaksi) WHERE id_transaksi = $id_transaksi";

    if ($koneksi->query($sql) === TRUE) {
        header("Location: order.php?id_transaksi=$id_transaksi");
        exit();
    } else {
        echo "<div class='alert alert-danger' role='alert'>Error updating record: " . $koneksi->error . "</div>";
    }
    $koneksi->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KASIR - Warung DJENG NITA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-image: url('bg.png');
            background-size: cover;
            background-repeat: no-repeat;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .navbar {
            background-color: #4E342E;
            color: white;
        }

        .navbar h1 {
            color: white;
            font-weight: bold;
        }

        .container {
            padding: 20px;
        }

        h2 {
            color: #fff;
            text-align: center;
            margin-top: 30px;
        }

        table {
            background-color: #fff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        th,
        td {
            vertical-align: middle;
            text-align: center;
            padding: 15px;
        }

        th {
            background-color: #8b5a2b;
            color: #fff;
        }

        .btn-warning,
        .btn-success,
        .btn-danger {
            border-radius: 25px;
            padding: 10px 20px;
        }

        .alert {
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand">
                <h1>Warung DJENG NITA</h1>
            </a>
            </a>
        </div>
    </nav>

    <div class="container">
        <h2>My Cart</h2>
        <br>
        <div class="row">
            <div class="col-12 ">
                <div class="table-wrapper" style="max-height: 400px; overflow-y: auto;">
                    <table class="table table-striped table-hover dtabel">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Gambar</th>
                                <th scope="col">Nama Menu</th>
                                <th scope="col">Harga</th>
                                <th scope="col">Qty</th>
                                <th scope="col">SubTotal</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="table-group-divider">
                            <?php
                            $q = "SELECT detail.id_detail, detail.qty, detail.total_harga, menu.nama_menu, menu.harga_menu, menu.gambar
                              FROM detail
                              INNER JOIN menu ON detail.id_menu = menu.id_menu
                              WHERE detail.id_transaksi = $id_transaksi";
                            $a = 1;
                            $total_semua = 0;
                            $result = mysqli_query($koneksi, $q);
                            while ($row = mysqli_fetch_array($result)) {
                                $total_semua += $row['total_harga'];
                                echo "<tr>
                                <td>$a</td>
                                <td><img src='{$row['gambar']}' alt='Gambar Menu' width='50' height='50' style='border-radius: 50%;'></td>
                                <td>{$row['nama_menu']}</td>
                                <td>Rp. " . number_format($row['harga_menu'], 0, ',', '.') . "</td>
                                <td>{$row['qty']}</td>
                                <td id='subtotal-{$row['id_detail']}'>Rp. " . number_format($row['total_harga'], 0, ',', '.') . "</td>
                                <td>
                                    <form method='post'>
                                        <input type='hidden' name='id_detail' value='{$row['id_detail']}'>
                                        <button class='btn btn-danger' type='submit' name='hapus'>
                                            <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash3-fill' viewBox='0 0 16 16'>
                                                <path d='M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5m-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5M4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06m6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528M8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5'/>
                                            </svg>
                                        </button>
                                    </form>
                                </td>
                            </tr>";
                                $a++;
                            }
                            $q_qtotal = "SELECT SUM(qty) as qty_total FROM detail WHERE id_transaksi = $id_transaksi";
                            $result_qtotal = mysqli_query($koneksi, $q_qtotal);
                            $row_qtotal = mysqli_fetch_assoc($result_qtotal);
                            $qty_total = $row_qtotal['qty_total'];
                            ?>
                        </tbody>
                    </table>
                </div>
                <br>
                <div class="d-flex justify-content-between align-items-center">
                    <a href="menu.php?id_transaksi=<?= $id_transaksi ?>" class='btn btn-warning'>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-left-fill" viewBox="0 0 16 16">
                            <path d="m3.86 8.753 5.482 4.796c.646.566 1.658.106 1.658-.753V3.204a1 1 0 0 0-1.659-.753l-5.48 4.796a1 1 0 0 0 0 1.506z" />
                        </svg> Continue Ordering
                    </a>
                    <br>
                    <div class="d-flex align-items-center">
                        <form method="post">
                            <input type="hidden" name="total" value="<?= $total_semua ?>">
                            <button type="submit" class="btn btn-success ms-3" name="order">
                                <h3>Total: Rp. <span id="total"><?php echo number_format($total_semua, 0, ',', '.'); ?></span></h3>
                                <p>Items in cart: <?php echo $qty_total; ?> pcs</p>
                                Order
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-right-fill" viewBox="0 0 16 16">
                                    <path d="m12.14 8.753-5.482 4.796c-.646.566-1.658.106-1.658-.753V3.204a1 1 0 0 1 1.659-.753l5.48 4.796a1 1 0 0 1 0 1.506z" />
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>