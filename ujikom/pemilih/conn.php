<?php
$conn = mysqli_connect('localhost','root','','replikas');

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>