<?php
require_once __DIR__ . '/../products.php';

$error = '';
$success = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product = [
        'Product' => $_POST['product_name'] ?? '',
        'ShortDescription' => $_POST['short_description'] ?? '',
        'Applications' => $_POST['applications'] ?? ''
    ];

    if (empty($product['Product'])) {
        $error = 'Product name is required.';
    } elseif (empty($product['ShortDescription'])) {
        $error = 'Short description is required.';
    } else {
        $newProduct = create_product($product);
        $success = true;
        header('Location: edit.php?id=' . $newProduct['id']);
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create New Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { padding-top: 20px; }
        .form-section { background: #f8f9fa; padding: 30px; border-radius: 5px; }
    </style>
</head>
<body>
<div class="container">
    <nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
        <div class="container-fluid">
            <a class="navbar-brand" href="../../index.php">← Back to Website</a>
            <div class="navbar-nav ms-auto">
                <a class="nav-link" href="../pages/">Pages</a>
                <a class="nav-link" href="../team/">Team</a>
                <a class="nav-link" href="../awards/">Awards</a>
                <a class="nav-link active" href="../products/">Products</a>
                <a class="nav-link" href="../contacts/">Contacts</a>
            </div>
        </div>
    </nav>

    <div class="row">
        <div class="col-md-8 mx-auto">
            <h1 class="mb-4">Create New Product</h1>

            <?php if ($error): ?>
                <div class="alert alert-danger alert-dismissible fade show"><?php echo $error; ?></div>
            <?php endif; ?>

            <form method="POST" class="form-section">
                <div class="mb-3">
                    <label for="product_name" class="form-label">Product Name *</label>
                    <input type="text" class="form-control" id="product_name" name="product_name" required>
                </div>

                <div class="mb-3">
                    <label for="short_description" class="form-label">Short Description *</label>
                    <textarea class="form-control" id="short_description" name="short_description" rows="3" required></textarea>
                </div>

                <div class="mb-3">
                    <label for="applications" class="form-label">Applications (separate with |)</label>
                    <textarea class="form-control" id="applications" name="applications" rows="3" placeholder="e.g., Application 1|Application 2|Application 3"></textarea>
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-success">Create Product</button>
                    <a href="index.php" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
