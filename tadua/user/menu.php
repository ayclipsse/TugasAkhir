<?php
include('../koneksi.php');
$id_transaksi = $_GET['id_transaksi'];
if (isset($_POST['addma'])) {
    $id_menu = $_POST['id_menu'];
    $harga_menu = $_POST['harga_menu'];
    $ambil = mysqli_query($koneksi, "SELECT qty FROM detail WHERE id_transaksi=$id_transaksi AND id_menu=$id_menu");
    if (mysqli_num_rows($ambil) > 0) {
        $ambilqt = mysqli_query($koneksi, "SELECT qty_total FROM transaksi WHERE id_transaksi=$id_transaksi");
        $row = mysqli_fetch_assoc($ambilqt);
        $new_qt = $row['qty_total'] + 1;
        $update = mysqli_query($koneksi, "UPDATE transaksi SET qty_total=$new_qt WHERE id_transaksi=$id_transaksi");
        $row = mysqli_fetch_assoc($ambil);  
        $new_qty = $row['qty'] + 1;
        $update = mysqli_query($koneksi, "UPDATE detail SET qty=$new_qty, total_harga=qty*$harga_menu WHERE id_transaksi=$id_transaksi AND id_menu=$id_menu");
        if ($update) {
            header("Location: menu.php?id_transaksi=" . $id_transaksi);
            exit();
        } else {
            echo "Terjadi kesalahan saat memperbarui data.";
        }
    } else {
        $ambilqt = mysqli_query($koneksi, "SELECT qty_total FROM transaksi WHERE id_transaksi=$id_transaksi");
        $row = mysqli_fetch_assoc($ambilqt);
        $new_qt = $row['qty_total'] + 1;
        $update = mysqli_query($koneksi, "UPDATE transaksi SET qty_total=$new_qt WHERE id_transaksi=$id_transaksi");
        $simpan = mysqli_query($koneksi, "INSERT INTO detail (id_detail, id_menu, qty, total_harga, id_transaksi) VALUES ('', '$id_menu', '1', '$harga_menu', '$id_transaksi')");
        if ($simpan) {
            header("Location: menu.php?id_transaksi=" . $id_transaksi);
            exit();
        } else {
            echo "Terjadi kesalahan saat menyimpan data.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu - Warung DJENG NITA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body {
            background-image: url('bg.png');
            background-size: cover;
            background-repeat: no-repeat;
            color: #ffffff;
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
            margin-top: 40px;
        }

        h3 {
            color: #FFCC80;
            text-align: center;
            text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.4);
        }

        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: scale(1.05);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.4);
        }

        .card img {
            border-top-left-radius: 15px;
            border-top-right-radius: 15px;
            max-height: 180px;
            object-fit: cover;
        }

        .card-body {
            background-color: #FFF3E0;
            border-bottom-left-radius: 15px;
            border-bottom-right-radius: 15px;
            text-align: center;
        }

        .btn-primary {
            background-color: #FF9800;
            border: none;
            border-radius: 25px;
            padding: 10px 20px;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #F57C00;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .card-title,
        .card-text {
            color: #4E342E;
            font-weight: bold;
        }

        .card-text {
            font-size: 0.9rem;
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

    <nav class="navbar navbar-expand-lg sticky-top">
        <div class="container-fluid">
        <a class="navbar-brand"><h1>Warung DJENG NITA</h1></a>
        </div>
        <?php
        $q = "SELECT * FROM transaksi WHERE id_transaksi = $id_transaksi";
        $result = mysqli_query($koneksi, $q);
        $row = mysqli_fetch_array($result)
        ?>
        <a href="keranjang.php?id_transaksi=<?= $id_transaksi ?>" class="btn btn-primary">
        <?=$row['qty_total'] ?>    
        <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-cart4' viewBox='0 0 16 16'>
                <path d='M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5M3.14 5l.5 2H5V5zM6 5v2h2V5zm3 0v2h2V5zm3 0v2h1.36l.5-2zm1.11 3H12v2h.61zM11 8H9v2h2zM8 8H6v2h2zM5 8H3.89l.5 2H5zm0 5a1 1 0 1 0 0 2 1 1 0 0 0 0-2m-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0m9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2m-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0' />
            </svg></a>

    </nav>
    <div class="container">
        <center>
            <h1>Makanan</h1>
        </center>
        <br>
        <div class="row">
            <?php
            $q = "SELECT * FROM menu WHERE id_kategori=1";
            $result = mysqli_query($koneksi, $q);
            while ($row = mysqli_fetch_array($result)) {
                echo "
                    <div class='col-md-3 mb-4'>
                        <div class='card'>
                            <img src='$row[gambar]' class='card-img-top' alt='...'>
                            <div class='card-body'>
                                <form method='post'>
                                    <h5 class='card-title'>$row[nama_menu]</h5>
                                    <p class='card-text'>$row[deskripsi]</p>
                                    <p class='card-text'>Rp. $row[harga_menu],-</p>
                                    <input type='hidden' value='$row[id_menu]' name='id_menu'>
                                    <input type='hidden' value='$row[harga_menu]' name='harga_menu'>
                                    <button type='submit' name='addma' class='btn btn-primary'>
                                        order
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                ";
            }
            ?>
        </div>
        <br>
        <br>
        <center>
            <h1>Minuman</h1>
        </center>
        <br>
        <div class="row">
            <?php
            $q = "SELECT * FROM menu WHERE id_kategori=2";
            $result = mysqli_query($koneksi, $q);
            while ($row = mysqli_fetch_array($result)) {
                echo "
                    <div class='col-md-3 mb-4'>
                        <div class='card'>
                            <img src='$row[gambar]' class='card-img-top' alt='...'>
                            <div class='card-body'>
                                <form method='post'>
                                    <h5 class='card-title'>$row[nama_menu]</h5>
                                    <p class='card-text'>$row[deskripsi]</p>
                                    <p class='card-text'>Rp. $row[harga_menu],-</p>
                                    <input type='hidden' value='$row[id_menu]' name='id_menu'>
                                    <input type='hidden' value='$row[harga_menu]' name='harga_menu'>
                                    <button type='submit' name='addma' class='btn btn-primary'>
                                        order
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                ";
            }
            ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>