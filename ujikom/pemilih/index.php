<?php
require 'conn.php';
session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Dashboard Pemilih</title>
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

    <div class="container">
        <h2>Kandidat Ketua Replika's</h2>
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
                
            </tr>
            <?php
            $result = $conn->query("SELECT kandidat.*, konsentrasi_keahlian.nama_kk 
            FROM kandidat 
            INNER JOIN konsentrasi_keahlian 
            ON kandidat.id_kk = konsentrasi_keahlian.id_kk");


    
            
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
                    echo "<td>" . $row["nama_kk"] . "</td>";
                    
                    echo "</tr>";
                }
            } else {
                echo "Tidak ada data dalam tabel";
            }
            ?>
        </table>
    </div>
</body>
</html>