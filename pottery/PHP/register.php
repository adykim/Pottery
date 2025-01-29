<?php
include '../config/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = "INSERT INTO users (name, email, password) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sss", $nama, $email, $password);

    if ($stmt->execute()) {
        // Registrasi berhasil, redirect ke halaman login
        header("Location:../pages/login.php");
        exit();
    } else {
        echo "Error: " . $conn->error;
    }    
}
?>
