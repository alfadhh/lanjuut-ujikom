<?php
    
    require 'conn.php';
    session_start();

   
    $id_kandidat = $_GET['id'];

    
    $query = "DELETE FROM kandidat WHERE id_kandidat='$id_kandidat'";
    $result = $conn->query($query);

    
    header("Location: admin_control.php");
    exit(); 
?>