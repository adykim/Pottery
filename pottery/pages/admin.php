<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page - Manage Product</title>
    <link rel="stylesheet" href="../CSS/admin.css">
</head>
<body>
    <div class="container">
        <h2>Manage Product</h2>
        <!-- Form untuk menambahkan menu -->
        <form id="menuForm">
            <input type="text" id="productname" placeholder="Enter product name" required>
            <input type="number" id="productprice" placeholder="Enter price" required>
            <input type="number" id="productstok" placeholder="Enter stock" required>
            <button type="button" onclick="addProduct()">Add Product</button>
        </form>
        <!-- Tabel menu -->
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="productList">
                <!-- Menu items will be dynamically loaded here -->
            </tbody>
        </table>
    </div>

    <script>
        // Memuat menu dari API
        document.addEventListener("DOMContentLoaded", loadMenus);

        function loadMenus() {
            fetch("../PHP/product_api.php")
                .then(response => response.json())
                .then(data => {
                    let menuList = document.getElementById("productList");
                    menuList.innerHTML = ""; // Hapus konten lama
                    data.forEach(menu => {
                        let row = document.createElement("tr");
                        row.innerHTML = `
                            <td>${product.name}</td>
                            <td><input type="number" value="${product.price}" onchange="updatePrice(${menu.id}, this.value)"></td>
                            <td><input type="number" value="${product.stock}" onchange="updateStock(${menu.id}, this.value)"></td>
                            <td>
                                <button class="delete-btn" onclick="deleteProduct(${product.id})">Delete</button>
                            </td>
                        `;
                        menuList.appendChild(row);
                    });
                });
        }

        // Menambahkan menu baru
        function addMenu() {
            let productName = document.getElementById("productname").value;
            let productPrice = document.getElementById("productharga").value;
            let productStock = document.getElementById("productstok").value;

            fetch("../PHP/product_api.php", {
                method: "POST",
                headers: { "Content-Type": "application/x-www-form-urlencoded" },
                body: `productname=${productName}&productPrice=${productPrice}&productstok=${productStock}`
            }).then(() => {
                document.getElementById("productForm").reset(); // Reset form
                loadMenus(); // Reload menu
            });
        }

        // Menghapus menu
        function deleteProduct(id) {
            fetch("../PHP/product_api.php", {
                method: "DELETE",
                headers: { "Content-Type": "application/x-www-form-urlencoded" },
                body: `id=${id}`
            }).then(() => loadMenus());
        }

        // Memperbarui harga menu
        function updatePrice(id, price) {
            fetch("../PHP/product_api.php", {
                method: "PUT",
                headers: { "Content-Type": "application/x-www-form-urlencoded" },
                body: `id=${id}&harga=${price}`
            });
        }

        // Memperbarui stok menu
        function updateStock(id, stock) {
            fetch("../PHP/product_api.php", {
                method: "PUT",
                headers: { "Content-Type": "application/x-www-form-urlencoded" },
                body: `id=${id}&stok=${stock}`
            });
        }
    </script>
</body>
</html>
