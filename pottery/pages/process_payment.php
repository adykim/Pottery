<html>
<head>
    <title>Terima Kasih</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f5f5dc; /* Pastel brown color */
            color: #5a3e36; /* Darker brown for text */
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            text-align: center;
            background-color: #fff;
            padding: 50px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .container h1 {
            font-size: 2.5em;
            margin-bottom: 20px;
        }
        .container p {
            font-size: 1.2em;
            margin-bottom: 30px;
        }
        .container .btn-home {
            display: inline-block;
            padding: 10px 20px;
            font-size: 1em;
            color: #fff;
            background-color: #5a3e36;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            transition: background-color 0.3s;
        }
        .container .btn-home:hover {
            background-color: #3e2a26;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php
        session_start();
        if (isset($_SESSION['name'])) {
            $name = htmlspecialchars($_SESSION['name']);
            echo "<h1>Terima Kasih, $name!</h1>";
        } else {
            echo "<h1>Terima Kasih!</h1>";
        }
        ?>
        <p>Terima kasih sudah berbelanja di toko kami. Kami berharap Anda puas dengan pembelian Anda.</p>
        <a href="index.php" class="btn-home"><i class="fas fa-home"></i> Kembali ke Halaman Utama</a>
    </div>
</body>
</html>