<?php
include '../config/db.php';

$sql = "SELECT * FROM products";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu - Pottery Handmade</title>
    <link rel="stylesheet" href="../css/menu.css">
</head>
<body>
    <?php include '../includes/header.php'; ?>
    <!-- <header>

        
    </header> -->
    <main>
        <div class="menu-container">
            <?php while ($row = $result->fetch_assoc()) { ?>
                <div class="menu-item">
                    <img src="<?php echo $row['Image']; ?>" alt="">
                    <h2><?php echo $row['Name']; ?></h2>
                    <p>Harga: Rp<?php echo number_format($row['Price'], 0, ',', '.'); ?></p>
                    <p>Stok: <?php echo $row['stock']; ?></p>
                    <a href="product.php?id=<?php echo $row['ProductID']; ?>">Lihat Detail</a>
                </div>
            <?php } ?>
        </div>
    </main>
    <footer>
        <p>&copy; 2025 Food E-Commerce. All Rights Reserved.</p>
    </footer>
</body>
</html>
