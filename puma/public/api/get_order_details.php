<?php
// File ini hanya untuk kompatibilitas dengan AJAX di frontend
// Sebenarnya kita sudah punya route Laravel untuk ini

// Koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dbpuma";

// Buat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Periksa koneksi
if ($conn->connect_error) {
    die(json_encode(['error' => "Connection failed: " . $conn->connect_error]));
}

// Ambil ID pesanan
if (!isset($_GET['id'])) {
    echo json_encode(['error' => 'Order ID is required']);
    exit;
}

$orderId = intval($_GET['id']);

// Ambil data pesanan
$orderQuery = "SELECT * FROM pesanan WHERE id = ?";
$stmt = $conn->prepare($orderQuery);
$stmt->bind_param("i", $orderId);
$stmt->execute();
$orderResult = $stmt->get_result();

if ($orderResult->num_rows === 0) {
    echo json_encode(['error' => 'Order not found']);
    exit;
}

$order = $orderResult->fetch_assoc();

// Ambil item pesanan
$itemsQuery = "SELECT pi.*, p.nama as product_name, p.harga 
               FROM pesanan_item pi
               JOIN produk p ON pi.produk_id = p.id
               WHERE pi.pesanan_id = ?";
$stmt = $conn->prepare($itemsQuery);
$stmt->bind_param("i", $orderId);
$stmt->execute();
$itemsResult = $stmt->get_result();

$items = [];
while ($item = $itemsResult->fetch_assoc()) {
    $items[] = $item;
}

// Kirim response
echo json_encode([
    'order' => $order,
    'items' => $items
]);

// Tutup koneksi
$conn->close();
