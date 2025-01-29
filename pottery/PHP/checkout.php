<?php
include '../config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $email = $_POST['email'];

    // Cek apakah user dengan nama/email sudah ada di database
    $sql_check = "SELECT UserID FROM users WHERE Email = ?";
    $stmt_check = $conn->prepare($sql_check);
    $stmt_check->bind_param("s", $email);
    $stmt_check->execute();
    $result_check = $stmt_check->get_result();

    if ($result_check->num_rows > 0) {
        // Jika user ditemukan, update kolom alamat
        $user = $result_check->fetch_assoc();
        $id_pelanggan = $user['UserID']; // Perbaiki di sini

        $sql_update = "UPDATE users SET address = ? WHERE UserID = ?"; // Ganti nama menjadi ID
        $stmt_update = $conn->prepare($sql_update);
        $stmt_update->bind_param("si", $alamat, $id_pelanggan);

        if ($stmt_update->execute()) {
            echo "Alamat berhasil diperbarui untuk user ID: $id_pelanggan";
        } else {
            echo "Error: " . $conn->error;
        }
    } else {
        // Jika user tidak ditemukan, tampilkan pesan error atau tambahkan mekanisme registrasi
        echo "User dengan email $email tidak ditemukan. Pastikan Anda sudah terdaftar.";
    }
}
?>
