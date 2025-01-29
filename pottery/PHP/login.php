<?php
include '../config/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama'];
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE name = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $nama);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if ($password == $user['Password']) {
            // Login berhasil
            session_start(); // Memulai sesi untuk menyimpan data user
            $_SESSION['user_id'] = $user['ID']; // Simpan ID user ke session
            $_SESSION['user_name'] = $user['nama']; // Simpan nama user ke session (opsional)
    
            // Redirect ke halaman dashboard
            header("Location: ../pages/index.php");
            exit();
        } else {
            echo "Password salah.";
        }
    } else {
        echo "Akun tidak ditemukan.";
    }
    
}
?>
