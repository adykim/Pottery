<?php
session_start();
include '../config/db.php';

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Menambahkan item ke keranjang
$id = $_GET['id'] ?? null;
if ($id) {
    $_SESSION['cart'][] = $id;
}

// Memperbarui jumlah item
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['update_cart'])) {
        $id_to_update = $_POST['id'];
        $new_quantity = $_POST['quantity'];

        // Jika jumlah baru 0, hapus item dari keranjang
        if ($new_quantity == 0) {
            // Menghapus item yang jumlahnya 0
            $_SESSION['cart'] = array_filter($_SESSION['cart'], function($item) use ($id_to_update) {
                return $item != $id_to_update;
            });
        } else {
            // Mengubah jumlah item yang sudah ada
            $current_quantity = array_count_values($_SESSION['cart'])[$id_to_update] ?? 0;
            $difference = $new_quantity - $current_quantity;

            // Jika jumlah baru lebih besar, tambahkan item
            if ($difference > 0) {
                for ($i = 0; $i < $difference; $i++) {
                    $_SESSION['cart'][] = $id_to_update;
                }
            }
            // Jika jumlah baru lebih kecil, kurangi item
            elseif ($difference < 0) {
                for ($i = 0; $i < abs($difference); $i++) {
                    // Menghapus satu item dari keranjang
                    $key = array_search($id_to_update, $_SESSION['cart']);
                    if ($key !== false) {
                        unset($_SESSION['cart'][$key]);
                    }
                }
            }
        }
    }

    // Menghapus item dari keranjang
    if (isset($_POST['remove_item'])) {
        $id_to_remove = $_POST['id'];
        $_SESSION['cart'] = array_filter($_SESSION['cart'], function($item) use ($id_to_remove) {
            return $item != $id_to_remove;
        });
    }
}

// Menghitung jumlah item
$items = array_count_values($_SESSION['cart']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>keranjang</title>
    <link rel="stylesheet" href="../css/cart.css">
</head>
<body>
    <?php include '../includes/header.php'; ?>
    <!-- <header>
        <h1>Keranjang Belanja</h1>
    </header> -->
    <main class="cart">
        
    <ul class="detail">
    <?php
    $total = 0; // Variabel total harga
    foreach ($items as $id => $quantity) {
        $sql = "SELECT Name, Price, Image FROM products WHERE ProductID = $id";
        $result = $conn->query($sql);
        $menu = $result->fetch_assoc();

        // Hitung subtotal per item
        $subtotal = $menu['Price'] * $quantity;
        $total += $subtotal;

        echo "<li>
                <img src='{$menu['Image']}' alt='{$menu['Name']}'>
                <div>
                    <p>{$menu['Name']} (Rp" . number_format($menu['Price'], 0, ',', '.') . ") x $quantity</p>
                    <p>Subtotal: Rp" . number_format($subtotal, 0, ',', '.') . "</p>
                </div>
                <form action='' method='POST' style='display:inline'>
                    <input type='hidden' name='id' value='$id'>
                    <input type='number' name='quantity' value='$quantity' min='1'>
                    <button type='submit' name='update_cart'>Update</button>
                </form>
                <form action='' method='POST' style='display:inline'>
                    <input type='hidden' name='id' value='$id'>
                    <button type='submit' name='remove_item' onclick='return confirm(\"Apakah Anda yakin ingin menghapus item ini?\");'>Hapus</button>
                </form>
              </li>";
    }
    ?>
</ul>

        <hr>
        <h3>Total Pesanan: Rp<?= number_format($total, 0, ',', '.'); ?></h3>
        <div>
            <a href="../pages/menu.php" class="btnbawah">Cari Barang Lagi</a>
            <a href="../pages/checkout.php" class="btnbawah">Lanjut ke Checkout</a>
        </div>
    </main>
    <footer>
        <p>&copy; 2025 Food E-Commerce. All Rights Reserved.</p>
    </footer>
</body>
</html>
