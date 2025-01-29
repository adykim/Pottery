<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/login.css">
    <title>Login</title>
</head>
<body class="bg-login">
    <div class="container">
        <div>
            <h2>Login</h2>
        </div>
        
        <form action="../php/login.php" method="POST" class="insert">
            <div>
                <span class="icon"><ion-icon name="person-circle"></ion-icon></span>
                <input type="text" name="nama" placeholder="Nama" required>
            </div>
            <div>
                <span class="icon"><ion-icon name="lock-closed"></ion-icon></span>
                <input type="password" name="password" placeholder="Password" required>

            </div>
            <button type="submit">Login</button>
        </form>
        <div class="link">
            <p>Belum punya akun? <a href="../pages/register.php">Daftar di sini</a></p>
        </div>
        <div class="remember-forgot">
            <label><input type="checkbox">Remember me</label>
        </div>
    </div>

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>
