<script>
    document.addEventListener("DOMContentLoaded", loadMenus);

    function loadMenus() {
        fetch("./product_api.php")
            .then(response => response.json())
            .then(data => {
                let menuList = document.getElementById("productList");
                menuList.innerHTML = "";
                data.forEach(menu => {
                    let row = document.createElement("tr");
                    row.innerHTML = `
                        <td>${menu.nama}</td>
                        <td><input type='number' value='${product.price}' onchange='updatePrice(${product.id}, this.value)'></td>
                        <td><input type='number' value='${product.stock}' onchange='updateStock(${product.id}, this.value)'></td>
                        <td>
                            <button class='delete-btn' onclick='deleteProduct(${product.id})'>Delete</button>
                        </td>
                    `;
                    menuList.appendChild(row);
                });
            });
    }
</script>
