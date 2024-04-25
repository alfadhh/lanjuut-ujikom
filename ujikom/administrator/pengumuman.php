<?php

require 'conn.php';
session_start();

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


$pemenang = "Belum ada hasil";
$jumlah_suara_tertinggi = 0;


foreach ($kandidat_dan_suara as $id_kandidat => $data_kandidat) {
    if ($data_kandidat['jumlah_suara'] > $jumlah_suara_tertinggi) {
        $jumlah_suara_tertinggi = $data_kandidat['jumlah_suara'];
        $pemenang = $data_kandidat['nama_calon'];
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
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
</head>
<body>
    <nav>
        <div class="container">
        <h1>Pemilihan Ketua Replika's</h1>    
        <ul>
            <li><a href="admin_control.php">Beranda</a></li>
            <li><a href="pemilihan.php">Pemilihan</a></li>
            <div class="logout">
                <li><a href="logout.php">LogOut</a></li>
            </div>
        </ul>
        </div>
    </nav>

    <div class="attention">
        <h2>Pengumuman Pemenang</h2>
        <div class="pemenang">
            <h3>Hasil Pemilihan Ketua Replika's:</h3>
            <ul>
                <?php
                
                foreach ($kandidat_dan_suara as $id_kandidat => $data_kandidat) {
                    echo "<li>{$data_kandidat['nama_calon']} - {$data_kandidat['jumlah_suara']} suara</li>";
                }
                ?>
            </ul>
            <?php echo "<p>Pemenang Pemilihan Ketua Replika's adalah: $pemenang</p>"; ?>
        </div>

        <div class="chart">
        <canvas id="myChart" width="300" height="200">
        <script>
        
            let kandidatData = <?php echo json_encode($kandidat_dan_suara); ?>;
            
            
            let labels = Object.keys(kandidatData).map(id => kandidatData[id].nama_calon);
            let suara = Object.keys(kandidatData).map(id => kandidatData[id].jumlah_suara);
            
                        
            var ctx = document.getElementById('myChart').getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Jumlah Suara',
                        data: suara,
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        </script>

        </canvas>
        </div>            


    </div>
</body>
</html>
