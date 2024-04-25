<?php
require 'conn.php';

function tambahKandidat($nis, $nama_calon, $kelas, $foto, $visi, $misi, $id_kk) {
    global $conn;
    $query = "INSERT INTO kandidat (nis, nama_calon, kelas, foto, visi, misi, id_kk) VALUES ('$nis', '$nama_calon', '$kelas', '$foto', '$visi', '$misi', '$id_kk')";
    return mysqli_query($conn, $query);
}

function tampilSemuaKandidat() {
    global $conn;
    $query = "SELECT  * FROM kandidat";
    return mysqli_query($conn, $query);
}

function ubahKandidat($id_kandidat, $nis, $nama_calon, $kelas, $foto, $visi, $misi, $id_kk) {
    global $conn;
    $query = "UPDATE kandidat SET nis='$nis', nama_calon='$nama_calon', kelas='$kelas', foto='$foto', visi='$visi', misi='$misi', id_kk='$id_kk' WHERE id_kandidat='$id_kandidat'";
    return mysqli_query($conn, $query);
}

function hapusKandidat($id_kandidat) {
    global $conn;
    $query = "DELETE FROM kandidat WHERE id_kandidat='$id_kandidat'";
    return mysqli_query($conn, $query);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nis = $_POST['nis'];
    $nama_calon = $_POST['nama_calon'];
    $kelas = $_POST['kelas'];
    $visi = $_POST['visi'];
    $misi = $_POST['misi'];
    $id_kk = $_POST['id_kk'];

    // Mengelola unggahan foto
    $file_name = $_FILES['foto']['name'];
    $file_tmp = $_FILES['foto']['tmp_name'];
    $file_size = $_FILES['foto']['size'];
    $file_error = $_FILES['foto']['error'];
    $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
    $allowed_ext = array('jpg', 'jpeg', 'png');

    if (in_array($file_ext, $allowed_ext)) {
        if ($file_error === 0) {
            if ($file_size <= 5242880) { // 5MB (dalam bytes)
                // Lokasi penyimpanan file yang diunggah
                $file_destination = 'uploads/' . $file_name;

                // Memindahkan file yang diunggah ke lokasi penyimpanan
                if (move_uploaded_file($file_tmp, $file_destination)) {
                    // Memanggil fungsi tambahKandidat untuk menambahkan data ke database
                    if(tambahKandidat($nis, $nama_calon, $kelas, $file_destination, $visi, $misi, $id_kk)) {
                        header("Location: admin_control.php");
                        exit();
                    } else {
                        echo "Gagal menambahkan kandidat.";
                    }
                } else {    
                    echo "Gagal mengunggah file.";
                }
            } else {
                echo "File terlalu besar. Maksimal ukuran file adalah 5MB.";
            }
        } else {
            echo "Error saat mengunggah file.";
        }
    } else {
        echo "Ekstensi file tidak diizinkan. Harap unggah file dengan format JPG, JPEG, atau PNG.";
    }
}

$result = tampilSemuaKandidat();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Kandidat</title>
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
            <li><a href="admin_control.php">Beranda</a></li>
            <li><a href="plus.php">Tambah Data</a></li>
            <li><a href="pemilihan.php">Pemilihan</a></li>
            <div class="logout">
                <li><a href="logout.php">LogOut</a></li>
            </div>
        </ul>
        
    </nav>

    <div class="form">
    <h2>Data Kandidat</h2>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
        NIS: <input type="text" name="nis"><br><br>
        Nama Calon: <input type="text" name="nama_calon"><br><br>
        Kelas: <input type="text" name="kelas"><br><br>
        Foto: <input type="file" name="foto"><br><br>
        Visi: <input type="text" name="visi"><br><br>
        Misi: <input type="text" name="misi"><br><br>
        <div>
            <label for="id_kk"> Keahlian:</label><br>
            <select id="id_kk" name="id_kk" required><br><br>
                <option disabled>Pilih</option>
                <?php
                $sql = "SELECT * FROM konsentrasi_keahlian";
                $all = $conn->query($sql);
                while ($row = mysqli_fetch_assoc($all)) {
                ?>
                    <option value=<?= $row['id_kk']; ?>><?= $row['nama_kk']; ?></option>
                <?php } ?>
            </select>
        </div> <br>
        <input type="submit" name="tambah" value="Tambah">
    </form>
    </div>  
</body>
</html>