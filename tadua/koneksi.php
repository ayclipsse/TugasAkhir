<?php
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'tadua';

$koneksi = mysqli_connect($host, $username, $password, $database);

if (!$koneksi) {
    die("Gagal Menyambungkan Database : " . mysqli_connect_error());
}
?> 