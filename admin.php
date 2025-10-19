<?php
require_once 'db.php';
// Fetch collections for the dropdown
$stmt = $pdo->query("SELECT id, name FROM collections ORDER BY name");
$collections = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard - Add Product</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        .admin-form {
            max-width: 400px;
            margin: 40px auto;
            padding: 24px;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        }
        .admin-form label { display: block; margin-top: 12px; }
        .admin-form input, .admin-form textarea, .admin-form select {
            width: 100%;
            padding: 8px;
            margin-top: 4px;
            border-radius: 6px;
            border: 1px solid #ccc;
        }
        .admin-form button {
            margin-top: 18px;
            background: #b71c1c;
            color: #fff;
            border: none;
            padding: 10px 24px;
            border-radius: 6px;
            cursor: pointer;
        }
        .admin-form .success { color: green; margin-top: 10px; }
        .admin-form .error { color: red; margin-top: 10px; }
    </style>
</head>
<body>
    <h2 style="text-align:center;">Admin Dashboard - Add Product</h2>
    <form class="admin-form" id="addProductForm" enctype="multipart/form-data" method="POST" action="add_product.php">
        <label>Product Name</label>
        <input type="text" name="name" required>
        <label>Price</label>
        <input type="number" name="price" step="0.01" required>
        <label>Description</label>
        <textarea name="description" rows="3" required></textarea>
        <label>Collection</label>
        <select name="collection_id" required>
            <option value="">Select Collection</option>
            <?php foreach($collections as $col): ?>
                <option value="<?= $col['id'] ?>"<?= strtolower($col['name']) === 'combo' ? ' data-tag="combo"' : '' ?>><?= htmlspecialchars($col['name']) ?></option>
            <?php endforeach; ?>
        </select>
        <label>Image</label>
        <input type="file" name="image" accept="image/*" required>
        <button type="submit">Add Product</button>
    </form>
    <div style="text-align:center; margin-top:30px;">
        <a href="landing-page.html">Back to Store</a>
    </div>
</body>
</html>
