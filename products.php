<?php
require_once 'db.php';
header('Content-Type: application/json');

$collection_id = isset($_GET['collection_id']) ? intval($_GET['collection_id']) : 0;
$where = $collection_id ? 'WHERE p.collection_id = ?' : '';
$sql = "SELECT p.*, c.name AS collection_name FROM products p LEFT JOIN collections c ON p.collection_id = c.id $where ORDER BY p.created_at DESC";
$stmt = $pdo->prepare($sql);
if ($collection_id) {
    $stmt->execute([$collection_id]);
} else {
    $stmt->execute();
}
$products = $stmt->fetchAll();
echo json_encode($products);
?>
