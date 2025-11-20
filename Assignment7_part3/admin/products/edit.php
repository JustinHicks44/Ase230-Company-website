<?php
require_once __DIR__ . '/../products.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : null;
$product = $id !== null ? get_product_by_id($id) : null;

if (!$product) {
    header('Location: index.php');
    exit;
}

$error = '';
$success = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $updatedData = [
        'Product' => $_POST['product_name'] ?? '',
        'ShortDescription' => $_POST['short_description'] ?? '',
        'Applications' => $_POST['applications'] ?? ''
    ];

    if (empty($updatedData['Product'])) {
        $error = 'Product name is required.';
    } elseif (empty($updatedData['ShortDescription'])) {
        $error = 'Short description is required.';
    } else {
        update_product($product['id'], $updatedData);
        $success = true;
        $product = array_merge($product, $updatedData);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product - <?php echo htmlspecialchars($product['Product']); ?></title>
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
            <h1 class="mb-4">Edit Product</h1>

            <?php if ($success): ?>
                <div class="alert alert-success alert-dismissible fade show">Product updated successfully!</div>
            <?php endif; ?>

            <?php if ($error): ?>
                <div class="alert alert-danger alert-dismissible fade show"><?php echo $error; ?></div>
            <?php endif; ?>

            <form method="POST" class="form-section">
                <div class="mb-3">
                    <label for="product_name" class="form-label">Product Name *</label>
                    <input type="text" class="form-control" id="product_name" name="product_name" value="<?php echo htmlspecialchars($product['Product']); ?>" required>
                </div>

                <div class="mb-3">
                    <label for="short_description" class="form-label">Short Description *</label>
                    <textarea class="form-control" id="short_description" name="short_description" rows="3" required><?php echo htmlspecialchars($product['ShortDescription']); ?></textarea>
                </div>

                <div class="mb-3">
                    <label for="applications" class="form-label">Applications (separate with |)</label>
                    <textarea class="form-control" id="applications" name="applications" rows="3"><?php echo htmlspecialchars($product['Applications']); ?></textarea>
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                    <a href="detail.php?id=<?php echo $product['id']; ?>" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
