<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/register.css">
    <title>Register</title>
</head>
<body>

    <div class="container">
        <h2>Register</h2>
        <form action="../php/register.php" method="POST">
            <input type="text" name="nama" placeholder="Nama" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Register</button>
        </form>
        <div class="link">
            <p>Sudah punya akun? <a href="../pages/login.php">Login di sini</a></p>
        </div>
    </div>
    <?php include '../includes/footer.php'; ?>
</body>
</html>
