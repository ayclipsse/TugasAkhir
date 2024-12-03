<?php
include('../koneksi.php');
include('auth.php');
$vnama = "";
$pnama = "";
$pkategori = "";
$pketerangan = "";
$pharga = "";
$pgambar = "";

if (isset($_POST['simpan'])) {
    $pnama = $_POST['nama'];
    $pkategori = $_POST['kategori'];
    $pketerangan = $_POST['deskripsi'];
    $pharga = $_POST['harga_menu'];
    $pgambar = $_POST['gambar'];
    $error = [];

    if (empty($pnama) || empty($pkategori) || empty($pketerangan) || empty($pharga) || empty($pgambar)) {
        echo "<script>
             alert('Data Tidak Boleh Kosong');
             document.location = 'daftarmenu.php';
         </script>";
    } else {
        $cekNama = mysqli_query($koneksi, "SELECT * FROM menu WHERE nama_menu = '$pnama'");
        if (mysqli_num_rows($cekNama) > 0) {
            echo "<script>
                    alert('Nama menu sudah ada, gunakan nama lain!');
                    document.location = 'daftarmenu.php';
                  </script>";
        } else {
            $simpan = mysqli_query($koneksi, "INSERT INTO menu
                (id_menu, nama_menu, id_kategori, deskripsi, harga_menu, gambar) 
                VALUE
                ('','$pnama','$pkategori','$pketerangan','$pharga','$pgambar')");
            if ($simpan) {
                echo "<script>
                            alert('Data Berhasil Disimpan');
                            document.location = 'daftarmenu.php';
                        </script>";
            } else {
                echo "<script>
                            alert('Data Gagal Disimpan');
                        </script>";
            }
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body style="margin: 50px; padding: 30px; background-color: rgb(98, 66, 47); color:black;">
    <div class="container">
        <div class="row">
            <div class="col mt-2">
                <form role="for m" method="post" style="padding: 20px;
                    border: 5px solid rgba(0, 0, 0, 0.525);
                    box-shadow: 0 0 10px rgba(225, 255, 255, 0.6);
                    background-color: rgba(255, 255, 255, 0.603);
                    border-radius: 20px;">
                    <h2>Tambah Menu</h2>
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" name="nama" class="form-control" require value="<?= $vnama ?>">
                    </div>
                    <div class="form-group">
                        <label>Kategori</label>
                        <div class="form-select-list">
                            <select class="form-control custom-select-value" name="kategori" require>
                                <?php
                                $query = "SELECT * FROM kategori";
                                $result = mysqli_query($koneksi, $query);
                                while ($data = mysqli_fetch_array($result)) {
                                    $selected = ($data['id_kategori'] == $row['kategori']) ? 'selected' : '';
                                    echo "<option value='" . $data['id_kategori'] . "' $selected>" . $data['kategori'] . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Keterangan</label>
                        <input type="text" name="deskripsi" class="form-control" require>
                    </div>
                    <div class="form-group">
                        <label>Harga</label>
                        <input type="text" name="harga_menu" class="form-control" require>
                    </div>
                    <div class="form-group">
                        <label>Gambar</label>
                        <input type="text" name="gambar" class="form-control" require>
                    </div>
                    <br>
                    <button type="submit" name="simpan" class="btn btn-warning btn-block">Tambah Menu</button>
                    <button name="kosong" class="btn btn-danger" type="reset">Kosongkan</button>
                    <a href="daftarmenu.php" type="button" class="btn btn-success">kembali</a>
                </form>
            </div>
        </div>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</html>