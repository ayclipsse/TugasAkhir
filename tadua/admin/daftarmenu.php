<?php
include('../koneksi.php');
include('auth.php');

if (isset($_POST['delete'])) {
    $id = $_POST['id_menu'];
    $id = $koneksi->real_escape_string($id);
    $sql = "DELETE FROM menu WHERE id_menu = '$id_transaksi'";
    if ($koneksi->query($sql) === TRUE) {
        echo "
        <script>
            alert('Berhasil Menghapus   ')
            window.location.href = 'daftarmenu.php';
        </script>";
    } else {
        echo "Error deleting record: " . $koneksi->error;
    }
    $koneksi->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Menu - Warung Djeng Nita</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body {
            background-image: url('bg.png');
            background-size: cover;
            background-repeat: no-repeat;
            background-color: #6B4423;
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
        }

        .table {
            border-radius: 15px;
            overflow: hidden;
        }

        .table th,
        .table td {
            vertical-align: middle;
        }

        .table-striped tbody tr:nth-of-type(odd) {
            background-color: #5d4037;
        }

        .table-striped tbody tr:nth-of-type(even) {
            background-color: #7b4b3a;
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

        .table {
            width: 100%;
        }

        .table img {
            border-radius: 10px;
        }

        .table img {
            border-radius: 10px;
        }

        .btn-primary,
        .btn-success,
        .btn-danger {
            border-radius: 20px;
        }

        .offcanvas-header h5 {
            color: #6d4c41;
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
    <div class="container" style="padding: 20px;">
        <h2 class="text-center">Daftar Menu</h2>
        <form class="d-flex justify-content-between" style="margin-bottom: 10px;" method="post">
            <div class="input-group">
                <a href="tambahmenu.php" class="btn btn-primary">Tambah Menu</a>
                <input class="form-control" name="tcari" type="search" placeholder="Search">
                <button class="btn btn-outline-success" name="bcari" type="submit"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0" />
                    </svg></button>
            </div>
        </form>
        <div class="table-wrapper">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama Menu</th>
                        <th scope="col">Kategori</th>
                        <th scope="col">Keterangan</th>
                        <th scope="col">Harga</th>
                        <th scope="col">Gambar</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (isset($_POST['bcari'])) {
                        $keyword = $_POST['tcari'];
                        $q = "SELECT * FROM menu WHERE nama_menu LIKE '%$keyword%'";
                    } else {
                        $q = "SELECT * FROM menu ORDER BY id_kategori ASC";
                    }
                    $a = 1;
                    $result = mysqli_query($koneksi, $q);
                    while ($row = mysqli_fetch_array($result)) {
                        echo "<tr>
                            <td>$a</td>
                            <td>$row[nama_menu]</td>
                            <td>" . ($row['id_kategori'] == 1 ? 'Makanan' : 'Minuman') . "</td>
                            <td>$row[deskripsi]</td>
                            <td>$row[harga_menu]</td>
                            <td><img src='$row[gambar]' alt='Menu Image' width='50' height='50' class='img-fluid'></td>
                            <td>"; ?>
                        <form action="" method="post">
                            <a href='edit.php?id_menu=<?= $row['id_menu'] ?>' class='btn btn-success'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil-square' viewBox='0 0 16 16'>
                                    <path d='M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z' />
                                    <path fill-rule='evenodd' d='M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z' />
                                </svg></a>
                            <input type="hidden" name="id_menu" value="<?= $row['id_menu'] ?>">
                            <button type="submit" class="btn btn-danger" name="delete"><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash3' viewBox='0 0 16 16'>
                                    <path d='M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5' />
                                </svg></button>
                        </form>
                    <?php
                        echo "
                            </td>
                        </tr>";
                        $a++;
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.0/dist/sweetalert2.min.js"></script>

</body>

</html>