<?php
require_once 'db.php';

function respond($msg, $success = false) {
    echo '<div class="' . ($success ? 'success' : 'error') . '">' . htmlspecialchars($msg) . '</div>';
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $price = floatval($_POST['price'] ?? 0);
    $description = trim($_POST['description'] ?? '');
    $collection_id = intval($_POST['collection_id'] ?? 0);
    $imagePath = '';

    // Validate
    if (!$name || !$price || !$description || !$collection_id) {
        respond('All fields are required.');
        exit;
    }

    // Handle image upload
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $imgTmp = $_FILES['image']['tmp_name'];
        $imgName = basename($_FILES['image']['name']);
        $imgExt = strtolower(pathinfo($imgName, PATHINFO_EXTENSION));
        $allowed = ['jpg', 'jpeg', 'png', 'gif'];
        if (!in_array($imgExt, $allowed)) {
            respond('Invalid image type.');
            exit;
        }
        $newName = uniqid('prod_', true) . '.' . $imgExt;
        $dest = 'uploads/' . $newName;
        if (!is_dir('uploads')) mkdir('uploads');
        if (!move_uploaded_file($imgTmp, $dest)) {
            respond('Failed to upload image.');
            exit;
        }
        $imagePath = $dest;
    } else {
        respond('Image is required.');
        exit;
    }

    // Insert into DB
    $stmt = $pdo->prepare("INSERT INTO products (name, price, description, image, collection_id) VALUES (?, ?, ?, ?, ?)");
    if ($stmt->execute([$name, $price, $description, $imagePath, $collection_id])) {
        respond('Product added successfully!', true);
        echo '<a href="admin.php">Add another product</a>';
    } else {
        respond('Failed to add product.');
    }
} else {
    respond('Invalid request.');
}
?>
