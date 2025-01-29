<?php
include '../config/db.php';

$id = $_GET['id'];
$sql = "SELECT * FROM Products WHERE ProductID = $id";
$result = $conn->query($sql);
$menu = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Products - <?php echo $Products['Name']; ?></title>
    <link rel="stylesheet" href="../css/product.css">
</head>
<body>

    <?php include '../includes/header.php'; ?>

    <div>

           

        
    
    <main class="product">
        <h1><?php echo $menu['Name']; ?></h1>

        <img src="<?php echo $row['Image']; ?>" alt="">
        <p>Harga: Rp<?php echo number_format($menu['Price'], 0, ',', '.'); ?></p>
        <p>Stok: <?php echo $menu['stock']; ?></p>
        <p>Deskripsi: <?php echo $menu['Description'] ?? 'Tidak ada deskripsi'; ?></p>
        <?php
// Menyimpan data pesanan
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Mendapatkan jumlah dari form
    $jumlah = isset($_POST['jumlah']) ? (int)$_POST['jumlah'] : 1;
    
    // Tambahkan item ke dalam detail pesanan (misalnya menggunakan sesi atau array)
    $_SESSION['pesanan'][] = ['menu' => 'Item A', 'jumlah' => $jumlah];
}

// Menampilkan detail pesanan
if (!empty($_SESSION['pesanan'])) {
    foreach ($_SESSION['pesanan'] as $pesanan) {
        echo $pesanan['menu'] . " x " . $pesanan['jumlah'] . "<br>";
    }
}
?>

<!-- Form untuk mengatur jumlah pesanan -->
<form method="POST" action="">
    <label for="jumlah">Jumlah:</label>
    <button type="button" onclick="decrease()">-</button>
    <input type="number" id="jumlah" name="jumlah" value="1" min="1" required>
    <button type="button" onclick="increase()">+</button>
    <br><br>
</form>

<script>
// Fungsi untuk menambah jumlah
function increase() {
    var jumlah = document.getElementById('jumlah');
    jumlah.value = parseInt(jumlah.value) + 1;
}

// Fungsi untuk mengurangi jumlah
function decrease() {
    var jumlah = document.getElementById('jumlah');
    if (jumlah.value > 1) {
        jumlah.value = parseInt(jumlah.value) - 1;
    }
}
</script>

        <a href="cart.php?id=<?php echo $menu['ProductID']; ?>">Tambah ke Keranjang</a>
    </main>

    </div>

    <!-- <footer>
        <p>&copy; 2025 Pottery Handmade. All Rights Reserved.</p>
    </footer> -->
</body>
</html>
