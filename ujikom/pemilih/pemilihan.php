<?php

require 'conn.php';
session_start();


if(isset($_POST['vote'])) {
   
    $id_kandidat_terpilih = $_POST['id_kandidat'];

   
    $sql = "UPDATE kandidat SET jumlah_suara = jumlah_suara + 1 WHERE id_kandidat = $id_kandidat_terpilih";

    if ($conn->query($sql) === TRUE) {
        echo "Voting berhasil dilakukan.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$sql = "SELECT id_kandidat, nama_calon, jumlah_suara FROM kandidat";
$result = $conn->query($sql);

$kandidat_dan_suara = array();

if ($result->num_rows > 0) {
  
    while($row = $result->fetch_assoc()) {
        $kandidat_dan_suara[$row['id_kandidat']] = array(
            'nama_calon' => $row['nama_calon'],
            'jumlah_suara' => $row['jumlah_suara']
        );
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
</head>
<body>
    <nav>
        <div class="container">
        <h1>Pemilihan Ketua Replika's</h1>    
        <ul>
            <li><a href="index.php">Beranda</a></li>
            <li><a href="pemilihan.php">Pemilihan</a></li>
            <div class="logout">
            <li><a href="/PJ_3_025_AliifFadhilah_XII RPL 2/administrator/login.php">Login</a></li>
            </div>
        </ul>
        </div>
    </nav>

    <div class="form">
        <div class="form-pemilihan">
        <h2>Pilih Kandidat Ketua Replika's</h2>
        <form method="post" action="">
            <table>
                <tr>
                    <th>ID</th>
                    <th>NIS</th>
                    <th>Nama Kandidat</th>
                    <th>Kelas</th>
                    <th>Foto</th>
                    <th>Visi</th>
                    <th>Misi</th>
                    <th>Keahlian</th>
                    <th>Jumlah Vote</th>
                    <th>Pilih</th>
                </tr>
                <?php
               
                $result = $conn->query("SELECT * FROM kandidat");
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["id_kandidat"] . "</td>"; 
                        echo "<td>" . $row["nis"] . "</td>"; 
                        echo "<td>" . $row["nama_calon"] . "</td>";
                        echo "<td>" . $row["kelas"] . "</td>";
                        echo "<td><img src='" . $row["foto"] . "' width='100'></td>";
                        echo "<td>" . $row["visi"] . "</td>";
                        echo "<td>" . $row["misi"] . "</td>";
                        echo "<td>" . $row["id_kk"] . "</td>";
                        echo "<td>" . $row["jumlah_suara"] . "</td>";
                        echo "<td><input type='radio' name='id_kandidat' value='" . $row["id_kandidat"] . "'></td>";
                        
                        echo "</tr>";
                    }
                } else {
                    echo "Tidak ada data dalam tabel";
                }
                ?>
            </table><br>
            <input type="submit" name="vote" value="Vote">
            <div class="PENGUMUMAN">
                <button class="pengumuman"><a href="pengumuman.php">Pengumuman</a></button>
            </div>
        </form>
    </div>
    </div>
</body>
</html>
