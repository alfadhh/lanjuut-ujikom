<?php
require 'conn.php';
session_start();

$id_kandidat = $_GET['id'];

$result = $conn->query("SELECT * FROM kandidat WHERE id_kandidat = '$id_kandidat'");
$row = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nis = $_POST['nis'];
    $nama_calon = $_POST['nama_calon'];
    $kelas = $_POST['kelas'];
    $visi = $_POST['visi'];
    $misi = $_POST['misi'];
    $id_kk = $_POST['id_kk'];

   
    $file_name = $_FILES['foto']['name'];
    $file_size = $_FILES['foto']['size'];
    $file_tmp = $_FILES['foto']['tmp_name'];
    $file_type = $_FILES['foto']['type'];
    $file_error = $_FILES['foto']['error'];

   
    $allowed_ext = array("jpg", "jpeg", "png");
    $file_ext = strtolower(end(explode('.', $file_name)));

    if (in_array($file_ext, $allowed_ext)) {
        if ($file_error === 0) {
            if ($file_size <= 5242880) { 
                $file_destination = 'uploads/' . $file_name;

               
                if (move_uploaded_file($file_tmp, $file_destination)) {
            
                    if (file_exists($row['foto'])) {
                        unlink($row['foto']);
                    }

                    
                    $query = "UPDATE kandidat SET nis='$nis', nama_calon='$nama_calon', kelas='$kelas', foto='$file_destination', visi='$visi', misi='$misi', id_kk='$id_kk' WHERE id_kandidat='$id_kandidat'";
                    if ($conn->query($query) === TRUE) {
                        header("Location: admin_control.php");
                        exit();
                    } else {
                        echo "Error: " . $query . "<br>" . $conn->error;
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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Kandidat</title>
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
            <li><a href="plus.php">Tambah Data</a></li>
            <li><a href="pemilihan.php">Pemilihan</a></li>
            <div class="logout">
                <li><a href="logout.php">LogOut</a></li>
            </div>
        </ul>
        </div>
    </nav>

    <div class="form">
        <h2>Edit Data Kandidat</h2>

        <form method="post" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?id=" . $id_kandidat); ?>">
            <label for="nis">NIS:</label><br>
            <input type="text" id="nis" name="nis" value="<?php echo $row['nis']; ?>"><br><br>

            <label for="nama_calon">Nama Calon:</label><br>
            <input type="text" id="nama_calon" name="nama_calon" value="<?php echo $row['nama_calon']; ?>"><br><br>

            <label for="kelas">Kelas:</label><br>
            <input type="text" id="kelas" name="kelas" value="<?php echo $row['kelas']; ?>"><br><br>

            <label for="foto">Foto (Max 5MB):</label><br>
            <input type="file" id="foto" name="foto"><br><br>

            <label for="visi">Visi:</label><br>
            <textarea id="visi" name="visi"><?php echo $row['visi']; ?></textarea><br><br>

            <label for="misi">Misi:</label><br>
            <textarea id="misi" name="misi"><?php echo $row['misi']; ?></textarea><br><br>

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
        </div>
        <br>

            <input type="submit" value="Simpan Perubahan">
        </form>
    </div>
</body>
</html>