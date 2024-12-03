<?php
include('../koneksi.php');
include('auth.php');
$id = $_GET['id_menu'];
$q = "SELECT * FROM menu WHERE id_menu = '$id'";
$result = mysqli_query($koneksi, $q);
$row = mysqli_fetch_array($result);
if ($row) {
    $vnama = $row['nama_menu'];
    $vkategori = $row['id_kategori'];
    $vketerangan = $row['deskripsi'];
    $vharga = $row['harga_menu'];
    $vgambar = $row['gambar'];
    $error = [];
}
if (isset($_POST['simpan'])) {
    
    if (empty($_POST['nama']) || empty($_POST['deskripsi']) || empty($_POST['harga_menu']) || empty($_POST['gambar'])){
        
        echo "<script>
             alert('data kosong');
             document.location = 'edit.php?id_menu=$row[id_menu]';
             
         </script>";
    } else {
        $tampil = mysqli_query($koneksi, "UPDATE menu SET 
                nama_menu =  '$_POST[nama]',
                id_kategori = '$_POST[kategori]',
                deskripsi =  '$_POST[deskripsi]',
                harga_menu = '$_POST[harga_menu]',
                gambar = '$_POST[gambar]'
                WHERE id_menu = '$_GET[id_menu]'");
        echo "<script>
            alert('data berhasil');
            document.location = 'daftarmenu.php';
            </script>";
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
                <form role="form" method="post" style="padding: 20px;
                        border: 5px solid rgba(0, 0, 0, 0.525);
                        box-shadow: 0 0 10px rgba(225, 255, 255, 0.6);
                        background-color: rgba(255, 255, 255, 0.603);
                        border-radius: 20px;">
                    <h2>Edit Menu</h2>
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
                                    $selected = ($data['id_kategori'] == $vkategori) ? 'selected' : '';
                                    echo "<option value='" . $data['id_kategori'] . "' $selected>" . $data['kategori'] . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Keterangan</label>
                        <input type="text" name="deskripsi" class="form-control" require value="<?= $vketerangan ?>">
                    </div>
                    <div class="form-group">
                        <label>Harga</label>
                        <input type="text" name="harga_menu" class="form-control" require value="<?= $vharga ?>">
                    </div>
                    <div class="form-group">
                        <label>Gambar</label>
                        <input type="text" name="gambar" class="form-control" require value="<?= $vgambar ?>">
                    </div>
                    <br>
                    <button type="submit" name="simpan" class="btn btn-warning btn-block">Edit Menu</button>
                </form>
            </div>
        </div>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</html>