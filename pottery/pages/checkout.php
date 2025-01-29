<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
<?php include '../includes/header.php'; ?>
    <div class="container mx-auto mt-24 p-5 bg-white shadow-lg rounded-lg max-w-lg">
        <h1 class="text-2xl font-bold text-center mb-5">Payment</h1>
        <form action="process_payment.php" method="POST">
            <div class="mb-4">
                <label for="name" class="block text-gray-700">Nama</label>
                <input type="text" id="name" name="name" class="w-full p-2 border border-gray-300 rounded mt-1" required>
            </div>
            <div class="mb-4">
                <label for="address" class="block text-gray-700">Alamat</label>
                <input type="text" id="address" name="address" class="w-full p-2 border border-gray-300 rounded mt-1" required>
            </div>
            <div class="mb-4">
                <label for="amount" class="block text-gray-700">Jumlah</label>
                <?php
                session_start();
                include '../config/db.php';

                // Menghitung total harga dari keranjang
                $total = 0;
                if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
                    $items = array_count_values($_SESSION['cart']);
                    foreach ($items as $id => $quantity) {
                        $sql = "SELECT Price FROM products WHERE ProductID = $id";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            $menu = $result->fetch_assoc();
                            $total += $menu['Price'] * $quantity;
                        }
                    }
                }
                ?>
                <input type="text" id="amount" name="amount" class="w-full p-2 border border-gray-300 rounded mt-1" value="<?php echo $total; ?>" readonly>
            </div>
            <div class="mb-4">
                <label for="payment_method" class="block text-gray-700">Metode Pembayaran</label>
                <select id="payment_method" name="payment_method" class="w-full p-2 border border-gray-300 rounded mt-1" required>
                    <option value="bank_transfer">Transfer Bank</option>
                    <option value="ovo">OVO</option>
                    <option value="gopay">GoPay</option>
                    <option value="cod">Bayar di Tempat (COD)</option>
                    <option value="qris">QRIS</option>
                </select>
            </div>
            <div class="mb-4">
                <input type="submit" value="Bayar Sekarang" class="w-full bg-green-500 text-white p-2 rounded cursor-pointer hover:bg-green-600">
            </div>
        </form>
    </div>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = $_POST['name'];
        $address = $_POST['address'];
        $amount = $_POST['amount'];
        $payment_method = $_POST['payment_method'];

        // Di sini Anda akan menambahkan logika pemrosesan pembayaran
        // Misalnya, Anda bisa menggunakan API gateway pembayaran untuk memproses pembayaran

        // Untuk tujuan demonstrasi, kita hanya akan menampilkan data yang dikirimkan
        echo "<div class='container mx-auto mt-10 p-5 bg-white shadow-lg rounded-lg max-w-lg'>";
        echo "<h2 class='text-xl font-bold mb-4'>Detail Pembayaran</h2>";
        echo "<p><strong>Nama:</strong> " . htmlspecialchars($name) . "</p>";
        echo "<p><strong>Alamat:</strong> " . htmlspecialchars($address) . "</p>";
        echo "<p><strong>Jumlah:</strong> Rp" . number_format($amount, 0, ',', '.') . "</p>";
        echo "<p><strong>Metode Pembayaran:</strong> " . htmlspecialchars($payment_method) . "</p>";
        echo "</div>";
    }
    ?>
</body>
</html>