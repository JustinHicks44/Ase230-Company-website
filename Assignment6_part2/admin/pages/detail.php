<?php
require_once __DIR__ . '/../pages.php';
$id = isset($_GET['id']) ? (int)$_GET['id'] : null;
$page = $id !== null ? get_page_by_id($id) : null;

if (!$page) {
    header('Location: index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page - <?php echo htmlspecialchars($page['title']); ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { padding-top: 20px; }
        .detail-section { background: #f8f9fa; padding: 20px; border-radius: 5px; margin-bottom: 20px; }
    </style>
</head>
<body>
<div class="container">
    <nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
        <div class="container-fluid">
            <a class="navbar-brand" href="../../index.php">← Back to Website</a>
            <div class="navbar-nav ms-auto">
                <a class="nav-link active" href="../pages/">Pages</a>
                <a class="nav-link" href="../team/">Team</a>
                <a class="nav-link" href="../awards/">Awards</a>
                <a class="nav-link" href="../products/">Products</a>
                <a class="nav-link" href="../contacts/">Contacts</a>
            </div>
        </div>
    </nav>

    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1><?php echo htmlspecialchars($page['title']); ?></h1>
                <div>
                    <a href="edit.php?id=<?php echo $page['id']; ?>" class="btn btn-warning">Edit</a>
                    <a href="delete.php?id=<?php echo $page['id']; ?>" class="btn btn-danger">Delete</a>
                    <a href="index.php" class="btn btn-secondary">Back to List</a>
                </div>
            </div>

            <div class="detail-section">
                <h3>Page Information</h3>
                <div class="row mb-3">
                    <div class="col-md-3"><strong>ID:</strong></div>
                    <div class="col-md-9"><?php echo htmlspecialchars($page['id']); ?></div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-3"><strong>Title:</strong></div>
                    <div class="col-md-9"><?php echo htmlspecialchars($page['title']); ?></div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-3"><strong>Slug:</strong></div>
                    <div class="col-md-9"><?php echo htmlspecialchars($page['slug']); ?></div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-3"><strong>Content:</strong></div>
                    <div class="col-md-9"><?php echo nl2br(htmlspecialchars($page['content'])); ?></div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
