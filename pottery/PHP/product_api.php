<?php
include '../config/db.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $menuName = $_POST['menunama'];
    $menuPrice = $_POST['menuharga'];
    $menuStock = $_POST['menustok'];
    $sql = "INSERT INTO menu (nama, harga, stok) VALUES ('$menuName', '$menuPrice', '$menuStock')";
    $conn->query($sql);
    echo json_encode(['status' => 'success']);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $result = $conn->query("SELECT * FROM menu");
    $menus = [];
    while ($row = $result->fetch_assoc()) {
        $menus[] = $row;
    }
    echo json_encode($menus);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
    parse_str(file_get_contents("php://input"), $_DELETE);
    $id = $_DELETE['id'];
    $sql = "DELETE FROM menu WHERE id = $id";
    $conn->query($sql);
    echo json_encode(['status' => 'deleted']);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
    parse_str(file_get_contents("php://input"), $_PUT);
    $id = $_PUT['id'];
    $sql = "";
    if (isset($_PUT['harga'])) {
        $price = $_PUT['harga'];
        $sql = "UPDATE menu SET harga = '$price' WHERE id = $id";
    } elseif (isset($_PUT['stok'])) {
        $stock = $_PUT['stok'];
        $sql = "UPDATE menu SET stok = '$stock' WHERE id = $id";
    }
    if ($sql != "") {
        $conn->query($sql);
        echo json_encode(['status' => 'updated']);
    }
    exit;
}


$conn->close();
?>
