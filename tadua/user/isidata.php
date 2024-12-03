<?php
include('../koneksi.php');
function no_antrian()
{
    global $koneksi;
    $today = date('Y-m-d');
    $q = "SELECT no_antrian FROM transaksi WHERE DATE(create_date) = '$today' ORDER BY no_antrian DESC LIMIT 1";
    $lastAntre = mysqli_query($koneksi, $q);
    if (!$lastAntre) {
        die('gagal' . mysqli_error($koneksi));
    }
    $row = mysqli_fetch_assoc($lastAntre);
    if ($row) {
        return $row['no_antrian'] + 1;
    } else {
        return 1;
    }
}
if (isset($_POST['simpan'])) {
    $pnama = trim($_POST['nama']);
    $noAntrian = no_antrian();

    $simpan = mysqli_query($koneksi, "INSERT INTO transaksi (id_transaksi, nama, qty_total, total_harga, status, no_antrian) VALUES ('','$pnama','','','1','$noAntrian')");
    if ($simpan) {
        $last_id = mysqli_insert_id($koneksi);
        echo "<div class='alert alert-success' role='alert'>Data berhasil disimpan dengan ID transaksi: " . $last_id . "</div>";
        header("Location: menu.php?id_transaksi=" . $last_id);
        exit();
    } else {
        echo "<div class='alert alert-danger' role='alert'>Terjadi kesalahan saat menyimpan data. Pesan kesalahan: " . mysqli_error($koneksi) . "</div>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KASIR - Warung DJENG NITA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

    <style>
        body {
            background-image: url('bg.png');
            background-size: cover;
            background-repeat: no-repeat;
            background-color: #62422F;
            font-family: 'Poppins', sans-serif;
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
            max-width: 600px;
            margin: 70px auto;
            padding: 30px;
        }

        .form-tambah {
            background: linear-gradient(135deg, #FFEBEE, #FFE0B2);
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
            border-radius: 25px;
            padding: 40px;
            transition: all 0.3s ease;
        }

        .form-tambah:hover {
            box-shadow: 0 12px 20px rgba(0, 0, 0, 0.3);
            transform: translateY(-5px);
        }

        .form-tambah h3 {
            color: #4E342E;
            font-weight: bold;
            text-align: center;
            margin-bottom: 30px;
        }

        .form-tambah .form-group label {
            color: #4E342E;
            font-weight: bold;
        }

        .form-tambah .form-control {
            border-radius: 10px;
            padding: 12px;
            border: 1px solid #ddd;
            box-shadow: none;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }

        .form-tambah .form-control:focus {
            border-color: #4E342E;
            box-shadow: 0 0 8px rgba(0, 0, 0, 0.1);
        }

        .btn-warning {
            background: linear-gradient(90deg, #FF9800, #F57C00);
            color: white;
            border-radius: 30px;
            padding: 12px 25px;
            font-size: 1.2rem;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            transition: all 0.4s ease;
            width: 100%;
        }

        .btn-warning:hover {
            background: linear-gradient(90deg, #F57C00, #FF9800);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.3);
            transform: scale(1.05);
        }

        .alert {
            margin-top: 20px;
        }

        .btn-primary {
            color: white;
            background-color: #4E342E;
        }

        .input-number input {
            width: 60px;
            text-align: center;
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
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand">
                <h1>Warung DJENG NITA</h1>
            </a>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="row">
            <div class="col">
                <form role="form" method="post" class="form-tambah">
                    <h3>Data Pesanan</h3>
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" name="nama" class="form-control" required>
                    </div>
                    <br>
                    <button name='simpan' class='btn btn-warning btn-block w-100'>Simpan</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>